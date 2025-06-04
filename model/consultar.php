<?php

namespace modelos;

require_once __DIR__ . "/../config/database.php";

use config\Database;
use Exception;

class Consultar
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

    public function usuarios_activos()
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexión con la base de datos");
            }

            $usuarios_activos = "select count(*) as total_usuarios from clientes where estado = 1";

            $resultado = mysqli_execute_query($this->conn, $usuarios_activos);

            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            error_log($this->error);
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function ventas_del_dia()
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexión con la base de datos");
            }

            $hoy_inicio = date('Y-m-d 00:00:00');
            $hoy_fin    = date('Y-m-d 23:59:59');

            $ventas_del_dia = "SELECT SUM(total) AS ventas_diarias
                           FROM pedidos
                           WHERE estado = 'entregado'
                           AND fecha_pedido >= ? AND fecha_pedido <= ?";

            $resultado = mysqli_execute_query($this->conn, $ventas_del_dia, [
                $hoy_inicio,
                $hoy_fin
            ]);

            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            error_log($this->error);
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function ventas_del_mes()
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexión con la base de datos");
            }

            $primer_dia_del_mes = date('Y-m-01 00:00:00');
            $ultimo_dia_del_mes = date('Y-m-t 23:59:59');

            $ventas_del_mes = "select sum(total) as ventas_mensuales
            from pedidos
            where estado = 'entregado'
            and fecha_pedido >= ? and fecha_pedido <= ?
            ";

            $resultado = mysqli_execute_query($this->conn, $ventas_del_mes, [
                $primer_dia_del_mes,
                $ultimo_dia_del_mes
            ]);

            $fila = $resultado->fetch_assoc();

            if (is_null($fila["ventas_mensuales"])) {
                $fila["ventas_mensuales"] = 0;
            }

            return $fila;
        } catch (Exception $e) {
            error_log($this->error);
            $this->error = $e->getMessage();
            return false;
        }
    }
}
