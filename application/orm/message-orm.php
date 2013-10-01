<?php
class Message extends Framework\ORM {
    const TABLE = 'messages';
    protected static $fields = array(
        'ip'      => Framework\Type\Text,
        'time'    => Framework\Type\Integer,
        'content' => Framework\Type\Text,
        'id'      => Framework\Type\Integer,
    );
}
