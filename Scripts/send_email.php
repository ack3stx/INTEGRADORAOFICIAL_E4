<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$smtp_user = $_ENV['SMTP_USER'] ?? 'No definido';
$smtp_password = $_ENV['SMTP_PASSWORD'] ?? 'No definido';

$response_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    if (empty($nombre) || empty($telefono) || empty($correo) || empty($mensaje)) {
        $response_message = "Todos los campos son obligatorios";
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
            $mail->SMTPSecure = 'tls';
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
            header('Location: ../views/Contacto.php?status=success');
        } catch (Exception $e) {
            $response_message = "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
        }
    }
}
?>
