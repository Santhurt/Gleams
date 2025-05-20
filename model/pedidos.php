<?php

namespace modelos;

require_once __DIR__ . "/../config/database.php";

use config\Database;
use Exception;

class Pedido
{
    private $error;
    private $conn;

    public function __construct()
    {
        $this->conn = Database::get_instancia()->get_conexion();
    }

    public function get_error()
    {
        return $this->error;
    }

    public function insertar_pedido_detalle($pedido)
    {
        try {

            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function insertar_pedido($pedido = [])
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            mysqli_begin_transaction($this->conn);

            $insertar_pedido = "insert into pedidos(
                fecha_pedido,
                id_cliente,
                total,
                estado
            ) values(?, ?, ?, ?)";

            $respuesta_insertar_pedido = mysqli_execute_query($this->conn, $insertar_pedido, [
                date("Y-m-d"),
                $pedido["id_cliente"],
                $pedido["total"],
                "pendiente"
            ]);

            if (!$respuesta_insertar_pedido) {
                throw new Exception("Erro al insertar en pedidos");
            }

            $id_pedido = mysqli_insert_id($this->conn);

            // TODO: Terminar de insertar los pedidos
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
}
