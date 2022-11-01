<?php

class Delete
{
    private $db;
    public function __construct($select_db = 1)
    {
        $this->db = Database::getInstance($select_db)[$select_db];
    }

    function where($table, $where)
    {
        return $this->db->delete_where($table, $where);
    }
}
