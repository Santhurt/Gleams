<?php

namespace config;

use mysqli;
use Exception;

class Database 
{
    private $conn;
    private static $instancia;

    private function __construct()
    {
        $config = require_once __DIR__ . "/config.php";
        $db = $config["db"];

        try {
            $this->conn = new mysqli(
                $db["host"],
                $db["user"],
                $db["password"],
                $db["name"]
            );

            if ($this->conn->connect_error) {
                throw new Exception("Error en la conexion: " . $this->conn->connect_error);
            }

            $this->conn->set_charset($db["charset"]);
        } catch (Exception $e) {
            error_log("Llegooooooooo");
            error_log($e->getMessage());
        }
    }

    public static function get_instancia()
    {
        if(self::$instancia == null) {
            self::$instancia = new Database();
        }

        return self::$instancia;
    }

    public function get_conexion()
    {
        return $this->conn;
    }

    public function close_conexion()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function __destruct()
    {
        error_log("Conexion cerrada");
        $this->close_conexion();
    }
}

