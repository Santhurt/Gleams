<?php
function insertar_imagen($nombre, $existe_imagen = false, $ruta_antigua = "")
{

    if (!isset($_FILES[$nombre]) || $_FILES[$nombre]['error'] != UPLOAD_ERR_OK || !is_uploaded_file($_FILES[$nombre]["tmp_name"])) {
        error_log(ini_get('upload_max_filesize'));
        error_log(ini_get('post_max_size'));

        $tamanoExcedido = ($_FILES[$nombre]["error"] == 1) ? "Tamaño de imagen excede el limite" : null;


        $error = "Fallo en el archivo: " . $tamanoExcedido;


        return [
            "ruta" => "", # se devuelve como null para validaciones en el controlador
            "error" => $error
        ];
    }

    $permitidos = [
        "image/png" => ".png",
        "image/jpeg" => ".jpg"
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

    if (!move_uploaded_file($_FILES[$nombre]["tmp_name"], $ruta_absoluta)) {
        $error = "No se pudo guardar la imagen en el servidor";

        return [
            "ruta" => "",
            "error" => $error
        ];
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
