<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
</head>
<body>
<div class="container login-container">
            <div class="card login-card">
                <div class="card-body">
                    <h3 class="text-center" style="color: maroon;">Registrate</h3><br><br>
                    <form action="../Scripts/Agregar_admin.php" method="post">
                        <div class="input-group mb-3">
                            <span class="input-group-text fas fa-user" id="basic-addon1"></span>
                            <input type="text" class="form-control" id="user" placeholder="Nombre de Usuario" name="usuario" required>
                        </div><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text fas fa-envelope" id="basic-addon1"></span>
                            <input type="email" class="form-control" id="email" placeholder="Correo" name="correo" required>
                        </div><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text fas fa-lock" id="basic-addon1"></span>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña" name="contra" required>
                        </div><br>
                        <button type="submit" class="btn btn-primary btn-block" style="background-color: maroon;">Registrarte</button>
                    </form><br>
                    <h6>No tienes cuenta?  <a href="#" onclick="showSection('reservaciones')">Inicia Sesion aqui</a></h4>
                </div>
            </div>
        </div>
</body>
</html>