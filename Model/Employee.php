<?php
require_once "Model.php";
require_once "ModelInterface.php";
class Employee extends Model implements ModelInterface
{
    public $table_name = 'employees';
    public $id;
    public $name;
    public $genre;
    public $created_at;
    public $updated_at;
    public $area_id;

    public function insert()
    {
        try {
            $sql = $this->db->prepare(
                "INSERT INTO `" . $this->table_name .
                    "` (`id`, `name`, `genre`, `created_at`, `updated_at`, `area_id`) VALUES (NULL, '"
                    . $this->name . "', '" . $this->genre .
                    "', current_timestamp(), current_timestamp(), " . $this->area_id . ")"
            );
            $result = $sql->execute();
            if ($result) {
                return [true, $result];
            }
            return [false, 'Ha ocurrido un error. Intenta nuevamente'];
        } catch (Exception $e) {
            // Log::write($e->getMessage());
            return [false, $e->getMessage()];
        }
    }

    public function update()
    {
        try {
            $sql = $this->db->prepare(
                "UPDATE `" . $this->table_name .
                    "` SET `name`= '"
                    . $this->name . "', `genre`='" . $this->genre .
                    "', `area_id`=" . $this->area_id . " WHERE `id`=" . $this->id
            );
            $result = $sql->execute();
            if ($result) {
                return [true, $result];
            }
            return [false, 'Ha ocurrido un error. Intenta nuevamente'];
        } catch (Exception $e) {
            // Log::write($e->getMessage());
            return [false, $e->getMessage()];
        }
    }

    public function getByAreaId($id)
    {
        try {
            $sql = $this->db->query(
                "SELECT * FROM "
                    . $this->table_name . " WHERE area_id = " . $id
            );
            $sql->execute();
            $list = [];
            while ($item = $sql->fetch()) {
                array_push($list, $item);
            }
            return [true, $list];
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    public function findAllWithArea()
    {
        try {
            $sql = $this->db->query(
                "SELECT e.*, a.name as 'area' FROM "
                    . $this->table_name . " e INNER JOIN areas a ON a.id = e.area_id"
            );
            return $sql;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $sql = $this->db->prepare(
                "DELETE FROM `" . $this->table_name . "` WHERE `id`=" . $this->id
            );
            $result = $sql->execute();
            if ($result) {
                return [true, $result];
            }
            return [false, 'Ha ocurrido un error. Intenta nuevamente'];
        } catch (Exception $e) {
            // Log::write($e->getMessage());
            return [false, $e->getMessage()];
        }
    }
}
