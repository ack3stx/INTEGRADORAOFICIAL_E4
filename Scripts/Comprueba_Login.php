<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php
    /*
    $ip = $_SERVER['REMOTE_ADDR'];
    $capchat = $_POST['g-recaptcha-response'];
    $secretkey = "6LccmR0qAAAAAA0xfHs9zDOwVUDtzPU-6Y7_5yi4";
    $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$capchat&remoteip=$ip");
    $atributos = json_decode($respuesta, TRUE);
    if(!$atributos['success']){
        header('Location: ../Views/Login.php?status=failed_capchat');
        exit();
    }
        */
        include '../Clases/BasedeDatos.php';
        $db=new Database();
        $db->conectarDB();

        extract($_POST);

        $db->verificar($user,$pass);
        $db->desconectarBD();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>