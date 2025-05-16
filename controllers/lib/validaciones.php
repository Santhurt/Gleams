<?php

namespace lib;

use DateTime;

class Validar
{
    private $sanitized = [];

    public function __construct($data)
    {
        $this->sanitized = $data;
    }

    public function requeridos(...$campos)
    {
        $campos_vacios = [];

        foreach ($campos as $campo) {
            if (empty(trim($_POST[$campo])) || !isset($_POST[$campo])) {
                $campos_vacios[] = $campo;
            }
        }

        return $campos_vacios;
    }

    public function numeros(...$campos)
    {
        foreach ($campos as $campo) {
            $numero = $_POST[$campo];

            if (!is_numeric($numero) || $numero <= 0) {
                return false;
            }
        }

        return true;
    }

    public function email($correo)
    {
        $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        if (!preg_match($patron, $_POST[$correo])) {
            return false;
        }

        return true;
    }

    public function text(...$campos)
    {
        $patron = "/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s,.;:¡!¿?-]+$/u";

        foreach ($campos as $campo) {
            if (!preg_match($patron, $_POST[$campo])) {
                return false;
            }
        }

        return true;
    }

    public function date($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);

        return ($d && $d->format('Y-m-d') === $date) ? $date : false;
    }

}
