<?php
class DummyPDO extends PDO {
    private $in_transaction = false;

    public function beginTransaction() {
        $this->in_transaction = true;
        return true;
    }

    public function commit() {
        $this->in_transaction = false;
        return true;
    }

    public function __construct(
        $dsn,
        $username = null,
        $password = null,
        $driver_options = null
    ) {
    }

    public function errorCode() {
        return "1";
    }

    public function errorInfo() {
        return array(
            "HY000",
            "1",
            "No error."
        );
    }

    public function exec($statement) {
        return 1;
    }

    public function getAttribute($attribute) {
        return null;
    }

    public static function getAvailableDrivers() {
        return array();
    }

    public function inTransaction() {
        return $this->in_transaction;
    }

    public function lastInsertId($name = null) {
        return "1";
    }

    public function prepare($statement, $driver_options = array()) {
        return new \Framework\DummyPDOStatement($statement);
    }

    public function query(
        $statement,
        $fetch_mode = null,
        $colno_object = null,
        $ctor_args = null
    ) {
        $stmt = $this->prepare($statement);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function quote($string) {
        return $string;
    }

    public function rollBack() {
        $this->in_transaction = false;
        return true;
    }

    public function setAttribute($attribute, $value) {
        return true;
    }
}

class DummyPDOStatement {
    public $queryString = "";

    public function bindColumn(
        $column,
        &$param,
        $type = null,
        $maxlen = null,
        $driverdata = null
    ) {
        return true;
    }

    public function bindParam(
        $parameter,
        &$variable,
        $data_type = null,
        $length = null,
        $driver_options = null
    ) {
        return true;
    }

    public function bindValue($parameter, $value, $data_type = null) {
        return true;
    }

    public function closeCursor() {
        return true;
    }

    public function columnCount() {
        return 1;
    }

    public function debugDumpParams() {
    }

    public function errorCode() {
        return "1";
    }

    public function errorInfo() {
        return array(
            "HY000",
            "1",
            "No error."
        );
    }

    public function execute($input_parameters = null) {
        return true;
    }

    public function fetch(
        $fetch_style = null,
        $cursor_orientation = null,
        $cursor_offset
    ) {
        return array();
    }

    public function fetchAll(
        $fetch_style = null,
        $fetch_argument = null,
        $ctor_args = null
    ) {
        return array();
    }

    public function fetchColumn($column_number = null) {
        return null;
    }

    public function fetchObject($class_name = "stdClass", $ctor_args = null) {
        return new $class_name();
    }

    public function getAttribute($attribute) {
        return null;
    }

    public function getColumnMeta($column) {
        return array();
    }

    public function nextRowset() {
    }

    public function rowCount() {
        return 1;
    }

    public function setAttribute($attribute, $value) {
        return true;
    }

    public function setFetchMode($mode) {
        return true;
    }
}

