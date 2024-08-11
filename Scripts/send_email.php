<?php

$ip = $_SERVER['REMOTE_ADDR'];
$capchat = $_POST['g-recaptcha-response'];
$secretkey = "6LccmR0qAAAAAA0xfHs9zDOwVUDtzPU-6Y7_5yi4";
$respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$capchat&remoteip=$ip");
$atributos = json_decode($respuesta, TRUE);
if(!$atributos['success']){
    header('Location: ../Views/Contacto.php?status=failed');
    exit();
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require _DIR_ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dotenv = Dotenv::createImmutable(_DIR_ . '/..');
$dotenv->load();
var_dump($_ENV['SMTP_USER'], $_ENV['SMTP_PASSWORD']);


$smtp_user = $_ENV['SMTP_USER'] ?? 'No definido';
$smtp_password = $_ENV['SMTP_PASSWORD'] ?? 'No definido';

$response_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    echo "Datos recibidos:<br>";
    echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
    echo "Teléfono: " . htmlspecialchars($telefono) . "<br>";
    echo "Correo: " . htmlspecialchars($correo) . "<br>";
    echo "Mensaje: " . htmlspecialchars($mensaje) . "<br>";

    if (empty($nombre) || empty($telefono) || empty($correo) || empty($mensaje)) {
        $response_message = "Todos los campos son obligatorios";
        echo $response_message;
    } else {
        $smtp_server = "smtp.gmail.com";
        $smtp_port = 587;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $smtp_server;
            $mail->SMTPAuth = true;
            $mail->Username = $smtp_user;
            $mail->Password = $smtp_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $smtp_port;

            $mail->setFrom($smtp_user, 'Sitio Web');
            $mail->addReplyTo($correo, $nombre);
            $mail->addAddress($smtp_user, 'Administrador');

            $mail->isHTML(true);
            $mail->Subject = "Nuevo mensaje de $nombre";
            $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f4f4f4;
                    }
                    .container {
                        width: 100%;
                        padding: 20px;
                        background-color: #ffffff;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        margin: 20px auto;
                        max-width: 600px;
                    }
                    .header {
                        background-color: #007BFF;
                        color: white;
                        padding: 10px 0;
                        text-align: center;
                        border-radius: 10px 10px 0 0;
                    }
                    .content {
                        padding: 20px;
                    }
                    .content p {
                        margin: 10px 0;
                    }
                    .footer {
                        text-align: center;
                        padding: 10px 0;
                        color: #888888;
                    }
                </style>
            </head>
            <body>
                <div class=\"container\">
                    <div class=\"header\">
                        <h2>Nuevo mensaje de contacto</h2>
                    </div>
                    <div class=\"content\">
                        <p><strong>Nombre:</strong> $nombre</p>
                        <p><strong>Teléfono:</strong> $telefono</p>
                        <p><strong>Correo:</strong> $correo</p>
                        <p><strong>Mensaje:</strong></p>
                        <p>$mensaje</p>
                    </div>
                    <div class=\"footer\">
                        <p>Este es un mensaje automático de su sitio web.</p>
                    </div>
                </div>
            </body>
            </html>
            ";

            $mail->send();
            $response_message = "Mensaje enviado exitosamente.";
            echo $response_message; 
            header('Location: http://52.15.205.48/INTEGRADORAOFICIAL_E4/Views/Contacto.php?status=success');
            exit();
        } catch (Exception $e) {
            echo "Hubo un error al enviar el mensaje: " . $e->getMessage();
        }
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>