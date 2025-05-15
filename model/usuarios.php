<?php
namespace modelos; 
require_once __DIR__ . "/../config/database.php";

use config\Database;
use Exception;

class Usuario
{
    private $conn;
    private $error;

    public function __construct()
    {
        $this->conn = Database::get_instancia()->get_conexion();
    }

    public function get_error()
    {
        return $this->error;
    }

    public function correo_existe($correo) {
        try {
            if(!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $consulta = "select 1 from clientes where correo = ?";

            $resultado = mysqli_execute_query($this->conn, $consulta, [$correo]);

            if($resultado->fetch_assoc()) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return true;
        }
    }

    public function insertar_usuario($usuario = [])
    {
        $estado = 1;
        $fecha = date("Y-m-d");

        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $usuario_consulta = "insert into clientes(
                nombre,
                correo,
                telefono,
                password,
                direccion,
                estado,
                fecha_registro
            ) values (?, ?, ?, ?, ?, ?, ?)
            ";
            error_log($usuario["telefono"]);

            $resultado = mysqli_execute_query($this->conn, $usuario_consulta, [
                $usuario["nombre"],
                $usuario["correo"],
                $usuario["telefono"],
                $usuario["password"],
                $usuario["direccion"],
                $estado,
                $fecha
            ]);

            $nueva_id = mysqli_insert_id($this->conn);

            if(!$resultado) {
                throw new Exception("No se puedo insertar el producto");
            }

            return [
                "usuario" => $resultado,
                "nueva_id" => $nueva_id
            ];

        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
}
