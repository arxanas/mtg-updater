<?php
namespace Framework;

require_once(SYS_PATH . '/core/types.php');
require_once(SYS_PATH . '/core/relationships.php');

class OrmException extends \Exception {}

class InvalidRelationshipType extends OrmException {}

abstract class ORM {
    /**
     * The row, as returned from the database. This can be modified by the user
     * to then save it.
     * @var array
     */
    protected $data;

    /**
     * The database instance.
     * @var \PDO
     */
    protected static $pdo;

    /**
     * Load the schema from a configuration object. Should not be called from
     * the parent object...
     */
    public static function setSchema($schema) {
        if (isset($schema->table)) {
            static::$table = $schema->table;
        }

        if (isset($schema->fields)) {
            foreach ($schema->fields as $field_name => $field_type) {
                static::$fields[$field_name] = constant(
                    '\\Framework\\Type\\' . Slug::slugToName($field_type)
                );
            }
        }

        if (isset($schema->relationships)) {
            foreach ($schema->relationships as $field => $relationship) {
                $relationship_type = constant(
                    'Framework\\' . Slug::slugToName($relationship->type)
                );
                $relationship_class = constant(
                    'Framework\\' . Slug::slugToName($relationship->class)
                );
                static::$relationships[$field] = array(
                    'type' => $relationship_type,
                    'class' => $relationship_class,
                    'key' => $relationship->key,
                );
            }
        }
    }

    /**
     * Sets the PDO instance. Should not be called by the user, but has to be
     * public because of the ridiculous architecture.
     * @param \PDO $pdo
     */
    public static function setDatabase(\PDO $pdo) {
        self::$pdo = $pdo;
    }

    /**
     * Returns the database instance.
     * @return \PDO
     */
    private static function loadDatabase() {
        return self::$pdo;
    }

    /**
     * Gets the table name for the subclass.
     * @return string The table name.
     * @todo Remove compatibility for constant table naming.
     * @todo Add auto-table-name deduction; maybe see how Laravel did it.
     */
    private static function getTableName() {
        if (isset(static::$table)) {
            return static::$table;
        } else {
            throw new OrmException(
                'Could not deduce table name for ORM ' . get_called_class()
            );
        }
    }

    /**
     * Makes a new object of the type specified by the ORM.
     * @param mixed $param If $param is an integer, it assumes that $param is
     *     the ID of the object. If $param is an array, it assumes that the
     *     array contains the data in the database row. Otherwise, it throws an
     *     error.
     * @todo Use ? instead of :param
     * @throws \InvalidArgumentException
     */
    public function __construct($param) {
        if (is_int($param)) {
            // $param is the ID.
            $db = self::loadDatabase();

            $query = $db->prepare('
                SELECT *
                FROM `'.self::getTableName().'`
                WHERE
                    `id` = :id
            ;');
            $query->bindValue(':id', $param, \PDO::PARAM_INT);
            $query->execute();

            $this->data = $query->fetch(\PDO::FETCH_ASSOC);
        } else if (is_array($param)) {
            // $param is the row.
            $this->data = $param;
        } else {
            throw new \InvalidArgumentException(
                var_export($param, true) . ' is not a valid parameter'
            );
        }
    }

    /**
     * If the data is available in the internal data store, return that.
     * Otherwise, return the appropriate value.
     * @param string $name The name of the variable.
     * @return mixed
     */
    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else if (array_key_exists($name, static::$relationships)) {
            return $this->getFromRelationship(static::$relationships[$name]);
        } else {
            return $this->$name;
        }
    }

