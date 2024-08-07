<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/check2.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <?php
        $ip = $_SERVER['REMOTE_ADDR'];
        $capchat = $_POST['g-recaptcha-response'];
        $secretkey = "6LccmR0qAAAAAA0xfHs9zDOwVUDtzPU-6Y7_5yi4";
        $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$capchat&remoteip=$ip");
        $atributos = json_decode($respuesta, TRUE);
        if(!$atributos['success']){
            header('Location: ../views/Login.php?status=failed');
            exit();
        }
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$smtp_user = $_ENV['SMTP_USER'] ?? 'No definido';
$smtp_password = $_ENV['SMTP_PASSWORD'] ?? 'No definido';

$response_message = '';

include '../Clases/BasedeDatos.php';
$db=new Database();
$db->conectarDB();

extract($_POST);
if ($contra==$contra2)
{
$hash = password_hash($contra,PASSWORD_DEFAULT);

$cadena = "CALL RegistrarUsuarioHuesped('$usuario','$hash','$correo');";

$db->ejecuta($cadena);

$smtp_user = $_ENV['SMTP_USER'] ?? 'No definido';
$smtp_password = $_ENV['SMTP_PASSWORD'] ?? 'No definido';

$response_message = '';

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
                    background-image: url('../LOGOHLI.png');
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
                    <h2>Registro Exitoso.</h2>
                </div>
                <div class=\"content\">
                    <p><strong>Nombre:</strong> Hotel Laguna Inn</p>
                    <p><strong>Mensaje:</strong></p>
                    <h1>¡Su Registro Ah Sido Exitoso!</h1>
                    <p>Su Cuenta ah sido registrada Exitosamente</p>
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
    } catch (Exception $e) {
        $response_message = "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    }
    header('Location: ../views/Login.php?status=registro_exitoso');
  exit();
}
*/

include '../Clases/BasedeDatos.php';
$db=new Database();
$db->conectarDB();

extract($_POST);
if ($contra==$contra2)
{
$hash = password_hash($contra,PASSWORD_DEFAULT);

$cadena = "CALL RegistrarUsuarioHuesped('$usuario','$hash','$correo');";

$db->ejecuta($cadena);
}
/*
else
{
  header("location:../Views/Login.php");
}
  */
?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>