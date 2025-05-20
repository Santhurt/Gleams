<?php
namespace modelos;
require_once __DIR__ . "/../config/database.php";

use config\Database;
use Exception;

class Pedido{
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
}

?>
