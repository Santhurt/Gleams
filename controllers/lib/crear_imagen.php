<?php
function insertar_imagen($nombre, $existe_imagen = false, $ruta_antigua = "", $redimensionar = false, $ancho_max = 800, $alto_max = 600, $calidad = 85)
{
    if (!isset($_FILES[$nombre]) || $_FILES[$nombre]['error'] != UPLOAD_ERR_OK || !is_uploaded_file($_FILES[$nombre]["tmp_name"])) {
        error_log(ini_get('upload_max_filesize'));
        error_log(ini_get('post_max_size'));
        $tamano_excedido = ($_FILES[$nombre]["error"] == 1) ? "Tamaño de imagen excede el limite" : null;
        $error = "Fallo en el archivo: " . $tamano_excedido;
        return [
            "ruta" => "", # se devuelve como null para validaciones en el controlador
            "error" => $error
        ];
    }
    
    $permitidos = [
        "image/png" => ".png",
        "image/jpeg" => ".jpg",
        "image/webp" => ".webp"
    ];
    
    $tipo_imagen = mime_content_type($_FILES[$nombre]["tmp_name"]);
    if (!array_key_exists($tipo_imagen, $permitidos)) {
        $error = "Solamente se permiten archivos de tipo .png o .jpg";
        return [
            "ruta" => "",
            "error" => $error
        ];
    }
    
    $extension = $permitidos[$tipo_imagen];
    $nombre_unico = "imagen_" . date("Ymd_Hisv") . $extension;
    $ruta = "assets/fotos/" . $nombre_unico;
    $ruta_absoluta = __DIR__ . "/../../" . $ruta;
    
    // Si se requiere redimensionamiento, procesar la imagen
    if ($redimensionar) {
        $imagen_redimensionada = redimensionar_imagen($_FILES[$nombre]["tmp_name"], $tipo_imagen, $ancho_max, $alto_max, $calidad);
        
        if ($imagen_redimensionada === false) {
            $error = "Error al redimensionar la imagen";
            return [
                "ruta" => "",
                "error" => $error
            ];
        }
        
        // Guardar la imagen redimensionada
        if (!file_put_contents($ruta_absoluta, $imagen_redimensionada)) {
            $error = "No se pudo guardar la imagen redimensionada en el servidor";
            return [
                "ruta" => "",
                "error" => $error
            ];
        }
    } else {
        // Comportamiento original - mover archivo sin modificar
        if (!move_uploaded_file($_FILES[$nombre]["tmp_name"], $ruta_absoluta)) {
            $error = "No se pudo guardar la imagen en el servidor";
            return [
                "ruta" => "",
                "error" => $error
            ];
        }
    }
    
    # esto es para eliminar la imagen
    if ($existe_imagen) {
        unlink(__DIR__ . "/../../" . $ruta_antigua);
    }
    
    return [
        "ruta" => $ruta,
        "absoluta" => $ruta_absoluta
    ];
}

/**
 * Función auxiliar para redimensionar imágenes
 * @param string $archivo_temporal Ruta del archivo temporal
 * @param string $tipo_mime Tipo MIME de la imagen
 * @param int $ancho_max Ancho máximo en píxeles
 * @param int $alto_max Alto máximo en píxeles
 * @param int $calidad Calidad de compresión (solo para JPEG, 0-100)
 * @return string|false Datos de la imagen redimensionada o false en caso de error
 */
function redimensionar_imagen($archivo_temporal, $tipo_mime, $ancho_max, $alto_max, $calidad = 85)
{
    // Crear imagen desde archivo temporal según su tipo
    switch ($tipo_mime) {
        case 'image/jpeg':
            $imagen_original = imagecreatefromjpeg($archivo_temporal);
            break;
        case 'image/png':
            $imagen_original = imagecreatefrompng($archivo_temporal);
            break;
        case 'image/webp':
            $imagen_original = imagecreatefromwebp($archivo_temporal);
            break;
        default:
            return false;
    }
    
    if (!$imagen_original) {
        return false;
    }
    
    // Obtener dimensiones originales
    $ancho_original = imagesx($imagen_original);
    $alto_original = imagesy($imagen_original);
    
    // Calcular nuevas dimensiones manteniendo la proporción
    $ratio = min($ancho_max / $ancho_original, $alto_max / $alto_original);
    
    // Si la imagen ya es más pequeña que los límites, no redimensionar
    if ($ratio >= 1) {
        $nuevo_ancho = $ancho_original;
        $nuevo_alto = $alto_original;
    } else {
        $nuevo_ancho = round($ancho_original * $ratio);
        $nuevo_alto = round($alto_original * $ratio);
    }
    
    // Crear nueva imagen con las dimensiones calculadas
    $imagen_redimensionada = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    
    // Preservar transparencia para PNG y WebP
    if ($tipo_mime == 'image/png' || $tipo_mime == 'image/webp') {
        imagealphablending($imagen_redimensionada, false);
        imagesavealpha($imagen_redimensionada, true);
        $transparente = imagecolorallocatealpha($imagen_redimensionada, 255, 255, 255, 127);
        imagefill($imagen_redimensionada, 0, 0, $transparente);
    }
    
    // Redimensionar imagen
    imagecopyresampled(
        $imagen_redimensionada, $imagen_original,
        0, 0, 0, 0,
        $nuevo_ancho, $nuevo_alto,
        $ancho_original, $alto_original
    );
    
    // Capturar salida de imagen
    ob_start();
    switch ($tipo_mime) {
        case 'image/jpeg':
            imagejpeg($imagen_redimensionada, null, $calidad);
            break;
        case 'image/png':
            imagepng($imagen_redimensionada);
            break;
        case 'image/webp':
            imagewebp($imagen_redimensionada, null, $calidad);
            break;
    }
    $imagen_data = ob_get_contents();
    ob_end_clean();
    
    // Liberar memoria
    imagedestroy($imagen_original);
    imagedestroy($imagen_redimensionada);
    
    return $imagen_data;
}
