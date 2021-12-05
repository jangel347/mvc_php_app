<?php
require_once "Model.php";
require_once "ModelInterface.php";
class Job extends Model implements ModelInterface
{
    public $table_name = 'jobs';
    public $table_name_je = 'employee_job';
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
            return [false, 'Something wrong happened, ¡Try again!'];
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
            return [false, 'Something wrong happened, ¡Try again!'];
        } catch (Exception $e) {
            // Log::write($e->getMessage());
            return [false, $e->getMessage()];
        }
    }

    public function delete()
    {
        try {
            $this->db->beginTransaction();
            $sql2 = $this->db->prepare(
                "DELETE FROM `" . $this->table_name_je . "` WHERE `job_id`=" . $this->id
            );
            $result2 = $sql2->execute();
            $sql = $this->db->prepare(
                "DELETE FROM `" . $this->table_name . "` WHERE `id`=" . $this->id
            );
            $result = $sql->execute();
            if ($result && $result2) {
                $this->db->commit();
                return [true, $result];
            }
            $this->db->rollBack();
            return [false, 'Something wrong happened, ¡Try again!'];
        } catch (Exception $e) {
            $this->db->rollBack();
            // Log::write($e->getMessage());
            return [false, $e->getMessage()];
        }
    }

    public function getAll()
    {
    }
}
