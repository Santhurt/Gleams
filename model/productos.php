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

    public function editar_producto($producto = [], string $nueva_ruta) {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos:");
            }

            mysqli_begin_transaction($this->conn);

            $consulta = "update productos set
                nombre = ?,
                descripcion = ?,
                precio = ?,
                stock = ?,
                id_categoria = ?
            where id_producto = ?";

            $max_categoria = $this->max_categoria();

            if ($producto["categoria"] <= 0 || $producto["categoria"] > $max_categoria) {
                throw new Exception("La categoria seleccionada no fue encontrada");
            }

            $resultado = mysqli_execute_query($this->conn, $consulta, [
                $producto["nombre"],
                $producto["descripcion"],
                $producto["precio"],
                $producto["stock"],
                $producto["categoria"],
                $producto["id"]
            ]);

            if(!$resultado) {
                throw new Exception("No se actualizar el producto");
            }

            $imagen_consulta = "update imagenes_prod
                set ruta = ?
                where id_producto = ?
            ";

            $imagen_resultado = mysqli_execute_query($this->conn, $imagen_consulta, [$nueva_ruta, $producto["id"]]);

            if(!$imagen_resultado) {
                throw new Exception("Error al actualizar la imagen");
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

    public function traer_productoPorId($id)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos:");
            }

            $consulta = "select
                productos.id_producto,
                productos.nombre as producto,
                descripcion,
                precio,
                stock,
                estado,
                descuento,
                categorias.id_categoria as categoria,
                ruta
            from productos
            join categorias 
            on categorias.id_categoria = productos.id_categoria
            join imagenes_prod on imagenes_prod.id_producto = productos.id_producto
            where productos.id_producto = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $consulta, [$id]);

            $fila = $resultado->fetch_assoc();
            return $fila;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function eliminar_producto($id)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos:");
            }

            mysqli_begin_transaction($this->conn);

            $imagen_delete = "delete from imagenes_prod where id_producto = ?";

            $resultado = mysqli_execute_query($this->conn, $imagen_delete, [$id]);

            if (!$resultado) {
                throw new Exception("Error al eliminar la imagen");
            }

            $producto_delete = "update productos 
                set estado = 0
                where id_producto = ?
            ";

            $resultado_producto = mysqli_execute_query($this->conn, $producto_delete, [$id]);

            if (!$resultado_producto) {
                throw new Exception("Error al eliminar el producto");
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

    public function traer_productos()
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos:");
            }

            $consulta = "select
                id_producto,
                productos.nombre as producto,
                descripcion,
                precio,
                stock,
                estado,
                descuento,
                categorias.nombre as categoria
            from productos
            join categorias 
            on categorias.id_categoria = productos.id_categoria
            where estado = 1
            ";

            $consulta_imagenes = "select ruta, id_producto from imagenes_prod";

            $resultado = mysqli_execute_query($this->conn, $consulta);
            $imagenes = mysqli_execute_query($this->conn, $consulta_imagenes);

            return [
                "productos" => $resultado,
                "imagenes" => $imagenes
            ];
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function insertar_producto($producto = [], string $ruta_imagen)
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

            if ($producto["categoria"] <= 0 || $producto["categoria"] > $max_categoria) {
                throw new Exception("La categoria seleccionada no fue encontrada");
            }


            # aqui se guardan los valores de formulario
            foreach ($producto as $valor) {
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

            return [
                "producto_insertado" => $resultado,
                "nueva_id" => $nueva_id
            ];
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
