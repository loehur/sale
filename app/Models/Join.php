<?php

class Join
{
    private $db;
    public function __construct($select_db = 1)
    {
        $this->db = Database::getInstance($select_db)[$select_db];
    }

    function join1($table, $tb_join, $on)
    {
        return $this->db->innerJoin1($table, $tb_join, $on);
    }

    function join1_where($table, $tb_join, $on, $where)
    {
        return $this->db->innerJoin1_where($table, $tb_join, $on, $where);
    }

    function cols_join1_where($table, $cols, $tb_join, $on, $where)
    {
        return $this->db->cols_innerJoin1_where($table, $cols, $tb_join, $on, $where);
    }

    function full1_where($table, $tb_join, $on, $where)
    {
        return $this->db->fullJoin1_where($table, $tb_join, $on, $where);
    }
}
