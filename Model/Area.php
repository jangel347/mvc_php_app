<?php
require_once "Model.php";
require_once "ModelInterface.php";
class Area extends Model implements ModelInterface
{
    public $table_name = 'areas';
    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function insert()
    {
        try {
            $sql = $this->db->prepare(
                "INSERT INTO `" . $this->table_name .
                    "` (`id`, `name`, `created_at` , `updated_at`) VALUES (NULL, '"
                    . $this->name . "', current_timestamp(), current_timestamp())"
            );
            echo "INSERT INTO `" . $this->table_name .
                "` (`id`, `name`, `created_at` , `updated_at`) VALUES (NULL, '"
                . $this->name . "', current_timestamp(), current_timestamp())";
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

    public function findAllWithEmployees()
    {
        try {
            $sql = $this->db->query(
                "SELECT a.*, CASE  WHEN SUM(e.id) > 0 THEN COUNT(a.id)  ELSE 0 END AS employees  FROM " .
                    $this->table_name . " a LEFT JOIN employees e ON e.area_id = a.id GROUP BY a.id"
            );
            return $sql;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findWithEmployees($id)
    {
        try {
            $sql = $this->db->prepare(
                "SELECT a.*,COUNT(a.id) as employees  FROM "
                    . $this->table_name . " a WHERE a.id =" . $id
            );
            $sql->execute();
            return [true, $sql->fetch()];
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    public function update()
    {
        try {
            $sql = $this->db->prepare(
                "UPDATE `" . $this->table_name .
                    "` SET `name`= '"
                    . $this->name . "' WHERE `id`=" . $this->id
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

    public function delete()
    {
    }

    public function getAll()
    {
    }
}
