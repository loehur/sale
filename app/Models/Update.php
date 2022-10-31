<?php

class Update
{
    private $db;
    public function __construct($select_db = 1)
    {
        $this->db = Database::getInstance($select_db)[$select_db];
    }

    function update($table, $set, $where)
    {
        return $this->db->update($table, $set, $where);
    }
}
