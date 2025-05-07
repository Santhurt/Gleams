<?php
namespace modelos;

require_once "../config/database.php";
use config\Database;
use Exception;

class Producto {
    private $conn;
    private $error;

    public function __construct()
    {
        $this->conn = Database::get_instancia()->get_conexion();
    }

    public function get_error(){
        return $this->error;
    }

    public function insertar_producto($productos = [])
    {
        $estado = 1; #activo

        try {
            $consulta = "insert into productos(
                nombre,
                descripcion,
                precio,
                stock,
                estado
            ) values (
                ?, ?, ?, ?, {$estado}
            )";

            $valores = [];

            # aqui se guardan los valores de formulario
            foreach($productos as $valor) {
                $valores[] = trim($valor);
            }

            if(!$this->conn) {
                throw new Exception("No hay conexion con la base de datos:");
            }

            $resultado = mysqli_execute_query(
                $this->conn,
                $consulta,
                $valores
            );

            return $resultado;


        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();
            return false;
        }
    }


}
?>


