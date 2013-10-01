<?php
$dsn = $dependencies['config']->database->dsn;
if ($dsn) {
    $class_name = "PDO";
} else {
    require_once('database.php');
    $class_name = "DummyPDO";
}
$ret = new $class_name($dsn);
if ($ret === null) {
    throw new \PDOException(
        $ret->errorInfo()
    );
}
$ret->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
return $ret;
