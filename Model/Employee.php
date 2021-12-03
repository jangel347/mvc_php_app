<?php
include "Model.php";
include "ModelInterface.php";
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

    public function findAllWithArea()
    {
        try {
            $sql = $this->db->query(
                "SELECT e.*, a.name as 'area' FROM "
                    . $this->table_name . " e INNER JOIN areas a ON a.id = e.area_id"
            );
            // $sql->execute();
            return $sql;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update()
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

    public function job_list($id_employee)
    {
        try {
            // hacer uso de una declaración preparada para evitar la inyección de sql
            $sql = $this->db->prepare("call list_job (:id_colaborador)");
            // declaración if-else en la ejecución de nuestra declaración preparada
            $sql->execute(array(':id_colaborador' => $id_employee));


            while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {
                $this->job[] = $filas;
            }
            return $this->job;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function data_employee($employeeID)
    {
        try {
            // hacer uso de una declaración preparada para evitar la inyección de sql
            $sql = $this->db->prepare("call data_employee (:pdocument)");
            // declaración if-else en la ejecución de nuestra declaración preparada
            $sql->execute(array(':pdocument' => $employeeID));
            $fila = $sql->fetch(PDO::FETCH_ASSOC);
            return [
                $fila['id_employee'],
                $fila['id_Colaborador'],
                $fila['cedula'],
                $fila['nombres'],
                $fila['apellidos'],
                $fila['email'],
                $fila['cargo'],
                $fila['fotografia'],
                $fila['telefono_corporativo']
            ];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_job_list($employeeID)
    {
        try {
            // hacer uso de una declaración preparada para evitar la inyección de sql
            $sql = $this->db->prepare("call delete_jobes_employee (:p_id)");
            // declaración if-else en la ejecución de nuestra declaración preparada
            $sql->execute(array(':p_id' => $employeeID));
            if ($sql) {
                return "success";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function last_id($table)
    {
        try {
            // hacer uso de una declaración preparada para evitar la inyección de sql
            $count = $this->db->query("SELECT MAX(id)+1 AS ultimo FROM " . $table);
            $fila = $count->fetch(PDO::FETCH_ASSOC);
            return $fila['ultimo'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert_job_list($sql)
    {
        try {
            // hacer uso de una declaración preparada para evitar la inyección de sql
            $count = $this->db->exec($sql);
            /* Devuelve el número de filas borradas */
            if ($count > 0) {
                return "success";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert_employee($name_employee, $password, $id_colab)
    {
        try {
            // hacer uso de una declaración preparada para evitar la inyección de sql
            $sql = $this->db->prepare("call insert_employee (:p_nombre_employee,:p_clave,:p_id_colaborador)");
            // declaración if-else en la ejecución de nuestra declaración preparada
            $sql->execute(array(':p_nombre_employee' => $name_employee, ':p_clave' => $password, ':p_id_colaborador' => $id_colab));
            $num = $sql->rowCount();
            if ($num == 1) {
                $Bool = true;
                return $Bool;
            } else {
                $Bool = false;
                return $Bool;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update_employee($id, $name_employee, $password)
    {
        try {
            // hacer uso de una declaración preparada para evitar la inyección de sql
            $sql = $this->db->prepare("call update_employee (:p_id,:p_nombre_employee,:p_clave)");
            // declaración if-else en la ejecución de nuestra declaración preparada
            $sql->execute(array(':p_id' => $id, ':p_nombre_employee' => $name_employee, ':p_clave' => $password));
            $num = $sql->rowCount();
            if ($num == 1) {
                $Bool = true;
                return $Bool;
            } else {
                $Bool = false;
                return $Bool;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
