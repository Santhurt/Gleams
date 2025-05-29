<?php
namespace lib;
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Correo
{

    private $mail;
    private $error;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    // Función para enviar el correo con el enlace de recuperación
    public function enviarCorreo($destinatario, $asunto, $mensaje)
    {
        try {
            // Configuración del servidor SMTP de Gmail
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';  // Dirección SMTP de Gmail
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'cursosudemypiratas@gmail.com';  // Tu correo SMTP
            $this->mail->Password = 'wghf wvuj mwku poll ';  // Contraseña de la aplicación para Gmail
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            // Remitente
            $this->mail->setFrom('cursosudemypiratas@gmail.com', 'Prueba de correo');
            // Destinatario
            $this->mail->addAddress($destinatario);

            // Contenido del correo
            $this->mail->isHTML(true);
            $this->mail->Subject = $asunto;
            $this->mail->Body    = $mensaje;

            // Enviar el correo
            return $this->mail->send();
        } catch (Exception $e) {
            $this->error = $this->mail->ErrorInfo;
            return false;
        }
    }
}
