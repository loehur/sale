<?php

class Get
{
    private $db;
    public function __construct($select_db = 1)
    {
        $this->db = Database::getInstance($select_db)[$select_db];
    }

    function all($table)
    {
        return $this->db->get($table);
    }

    function where($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function where_row($table, $where)
    {
        return $this->db->get_where_row($table, $where);
    }

    // function sum_where($table, $col, $where)
    // {
    //     return $this->db->get_sum_where($table, $col, $where);
    // }
}
