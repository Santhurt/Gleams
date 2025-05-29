<?php
function getBaseUrl(): string
{
    // Detecta si es HTTPS
    $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

    // Obtiene el nombre del host (ej: localhost, midominio.com)
    $host = $_SERVER['HTTP_HOST'];

    return $protocolo . $host . '/';
}
