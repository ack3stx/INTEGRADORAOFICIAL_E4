<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$smtp_user = $_ENV['SMTP_USER'] ?? 'No definido';
$smtp_password = $_ENV['SMTP_PASSWORD'] ?? 'No definido';

$response_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'] ?? '';

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
        $mail->addAddress($correo, 'Destinatario');

        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de HotelLagunaInn";
        $mail->Body = "
        <html>
        <head>
            <style>
                body {
                    font-family: 'Helvetica Neue', Arial, sans-serif;
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
                    background-image: url('../LOGOHLI.png'); /* Cambia esta URL por la del fondo deseado */
                    background-size: cover;
                }
                .header {
                    background-color: #dc3545;
                    color: white;
                    padding: 10px 0;
                    text-align: center;
                    border-radius: 10px 10px 0 0;
                }
                .content {
                    padding: 20px;
                    background: rgba(255, 255, 255, 0.9);
                    border-radius: 10px;
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
                    <h2>Confirmación de la reservación</h2>
                </div>
                <div class=\"content\">
                    <p><strong>Nombre:</strong> Hotel Laguna Inn</p>
                    <p><strong>Teléfono:</strong> 87-15-73-25-05</p>
                    <p><strong>Mensaje:</strong></p>
                    <h1>¡Muchas Gracias!</h1>
                    <p>Su reservación fue exitosa en nuestro hotel. Muchas gracias por su reservación.</p>
                    <p> /\_/\<br>( o.o )<br> > ^ < <br></p>
                </div>
                <div class=\"footer\">
                    <p>Este es un mensaje automático de nuestro sitio web.</p>
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
?>
