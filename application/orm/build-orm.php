<?php
class Build extends Framework\ORM {
    const TABLE = 'builds';
    protected static $fields = array(
        'name' => Framework\Type\Text,
        'path' => Framework\Type\Text,
        'time' => Framework\Type\Integer,
        'num'  => Framework\Type\Integer,
        'id'   => Framework\Type\Integer,
    );
}
