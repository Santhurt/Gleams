<?php

namespace modelos;

require_once __DIR__ . "/../config/database.php";

use config\Database;
use Exception;

class Producto
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

    public function insertar_producto($productos = [], string $ruta_imagen)
    {
        $estado = 1; #activo
        $descuento = 0;


        try {

            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos:");
            }

            mysqli_begin_transaction($this->conn);

            $producto_insertar = "insert into productos(
                nombre,
                descripcion,
                precio,
                stock,
                estado,
                descuento,
                id_categoria
            ) values (
                ?, ?, ?, ?, {$estado}, {$descuento}, ?
            )";

            $valores = [];

            $max_categoria = $this->max_categoria();

            if($productos["categoria"] <= 0 || $productos > $max_categoria ) {
                throw new Exception("La categoria seleccionada no fue encontrada");
            }


            # aqui se guardan los valores de formulario
            foreach ($productos as $valor) {
                $valores[] = trim($valor);
            }


            $resultado = mysqli_execute_query(
                $this->conn,
                $producto_insertar,
                $valores
            );

            if (!$resultado) {
                throw new Exception("No se pudo insertar el producto");
            }

            $nueva_id = mysqli_insert_id($this->conn);

            $imagen_insertar = "insert into imagenes_prod(
                ruta,
                id_producto
            ) values (?, ?)";

            $resultado_imagen = mysqli_execute_query(
                $this->conn,
                $imagen_insertar,
                [$ruta_imagen, $nueva_id]
            );

            if (!$resultado_imagen) {
                throw new Exception("No se pudo insertar la imagen");
            }

            mysqli_commit($this->conn);
            return $resultado;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);

            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_categorias()
    {
        try {
            $query = "select id_categoria, nombre from categorias";

            if (!$this->conn) {
                throw new Exception("no hay conexion con la base de datos");
            }

            $resultado = mysqli_execute_query($this->conn, $query);

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function max_categoria()
    {
        try {
            $consulta = "select max(id_categoria) as max_id from categorias";

            if (!$this->conn) {
                throw new Exception("no hay conexion con la base de datos");
            }

            $resultado = mysqli_execute_query($this->conn, $consulta);

            if (!$resultado) {
                throw new Exception("Error al traer el ultimo id");
            }

            return $resultado->fetch_column();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
}
