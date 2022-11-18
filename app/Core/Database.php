<?php
require_once 'app/Config/DB_Config.php';

class Database extends DB_Config

{
    private static $_instance = NULL;
    private $mysqli;
    private static $db_config;

    public function __construct($db = 1)
    {
        self::$db_config = new DB_Config($db);
        $this->mysqli = new mysqli(self::$db_config->db_host, self::$db_config->db_user, self::$db_config->db_pass, self::$db_config->db_name) or die('DB Error');
    }

    public static function getInstance($db = 1)
    {
        if (!isset(self::$_instance[$db])) {
            self::$_instance[$db] = new Database($db);
        }

        return self::$_instance;
    }

    //===========================================================
    public function get($table)
    {
        $reply = [];
        $query = "SELECT * FROM $table";
        $result = $this->mysqli->query($query);

        while ($row = $result->fetch_assoc())
            $reply[] = $row;

        return $reply;
    }

    public function get_where($table, $where)
    {
        $reply = [];
        $query = "SELECT * FROM $table WHERE $where";
        $result = $this->mysqli->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return array('query' => $query, 'error' => $this->mysqli->error, 'errno' => $this->mysqli->errno);
        }
    }

    public function get_where_row($table, $where)
    {
        $reply = [];
        $query = "SELECT * FROM $table WHERE $where";
        $result = $this->mysqli->query($query);
        $reply = $result->fetch_assoc();
        if ($result) {
            return $reply;
        } else {
            return array('query' => $query, 'error' => $this->mysqli->error, 'errno' => $this->mysqli->errno);
        }
    }

    public function get_cols_groubBy($table, $cols, $groupBy)
    {
        $reply = [];
        $query = "SELECT $cols FROM $table GROUP BY $groupBy";
        $result = $this->mysqli->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return array('query' => $query, 'error' => $this->mysqli->error, 'errno' => $this->mysqli->errno);
        }
    }

    public function get_cols_groubBy_orderBy($table, $cols, $groupBy, $orderBy)
    {
        $reply = [];
        $query = "SELECT $cols FROM $table GROUP BY $groupBy ORDER BY $orderBy";
        $result = $this->mysqli->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return array('query' => $query, 'error' => $this->mysqli->error, 'errno' => $this->mysqli->errno);
        }
    }

    public function get_cols_where_groubBy_orderBy($table, $cols, $where, $groupBy, $orderBy)
    {
        $reply = [];
        $query = "SELECT $cols FROM $table WHERE $where GROUP BY $groupBy ORDER BY $orderBy";
        $result = $this->mysqli->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return array('query' => $query, 'error' => $this->mysqli->error, 'errno' => $this->mysqli->errno);
        }
    }

    public function get_order($table, $order)
    {
        $reply = [];
        $query = "SELECT * FROM $table ORDER BY $order";
        $result = $this->mysqli->query($query);

        while ($row = $result->fetch_assoc())
            $reply[] = $row;

        return $reply;
    }


    public function get_where_order($table, $where, $order)
    {
        $reply = [];
        $query = "SELECT * FROM $table WHERE $where ORDER BY $order";
        $result = $this->mysqli->query($query);

        while ($row = $result->fetch_assoc())
            $reply[] = $row;

        return $reply;
    }

    //========================================================================================

    public function insert($table, $values)
    {
        $query = "INSERT INTO $table VALUES($values)";
        $run = $this->mysqli->query($query);
        if ($run) {
            return TRUE;
        } else {
            return array('query' => $query, 'info' => $this->mysqli->error);
        }
    }

    public function insertCols($table, $columns, $values)
    {
        $query = "INSERT INTO $table($columns) VALUES($values)";
        $run = $this->mysqli->query($query);
        return array('query' => $query, 'error' => $this->mysqli->error, 'errno' => $this->mysqli->errno);
    }

    public function delete_where($table, $where)
    {
        $query = "DELETE FROM $table WHERE $where";
        $this->mysqli->query($query);
        return array('query' => $query, 'error' => $this->mysqli->error, 'errno' => $this->mysqli->errno);
    }

    // =================================================
    public function update($table, $set, $where)
    {
        $query = "UPDATE $table SET $set WHERE $where";
        $run = $this->mysqli->query($query);
        return array('query' => $query, 'error' => $this->mysqli->error, 'errno' => $this->mysqli->errno);
    }

    //============================================

    public function count_where($table, $where)
    {
        $query = "SELECT COUNT(*) FROM $table WHERE $where";
        $result = $this->mysqli->query($query);

        $reply = $result->fetch_array();
        if ($reply) {
            return $reply[0];
        } else {
            return array('query' => $query, 'info' => $this->mysqli->error);
        }
    }

    //============================================

    public function sum_col_where($table, $col, $where)
    {
        $query = "SELECT SUM($col) as Total FROM $table WHERE $where";
        $result = $this->mysqli->query($query);

        $reply = $result->fetch_assoc();
        if ($result) {
            return $reply["Total"];
        } else {
            return array('query' => $query, 'info' => $this->mysqli->error);
        }
    }

    //========================================

    public function query($query)
    {
        $runQuery = $this->mysqli->query($query);
        if ($runQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //=====================================================

    public function innerJoin1($table, $tb_join, $on)
    {
        $query = "SELECT * FROM $table INNER JOIN $tb_join ON $on";
        $result = $this->mysqli->query($query);
        if ($result) {
            $reply = [];
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return FALSE;
        }
    }

    public function innerJoin2($table, $tb_join1, $on1, $tb_join2, $on2)
    {
        $query = "SELECT * FROM $table INNER JOIN $tb_join1 ON $on1 INNER JOIN $tb_join2 ON $on2";
        $result = $this->mysqli->query($query);
        if ($result) {
            $reply = [];
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return FALSE;
        }
    }

    public function innerJoin2_where($table, $tb_join1, $on1, $tb_join2, $on2, $where)
    {
        $query = "SELECT * FROM $table INNER JOIN $tb_join1 ON $on1 INNER JOIN $tb_join2 ON $on2 WHERE $where";
        $result = $this->mysqli->query($query);
        if ($result) {
            $reply = [];
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return FALSE;
        }
    }

    public function innerJoin1_where($table, $tb_join, $on, $where)
    {
        $query = "SELECT * FROM $table INNER JOIN $tb_join ON $on WHERE $where";
        $result = $this->mysqli->query($query);
        if ($result) {
            $reply = [];
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return FALSE;
        }
    }

    public function fullJoin1_where($table, $tb_join, $on, $where)
    {
        $query = "SELECT * FROM $table JOIN $tb_join ON $on WHERE $where";
        $result = $this->mysqli->query($query);
        if ($result) {
            $reply = [];
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return FALSE;
        }
    }

    public function innerJoin1_orderBy($table, $tb_join, $on, $orderBy)
    {
        $query = "SELECT * FROM $table INNER JOIN $tb_join ON $on ORDER BY $orderBy";
        $result = $this->mysqli->query($query);
        if ($result) {
            $reply = [];
            while ($row = $result->fetch_assoc())
                $reply[] = $row;
            return $reply;
        } else {
            return FALSE;
        }
    }
}
