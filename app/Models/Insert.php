<?php

class Insert
{
    private $db;
    public function __construct($select_db = 1)
    {
        $this->db = Database::getInstance($select_db)[$select_db];
    }

    function cols($table, $cols, $vals)
    {
        return $this->db->insertCols($table, $cols, $vals);
    }
}
