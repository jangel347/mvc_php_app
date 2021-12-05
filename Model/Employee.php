<?php
require_once "Model.php";
require_once "ModelInterface.php";
class Employee extends Model implements ModelInterface
{
    public $table_name = 'employees';
    public $table_name_je = 'employee_job';
    public $id;
    public $name;
    public $genre;
    public $created_at;
    public $updated_at;
    public $area_id;
    public $jobs;

    public function insert()
    {
        try {
            $this->db->beginTransaction();
            $sql = $this->db->prepare(
                "INSERT INTO `" . $this->table_name .
                    "` (`id`, `name`, `genre`, `created_at`, `updated_at`, `area_id`) VALUES (NULL, '"
                    . $this->name . "', '" . $this->genre .
                    "', current_timestamp(), current_timestamp(), " . $this->area_id . ")"
            );
            $result = $sql->execute();
            $lastId = $this->lastId();
            if ($lastId[0]) {
                $lastId = $lastId[1];
            } else {
                return [false, 'Something wrong happened, ¡Try again!'];
            }
            $ok = 0;
            foreach ($this->jobs as $job) {
                $sql = $this->db->prepare(
                    "INSERT INTO `" . $this->table_name_je .
                        "` (`id`, `employee_id`, `job_id`, `created_at`, `updated_at`) VALUES (NULL, "
                        . $lastId . ", " . $job . ", current_timestamp(), current_timestamp())"
                );
                if ($sql->execute())
                    $ok++;
            }
            if ($result && $ok > 0) {
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

    public function update()
    {
        try {
            $this->db->beginTransaction();
            $sql = $this->db->prepare(
                "UPDATE `" . $this->table_name .
                    "` SET `name`= '"
                    . $this->name . "', `genre`='" . $this->genre .
                    "', `area_id`=" . $this->area_id . " WHERE `id`=" . $this->id
            );
            $result = $sql->execute();

            $sql_delete = $this->db->prepare(
                "DELETE FROM `" . $this->table_name_je . "` WHERE `id`=" . $this->id
            );
            $result = $sql_delete->execute();

            $ok = 0;
            foreach ($this->jobs as $job) {
                $sql = $this->db->prepare(
                    "INSERT INTO `" . $this->table_name_je .
                        "` (`id`, `employee_id`, `job_id`, `created_at`, `updated_at`) VALUES (NULL, "
                        . $this->id . ", " . $job . ", current_timestamp(), current_timestamp())"
                );
                if ($sql->execute())
                    $ok++;
            }
            if ($result && $ok > 0) {
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

    public function getJobs($id)
    {
        try {
            $sql = $this->db->query(
                "SELECT j.* FROM " . $this->table_name_je .
                    " ej INNER JOIN jobs j ON j.id = ej.job_id WHERE ej.employee_id=" . $id
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
            $this->db->beginTransaction();
            $sql2 = $this->db->prepare(
                "DELETE FROM `" . $this->table_name_je . "` WHERE `employee_id`=" . $this->id
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
            // Log::write($e->getMessage());
            $this->db->rollBack();
            return [false, $e->getMessage()];
        }
    }
}
