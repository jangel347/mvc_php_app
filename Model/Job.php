<?php
require_once "Model.php";
require_once "ModelInterface.php";
class Job extends Model implements ModelInterface
{
    public $table_name = 'jobs';
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

    public function getAll()
    {
    }
}
