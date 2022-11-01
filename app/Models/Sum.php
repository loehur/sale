<?php

class Sum
{
    private $db;
    public function __construct($select_db = 1)
    {
        $this->db = Database::getInstance($select_db)[$select_db];
    }

    function col_where($table, $col, $where)
    {
        return $this->db->sum_col_where($table, $col, $where);
    }
}
