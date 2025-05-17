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

    public function verificar_usuario($correo, $password)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            if (!$this->verificar_correo($correo)) {
                throw new Exception("El correo no esta registrado");
            }

            $traer_pass = "select password from clientes where correo = ?";

            $resultado_traer_pass = mysqli_execute_query($this->conn, $traer_pass, [$correo]);

            if (!$resultado_traer_pass) {
                throw new Exception("Error al procesar la solicitud");
            }

            $password_hash = $resultado_traer_pass->fetch_assoc();

            if (!$password_hash) {
                throw new Exception("Usuario no encontrado");
            }

            if (!password_verify($password, $password_hash["password"])) {
                throw new Exception("Datos incorrectos");
            }

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function editar_usuario($usuario = [])
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            mysqli_begin_transaction($this->conn);

            $usuario_editar = "UPDATE clientes
                SET nombre = ?,
                    telefono = ?,
                    fecha_registro = ?,
                    correo = ?,
                    direccion = ?
                WHERE id_cliente = ?";

            $resultado = mysqli_execute_query($this->conn, $usuario_editar, [
                $usuario["nombre"],
                $usuario["telefono"],
                $usuario["fecha"],
                $usuario["correo"],
                $usuario["direccion"],
                $usuario["id"]
            ]);

            if (!$resultado) {
                throw new Exception("Error al actualizar el usuario");
            }

            $actualizar_rol = "UPDATE clientes_rol
                SET id_rol = ?
                WHERE id_cliente = ?";


            $rol_resultado = mysqli_execute_query($this->conn, $actualizar_rol, [
                $usuario["roles"],
                $usuario["id"]
            ]);

            if (!$rol_resultado) {
                throw new Exception("Error al actualizar el rol");
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

    public function traer_roles()
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $roles_consulta = "select * from roles";

            $resultado = mysqli_execute_query($this->conn, $roles_consulta);

            if (!$resultado) {
                throw new Exception("Error al traer las roles");
            }

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_usuarioPorCorreo($correo)
    {
        try {

            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $usuario_consulta = "select
                nombre,
                telefono,
                rol,
                fecha_registro as 'fecha de registro',
                correo,
                direccion,
                estado
            from clientes
            join clientes_rol on clientes.id_cliente = clientes_rol.id_cliente
            join roles on clientes_rol.id_rol = roles.id_rol
            where clientes.correo = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $usuario_consulta, [$correo]);

            if (!$resultado) {
                throw new Exception("Error al traer el usuario");
            }

            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_usuarioPorId($id)
    {
        try {

            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $usuario_consulta = "select
                nombre,
                telefono,
                rol,
                fecha_registro as 'fecha de registro',
                correo,
                direccion,
                estado
            from clientes
            join clientes_rol on clientes.id_cliente = clientes_rol.id_cliente
            join roles on clientes_rol.id_rol = roles.id_rol
            where clientes.id_cliente = ?
            ";

            $resultado = mysqli_execute_query($this->conn, $usuario_consulta, [$id]);

            if (!$resultado) {
                throw new Exception("Error al traer el usuario");
            }

            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function eliminar_usuario($id)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $eliminar_consulta = "update clientes set estado = 0 where id_cliente = ?";

            $resultado = mysqli_execute_query($this->conn, $eliminar_consulta, [$id]);

            if (!$resultado) {
                throw new Exception("Error al deshabilitar el usuario");
            }

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function traer_usuarios()
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $usuarios_consulta = "select
                clientes.id_cliente as 'ID Usuario',
                nombre,
                telefono,
                rol,
                fecha_registro as 'fecha de registro',
                correo,
                direccion,
                estado
            from clientes
            join clientes_rol on clientes.id_cliente = clientes_rol.id_cliente
            join roles on clientes_rol.id_rol = roles.id_rol
            where estado = 1
            ";

            $resultado = mysqli_execute_query($this->conn, $usuarios_consulta);

            if (!$resultado) {
                throw new Exception("Error al traer los usuarios");
            }

            return $resultado;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function verificar_correo($correo)
    {
        try {
            if (!$this->conn) {
                throw new Exception("No hay conexion con la base de datos");
            }

            $consulta = "select 1 from clientes where correo = ?";

            $resultado = mysqli_execute_query($this->conn, $consulta, [$correo]);

            if ($resultado->fetch_assoc()) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return [
                "error_consulta" => true,
            ];
        }
    }

    public function insertar_usuario($usuario = [])
    {
        $estado = 1;
        $fecha = date("Y-m-d");

        try {
            mysqli_begin_transaction($this->conn);

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

            if (!$resultado) {
                throw new Exception("No se puedo insertar el producto");
            }

            $nueva_id = mysqli_insert_id($this->conn);

            $rol_consulta = "insert into clientes_rol(id_cliente, id_rol) values (?, ?)";
            $rol_resultado = mysqli_execute_query($this->conn, $rol_consulta, [$nueva_id, 2]);

            if (!$rol_resultado) {
                throw new Exception("No se pudo asignar el rol");
            }



            mysqli_commit($this->conn);

            return [
                "usuario" => $resultado,
                "nueva_id" => $nueva_id
            ];
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            error_log($e->getMessage());
            $this->error = $e->getMessage();

            return false;
        }
    }
}
