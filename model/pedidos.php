<?php

namespace modelos;

require_once __DIR__ . "/../config/database.php";

use config\Database;
use Error;
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

    public function cancelar_pedido_cliente($id_cliente, $id_pedido)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $cancelar_pedido = "update pedidos set
                estado = 'cancelado'
                where id_cliente = ? and id_pedido = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $cancelar_pedido, [$id_cliente, $id_pedido]);

            if(mysqli_affected_rows($this->conn) === 0) {
                return false;
            }

            return $resultado;
        } catch(Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_detalle_si_existe($id_cliente, $id_pedido)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $traer_detalles = "select
                detalle_pedidos.id_detalle,
                productos.nombre,
                detalle_pedidos.cantidad,
                detalle_pedidos.precio_unitario
            from pedidos
            join detalle_pedidos on pedidos.id_pedido = detalle_pedidos.id_pedido
            join productos on detalle_pedidos.id_producto = productos.id_producto
            where pedidos.id_pedido = ? and pedidos.id_cliente = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $traer_detalles, [$id_pedido, $id_cliente]);

            if ($resultado->num_rows == 0) {
                return false;
            }

            $detalles = [];
            while ($fila = $resultado->fetch_assoc()) {
                foreach ($fila as $campo => $valor) {
                    $fila[$campo] = htmlspecialchars($valor);
                }

                $detalles[] = $fila;
            }

            return $detalles;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_pedidos_por_cliente($id_cliente)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $traer_pedidos = "select
                id_pedido as idPedido,
                fecha_pedido as fecha,
                clientes.direccion,
                total,
                pedidos.estado
            from pedidos
            join clientes on clientes.id_cliente = pedidos.id_cliente
            where clientes.id_cliente = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $traer_pedidos, [$id_cliente]);

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_detalles($id_pedido)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $consulta_detalles = "select
                productos.nombre,
                detalle_pedidos.cantidad,
                detalle_pedidos.precio_unitario as precio
            from detalle_pedidos
            join productos on detalle_pedidos.id_producto = productos.id_producto
            where detalle_pedidos.id_pedido = ?
            ";


            $resultado = mysqli_execute_query($this->conn, $consulta_detalles, [$id_pedido]);

            if (!$resultado) {
                throw new Exception("No se pudierton traer los detalles");
            }

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_pedido_porid($id)
    {
        try {

            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $consulta_pedido = "select
                pedidos.id_pedido as 'ID pedido',
                clientes.correo,
                clientes.nombre,
                clientes.telefono,
                fecha_pedido as 'Fecha del pedido',
                total,
                pedidos.estado
            from pedidos
            join clientes on clientes.id_cliente = pedidos.id_cliente
            where pedidos.id_pedido = ?
            ";

            $respuesta = mysqli_execute_query($this->conn, $consulta_pedido, [$id]);

            if (!$respuesta) {
                throw new Exception("Error al traer el pedido");
            }

            return $respuesta->fetch_assoc();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function cambiar_estado_pedido($id_pedido, $estado)
    {
        try {

            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $cambiar_estado = "update pedidos set
                estado = ?
            where id_pedido = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $cambiar_estado, [$estado, $id_pedido]);

            if (!$resultado) {
                throw new Exception("Error al cambiar el estado del pedido");
            }

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_pedidos()
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $consulta_pedidos = "select
                pedidos.id_pedido as 'ID pedido',
                clientes.correo,
                clientes.nombre,
                clientes.telefono,
                fecha_pedido as 'Fecha del pedido',
                total,
                pedidos.estado
            from pedidos
            join clientes on clientes.id_cliente = pedidos.id_cliente
            order by fecha_pedido desc
            ";

            $resultado = mysqli_execute_query($this->conn, $consulta_pedidos);

            if (!$resultado) {
                throw new Exception("Error al traer los pedidos");
            }

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function insertar_pedido($id_cliente, $total, $pedidos = [])
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            mysqli_begin_transaction($this->conn);

            $verificar_pedidos = "select * from pedidos where id_cliente = ? and estado = 'pendiente'";

            $resultado_verificacion = mysqli_execute_query($this->conn, $verificar_pedidos, [$id_cliente]);

            if($resultado_verificacion->num_rows > 5) {
                throw new Exception("Limite de pedidos pendientes superados");
            }

            $insertar_pedido = "insert into pedidos(
                fecha_pedido,
                id_cliente,
                total,
                estado
            ) values(now(), ?, ?, ?)";

            $respuesta_insertar_pedido = mysqli_execute_query($this->conn, $insertar_pedido, [
                $id_cliente,
                $total,
                "pendiente"
            ]);

            if (!$respuesta_insertar_pedido) {
                throw new Exception("Error al insertar en pedidos");
            }

            $id_pedido = mysqli_insert_id($this->conn);

            $insertar_detalles = "insert into detalle_pedidos(
                id_pedido, 
                id_producto,
                cantidad, 
                precio_unitario
            ) values (?, ?, ?, ?)";

            foreach ($pedidos as $pedido) {
                $resultado = mysqli_execute_query($this->conn, $insertar_detalles, [
                    $id_pedido,
                    $pedido["id_producto"],
                    $pedido["cantidad"],
                    $pedido["precio"]
                ]);

                if (!$resultado) {
                    throw new Exception("Error al insertar el detalle");
                }
            }

            mysqli_commit($this->conn);

            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
}
