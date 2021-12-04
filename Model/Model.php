<?php

class Model
{
    public $table_name;
    public $db;

    public function __CONSTRUCT()
    {
        try {
            require_once Config::MODEL_PATH . "Connection.php";
            $this->db = Connection::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findById($id)
    {
        try {
            $sql = $this->db->prepare(
                "SELECT * FROM "
                    . $this->table_name . " WHERE `id`=" . $id .
                    "ORDER BY id DESC LIMIT 1"
            );
            $sql->execute();
            return $sql->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findAll()
    {
        try {
            $sql = $this->db->query(
                "SELECT * FROM "
                    . $this->table_name
            );
            // $sql->execute();
            return $sql;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