    /**
     * Sets data in the internal data store if available, otherwise sets the
     * value normally. Use in conjunction with ORM::save to update the database.
     * @param string $name The name of the variable.
     * @param mixed $value The value of the variable.
     */
    public function __set($name, $value) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name] = $value;
        } else {
            $this->$name = $value;
        }
    }

    /**
     * Get the corresponding elements in a relationship.
     * @param object $relationship
     * @return mixed
     */
    private function getFromRelationship($relationship) {
        switch ($relationship->type) {
            case \Framework\Relationship\OneToOne:
            case \Framework\Relationship\ManyToOne:
            case \Framework\Relationship\OneToMany:
                $class_name = $relationship->class;
                $id = $this->data[$relationship->key];
                return $class_name::get($id);
                break;

            default:
            case \Framework\Relationship\ManyToMany:
                throw new InvalidRelationshipException(
                    'Invalid relationship type: ' . $relationship->type
                );
                break;
        }
    }

    /**
     * Evaluates an array representing a WHERE statement.
     * @param array $constraints The constraints specified. The constraints
     *     should be in the form array('name' => 'value'), which is equivalent
     *     to WHERE `name` = :value. You can also specify a comparison operator
     *     by using array('name >' => 'value').
     * @return string
     */
    private static function evaluateConstraints(&$constraints) {
        if (!sizeof($constraints)) {
            return array(
                'constraints' => $constraints,
                'sql'         => '1',
            );
        } else {
            // @todo Add LIKE constraint
            $comparison_operators = array(
                '='  => '=',
                '>'  => '>',
                '>=' => '>=',
                '<'  => '>',
                '<=' => '<=',
                '<>' => '<>',
                '!=' => '!=',
                '%'  => 'LIKE',
            );
            $sql = array();
            $new_constraints = array();
            foreach (array_keys($constraints) as $field) {
                $operator = '=';
                $old_field = $field;
                // Check to see if the last characters are a comparison operator.
                foreach ($comparison_operators as $key => $value) {
                    if (substr($field, -strlen($key)) === $key) {
                        $field = substr($field, 0, -1 - strlen($key));
                        $operator = $value;
                        break;
                    }
                }
                $new_constraints[$field] = $constraints[$old_field];

                $sql[] = sprintf(
                    '`%s` %s :%s',
                    $field,
                    $operator,
                    $field
                );
            }

            return array(
                'constraints' => $new_constraints,
                'sql'         => implode(' AND ', $sql),
            );
        }
    }

    /**
     * Evaluate LIMIT, OFFSET, and ORDER BY.
     * @param  array  $params
     * @todo   ORDER BY is *not escaped*!!!!1! This is **bad** and should be
     * resolved immediately! But you really shouldn't be accepting user input
     * into your ORDER BY, anyways...
     * @return string
     */
    private static function evaluateParams($params) {
        $sql = array();
        foreach ($params as $param => $value) {
            switch (strtolower($param)) {
                case "limit":
                    $sql[] = 'LIMIT ' . \Framework\Type\coerce(
                        $value,
                        \Framework\Type\Integer
                    );
                    break;

                case "offset":
                    $sql[] = 'OFFSET ' . \Framework\Type\coerce(
                        $value,
                        \Framework\Type\Integer
                    );
                    break;

                case "order by":
                    $sql[] = 'ORDER BY ' . $value;
                    break;

                default:
                    throw new InvalidArgumentException(
                        'The parameter type ' . $param . 'was not recognized.'
                    );
            }
        }
        return implode(' ', $sql);
    }

    /**
     * Binds parameters to an SQL statement.
     * @param  \PDOStatement $query
     * @param  array         $fields
     * @return \PDOStatement
     */
    private static function bindParams(\PDOStatement $query, $fields) {
        foreach ($fields as $field => $value) {
            $type = \Framework\Type\toPDO(static::$fields[$field]);
            $query->bindValue(':' . $field, $value, $type);
        }
        return $query;
    }

    /**
     * Create a new object from an array. (This updates the database.)
     * @param array $fields An array of name => value pairs to initialize the
     *      new object.
     * @return self It returns a new instance of itself, whatever that is.
     */
    public static function create($fields) {
        $sql  = sprintf(
            'INSERT INTO %s ( %s ) VALUES ( %s );',

            self::getTableName(),

            // Field names, with surrounding grave accents.
            implode(', ', array_map(function($i) {
                return '`' . $i . '`';
            }, array_keys($fields))),

            // Field names, with a colon before them to bind them.
            implode(', ', array_map(function($i) {
                return ':' . $i;
            }, array_keys($fields)))
        );

        $db = self::loadDatabase();
        $query = $db->prepare($sql);

        // Bind all of the parameters to their values.
        self::bindParams($query, $fields);

        $query->execute();

        // Instantiate a new class from the inserted row.
        $class_name = get_called_class();
        return new $class_name(intval($db->lastInsertId()));
    }

    /**
     * Gets objects from the database according to some criteria.
     * @param mixed $param If $param is an integer, it assumes that $param is
     * the ID. Otherwise, it assumes that $param is a constraint array.
     * @param array $sql_params Lets you set limit, offset, order by, etc.
     * @return mixed A single object if $param was an integer, or an array if
     * $param was an array.
     */
    public static function get($param = null, $sql_params = array()) {
        if ($param === null) {
            $constraints = array();
        } else {
            if (is_int($param)) {
                $constraints = array(
                    'id' => $param
                );
            } else if (is_array($param)) {
                $constraints = $param;
            } else {
                throw new \InvalidArgumentException();
            }
        }
        $temp = self::evaluateConstraints($constraints);
        $constraints_sql = $temp['sql'];
        $constraints = $temp['constraints'];
        $params_sql = self::evaluateParams($sql_params);

        $sql = sprintf(
            'SELECT * FROM `%s` WHERE %s %s;',
            self::getTableName(),
            $constraints_sql,
            $params_sql
        );

        $db = self::loadDatabase();

        $query = $db->prepare($sql);
        self::bindParams($query, $constraints);
        $query->execute();

        // Return the retrieved elements.
        $class_name = get_called_class();
        if (is_int($param)) {
            // The user asked by ID, so we return a single object.
            if ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                return new $class_name($row);
            } else {
                return null;
            }
        } else {
            // The user asked by parameters, so even if there's only one return
            // row, return them as an array.
            $ret = array();
            foreach ($query->fetchAll(\PDO::FETCH_ASSOC) as $row) {
                $ret[] = new $class_name($row);
            }
            return $ret;
        }
    }

    /**
     * Saves an object, synchronizing the values in the database with the values
     * in its data store.
     */
    public function save() {
        $updates = array();
        foreach (static::$fields as $field => $type) {
            $updates[] = sprintf(
                '`%s` = :%s',
                $field,
                $field
            );
        }
        $update_sql = implode(', ', $updates);

        $sql = sprintf(
            'UPDATE %s SET %s WHERE `id` = :id;',
            self::getTableName(),
            $update_sql
        );

        $db = self::loadDatabase();

        $query = $db->prepare($sql);
        self::bindParams($query, static::$fields);
        return $query->execute();
    }

    /**
     * Deletes an object or rows.
     * @param mixed $param If $param is an integer, it assumes that $param is
     * the ID of the row. If $param is an array, it assumes that $param is a set
     * of constraints. If $param is an object, it assumes that $param is the
     * object to be deleted. Note that the function can't actually delete the
     * object -- only the corresponding database row.
     */
    public static function delete($param) {
        if (is_int($param)) {
            // We're passed an ID.
            $constraints = array(
                'id' => $param,
            );
        } else if (is_array($param)) {
            // We're passed a constraints array.
            $constraints = $param;
        } else if (
            is_object($param)
            && get_class($param) === get_called_class()
        ) {
            // We're passed an actual object -- we have to get its ID.
            $is_object = true;
            $constraints = array(
                'id' => $param->id
            );
        } else {
            throw new \InvalidArgumentException(
                var_export($param, true) . ' is not a valid argument to delete.'
            );
        }

        $temp = self::evaluateConstraints($constraints);
        $constraints_sql = $temp['sql'];
        $constraints = $temp['constraints'];
        $sql = sprintf(
            'DELETE FROM %s WHERE %s;',
            self::getTableName(),
            $constraints
        );

        $db = self::loadDatabase();

        $query = $db->prepare($sql);
        $query->bindValue(':id', $constraints['id'], \PDO::PARAM_INT);
        return $query->execute();
    }
}
