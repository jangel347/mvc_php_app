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
    }

    public function delete()
    {
    }

    public function getAll()
    {
    }

    public function list_job()
    {
        try {
            $stm = $this->db->query("call list_jobes");

            while ($filas = $stm->fetch(PDO::FETCH_ASSOC)) {
                $this->employees[] = $filas;
            }

            return $this->employees;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function list_employees()
    {
        try {
            $stm = $this->db->query("call list_employees");

            while ($filas = $stm->fetch(PDO::FETCH_ASSOC)) {
                $this->employees[] = $filas;
            }

            return $this->employees;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
