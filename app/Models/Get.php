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

    function count_where($table, $where)
    {
        return $this->db->count_where($table, $where);
    }

    function cols_groubBy($table, $cols, $groupBy)
    {
        return $this->db->get_cols_groubBy($table, $cols, $groupBy);
    }

    function cols_groubBy_orderBy($table, $cols, $groupBy, $orderBy)
    {
        return $this->db->get_cols_groubBy_orderBy($table, $cols, $groupBy, $orderBy);
    }

    function cols_where($table, $cols, $where)
    {
        return $this->db->get_cols_where($table, $cols, $where);
    }

    function cols_where_groubBy($table, $cols, $where, $groupBy)
    {
        return $this->db->get_cols_where_groubBy($table, $cols, $where, $groupBy);
    }

    function cols_where_groubBy_orderBy($table, $where, $cols, $groupBy, $orderBy)
    {
        return $this->db->get_cols_where_groubBy_orderBy($table, $where, $cols, $groupBy, $orderBy);
    }
}
