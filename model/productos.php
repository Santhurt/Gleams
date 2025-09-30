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

    public function eliminar_descuento($id_producto)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos:");
            }

            $verificar_descuento = "select 1 from descuentos where id_producto = ?";
            $resultado_verificacion = mysqli_execute_query($this->conn, $verificar_descuento, [$id_producto]);

            if (!$resultado_verificacion->fetch_assoc()) {
                throw new Exception("No hay descuento aplicado a este producto");
            }

            $eliminar_descuento = "delete from descuentos where id_producto = ?";
            $resultado = mysqli_execute_query($this->conn, $eliminar_descuento, [$id_producto]);

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function insertar_descuento($id_producto, $descuento, $fecha_fin)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos:");
            }

            $verificar_descuento = "select 1 from descuentos where id_producto = ?";
            $resultado_verificacion = mysqli_execute_query($this->conn, $verificar_descuento, [$id_producto]);

            if ($resultado_verificacion->fetch_assoc()) {
                throw new Exception("El producto ya tiene un descuento asignado");
            }

            $insertar_descuento = "insert into descuentos(
                id_producto,
                descuento,
                fecha_fin
            ) values(?, ?, ?)
            ";

            $resultado = mysqli_execute_query($this->conn, $insertar_descuento, [
                $id_producto,
                $descuento,
                $fecha_fin
            ]);

            return $resultado;
        } catch (Exception $e) {

            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function editar_producto($producto = [], string $nueva_ruta)
    {
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

            if (!$resultado) {
                throw new Exception("No se actualizar el producto");
            }

            $imagen_consulta = "update imagenes_prod
                set ruta = ?
                where id_producto = ?
            ";

            $imagen_resultado = mysqli_execute_query($this->conn, $imagen_consulta, [$nueva_ruta, $producto["id"]]);

            if (!$imagen_resultado) {
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
                categorias.id_categoria as categoria,
                ruta,
                descuento,
                fecha_fin as 'Fin del descuento'
            from productos
            join categorias 
            on categorias.id_categoria = productos.id_categoria
            join imagenes_prod on imagenes_prod.id_producto = productos.id_producto
            left join descuentos on descuentos.id_producto = productos.id_producto
            where productos.id_producto = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $consulta, [$id]);

            if (!$resultado) {
                throw new Exception("Error al trear el producto");
            }

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
                productos.id_producto,
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
            left join descuentos
            on descuentos.id_producto = productos.id_producto
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
                id_categoria
            ) values (
                ?, ?, ?, ?, {$estado}, ?
            )";


            $max_categoria = $this->max_categoria();

            if ($producto["categoria"] <= 0 || $producto["categoria"] > $max_categoria) {
                throw new Exception("La categoria seleccionada no fue encontrada");
            }


            $resultado = mysqli_execute_query(
                $this->conn,
                $producto_insertar,
                [
                    $producto["nombre"],
                    $producto["descripcion"],
                    $producto["precio"],
                    $producto["stock"],
                    $producto["categoria"]
                ]
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

    public function editar_categoria($id, $nombre)
    {
        try {
            $consulta = "update categorias set nombre = ? where id_categoria = ?";

            if (!$this->conn) {
                throw new Exception("no hay conexion con la base de datos");
            }

            $resultado = mysqli_execute_query($this->conn, $consulta, [$nombre, $id]);

            if (!$resultado) {
                throw new Exception("No se pudo insertar la categoria");
            }

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
    public function verificar_categoria($id)
    {
        try {
            // 1. Ajustar la consulta: no necesitas el JOIN si la columna está en 'productos'.
            // Asumiendo que 'productos.id_categoria' es la columna. 
            // ¡IMPORTANTE!: También cambiamos 'id = ?' por 'id_categoria = ?'.
            $verificar = "SELECT * 
                      FROM productos 
                      JOIN categorias
                      ON categorias.id_categoria = productos.id_categoria
                      WHERE categorias.id_categoria = ? 
                      "; // Usamos LIMIT 1 para mayor eficiencia, solo necesitamos saber si existe uno.

            // 2. Ejecutar la consulta con mysqli_execute_query
            // El 'id' que pasas a la función es el ID de la categoría a verificar.
            $resultado = mysqli_execute_query($this->conn, $verificar, [$id]);

            // 3. Verificar si la conexión falló DESPUÉS de intentar la consulta (opcional, 
            // ya que mysqli_execute_query ya lanzaría un error si no hay conexión o la consulta falla)
            if ($resultado === false) {
                // Esto captura errores de SQL o problemas de conexión si no se manejan de otra manera.
                throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conn));
            }

            // 4. Procesar el resultado: verificar el número de filas encontradas.
            $num_filas = mysqli_num_rows($resultado);

            // 5. Devolver el valor:
            // Si $num_filas > 0, significa que HAY productos asignados (debe devolver FALSE para el borrado/eliminación).
            // Si $num_filas == 0, significa que NO HAY productos (debe devolver TRUE, indicando que es seguro eliminar).
            return $num_filas === 0;
        } catch (Exception $e) {
            // Manejo de errores
            error_log("Error en verificar_categoria: " . $e->getMessage());
            // $this->error = $e->getMessage(); // Si usas una propiedad de error

            // En caso de cualquier error (conexión, SQL, etc.), asumimos que la verificación falló o
            // que por seguridad no debe proceder, devolviendo FALSE.
            return false;
        }
    }
    public function eliminar_categoria($id)
    {
        try {

            $consulta  = "delete from categorias where id_categoria = ?";

            if (!$this->conn) {
                throw new Exception("no hay conexion con la base de datos");
            }

            $resultado = mysqli_execute_query($this->conn, $consulta, [$id]);

            if (!$resultado) {
                throw new Exception("No se pudo eliminar la categoria");
            }

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function crearCategoria($nombre)
    {
        try {
            $consulta = "insert into categorias(nombre) values (?)";

            if (!$this->conn) {
                throw new Exception("no hay conexion con la base de datos");
            }

            $resultado = mysqli_execute_query($this->conn, $consulta, [$nombre]);

            if (!$resultado) {
                throw new Exception("No se pudo insertar la categoria");
            }

            $nueva_id = mysqli_insert_id($this->conn);

            return [
                "id" => $nueva_id,
                "nombre" => $nombre
            ];
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_domicilio()
    {
        try {
            $consulta = "select monto from domicilio";

            if (!$this->conn) {
                throw new Exception("no hay conexion con la base de datos");
            }

            $resultado = mysqli_execute_query($this->conn, $consulta);

            if (!$resultado) {
                throw new Exception("No se pudo traer el monto");
            }

            $fila = mysqli_fetch_row($resultado);

            if ($fila) {
                $monto = $fila[0];
                return $monto;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
    public function asignar_domicilio($monto)
    {
        try {
            $consulta = "update domicilio set monto = ? where id_domicilio = 1";

            if (!$this->conn) {
                throw new Exception("no hay conexion con la base de datos");
            }

            $resultado = mysqli_execute_query($this->conn, $consulta, [$monto]);

            if (!$resultado) {
                throw new Exception("No se pudo traer el monto");
            }

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
}
