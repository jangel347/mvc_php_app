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
                    " ORDER BY id DESC LIMIT 1"
            );
            $sql->execute();
            return [true, $sql->fetch()];
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    public function lastId()
    {
        try {
            $sql = $this->db->prepare(
                "SELECT `id` FROM "
                    . $this->table_name
                    . " ORDER BY id DESC LIMIT 1"
            );
            $sql->execute();
            return [true, $sql->fetch()['id']];
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    public function findAll()
    {
        try {
            $sql = $this->db->query(
                "SELECT * FROM "
                    . $this->table_name
            );
            $sql->execute();
            return [true, $sql];
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }
}
