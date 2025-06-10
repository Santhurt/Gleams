<?php
namespace modelos;
require_once __DIR__ . "/../config/database.php";

use config\Database;
use Exception;

class Comentario {
    private $conn;
    private $error;

    public function __construct()
    {
        $this->conn = Database::get_instancia()->get_conexion();
    }

    public function get_error(){
        return $this->error;
    }

    public function eliminar_comentario($id_comentario)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $eliminar_comentario = "update comentarios set
                estado = 0
            where id_comentario = ?
            ";

            $respuesta = mysqli_execute_query($this->conn, $eliminar_comentario, [$id_comentario]);

            return $respuesta;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;

        }
    }

    public function traer_comentarios_por_producto($id_producto)
    {
        try {

            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $traer_comentarios = "select
                clientes.nombre as cliente,
                comentario,
                estrellas,
                fecha
            from comentarios 
            join clientes on clientes.id_cliente = comentarios.id_cliente
            where comentarios.estado = 1 and id_producto = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $traer_comentarios, [$id_producto]);

            return $resultado;

        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;

        }
    }

    public function traer_comentarios()
    {
        try {

            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $traer_comentarios = "select
                id_comentario as 'ID comentario',
                clientes.nombre as cliente,
                productos.nombre as producto,
                comentario,
                estrellas,
                comentarios.estado,
                fecha
            from comentarios 
            join clientes on clientes.id_cliente = comentarios.id_cliente
            join productos on productos.id_producto = comentarios.id_producto
            where comentarios.estado = 1
            ";

            $resultado = mysqli_execute_query($this->conn, $traer_comentarios);

            return $resultado;

        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;

        }
    }

    public function insertar_comentario($comentario = [])
    {
        try{
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $comprobar_comentarios = "select * from comentarios where id_cliente = ?";

            $resultado = mysqli_execute_query($this->conn, $comprobar_comentarios, [$comentario["id_cliente"]]);

            if($resultado->num_rows > 2) {
                throw new Exception("Limite de 3 comentarios superados");
            }

            $insertar_comentario = "insert into comentarios(
                id_cliente,
                id_producto,
                comentario,
                estrellas,
                estado,
                fecha
            ) values(?, ?, ?, ?, ?, ?)
            ";

            $respuesta = mysqli_execute_query($this->conn, $insertar_comentario, [
                $comentario["id_cliente"],
                $comentario["id_producto"],
                $comentario["comentario"],
                $comentario["estrellas"],
                1,
                $comentario["fecha"]
            ]);

            return $respuesta;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
}
?>


