<?php
namespace Framework;

class OrmLoaderException extends \Exception {}

class OrmNotFoundException extends OrmLoaderException {}

class OrmNotLoadableException extends OrmLoaderException {}

class OrmConfigNotLoadableException extends OrmLoaderException {}

class OrmLoader {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;

        require_once(SYS_PATH . '/include/orm.php');
    }

    public function load($orm_slug) {
        $orm_path = sprintf(
            '%s/orm/%s.php',
            APP_PATH,
            $orm_slug
        );

        if (!file_exists($orm_path)) {
            throw new OrmNotFoundException(
                'ORM not found: ' . $orm_path
            );
        }

        if ((@include_once($orm_path)) === false) {
            throw new OrmNotFoundException(
                'ORM not loadable: ' . $orm_path
            );
        }

        $orm_name = Slug::slugToName($orm_slug);
        $orm_name::setDatabase($this->pdo);

        $config_file_path = sprintf(
            '%s/database/%s.json',
            APP_PATH,
            $orm_slug
        );
        if (file_exists($config_file_path)) {
            if (!is_readable($config_file_path)) {
                throw new OrmConfigNotLoadableException(
                    'ORM config not loadable: ' . $config_file_path
                );
            }

            $json = json_decode(file_get_contents(
                $config_file_path
            ));

            if ($json === null) {
                throw new OrmConfigNotLoadableException(
                    'ORM config not valid JSON: ' . $config_file_path
                );
            }

            $orm_name::setSchema($json);
        }
    }
}
