<?php
class RebuildRequest extends Framework\ORM {
    const TABLE = "rebuild_requests";
    protected static $fields = array(
        "ip"   => Framework\Type\Text,
        "time" => Framework\Type\Integer,
        "id"   => Framework\Type\Integer,
    );
}
