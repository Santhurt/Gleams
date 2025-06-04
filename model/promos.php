<?php

namespace modelos;

require_once __DIR__ . "/../config/database.php";

use config\Database;
use Exception;

class Promo
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

    public function traer_promos()
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $traer_promos = "select
                id_promocion,
                titulo,
                descripcion,
                ruta
            from promocion
            ";

            $resultado = mysqli_execute_query($this->conn, $traer_promos);

            if ($resultado->num_rows == 0) {
                throw new Exception("No hay datos para traer");
            }

            return $resultado;
        } catch (Exception $e) {

            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }


    public function editar_promo($id_promocion, $titulo, $descripcion, $ruta)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $editar_promo = "update promocion set
                titulo = ?,
                descripcion = ?,
                ruta = ?
            where id_promocion = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $editar_promo, [
                $titulo,
                $descripcion,
                $ruta,
                $id_promocion
            ]);

            if (mysqli_affected_rows($this->conn) == 0) {
                throw new Exception("No se actualizó ninguna fila");
            }

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_promo_por_id($id_promo)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $traer_promo = "select * from promocion where id_promocion = ?";

            $resultado = mysqli_execute_query($this->conn, $traer_promo, [$id_promo]);

            if ($resultado->num_rows == 0) {
                throw new Exception("No se encontraron promociones");
            }

            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
}
