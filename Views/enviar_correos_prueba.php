<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007BFF;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #FF0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulario de Contacto</h2>
        <?php if (!empty($response_message)): ?>
            <div class="message"><?php echo $response_message; ?></div>
        <?php endif; ?>
        <form action="../Scripts/correo_confirmacion_reservacion.php" method="POST">

            <label for="correo">Correo Electrónico para enviar el mensaje</label>
            <input type="email" id="correo" name="correo" required>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
