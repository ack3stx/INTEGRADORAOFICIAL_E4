<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
    <link rel="stylesheet" href="../Estilos/Barra.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        body {
            background-image: url(../Imagenes/SILLONES.png);
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 80px;
        }
        .login-card {
            width: 600px;
            height: 550px;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
            animation: fadeIn 1s ease-in-out;
        }
        .login-card h3 {
            color: #0056b3;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .error {
            color: red;
            display: none;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4">
      <div class="container-fluid">
        <a class="navbar-brand p-2 w-25 h-50 d-inline-block" href="../index.php">
          <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;" class="rounded-circle rounded-1">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul class="navbar-nav text-center">
            <li class="nav-item">
              <a class="nav-link" href="../index.php"><label>INICIO</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="nosotros.php"><label>NOSOTROS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="vistahab.php"><label>HABITACIONES</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php #2424"><label>SERVICIOS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contacto.php"><label>CONTACTANOS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Login.php"><label>INICIAR SESION</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Calendario.php"><label>RESERVAR AHORA</label></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</header>

<!-- AQUI INICIALIZO EL LOGIN -->
<section id="reservaciones" class="content-section">
    <div class="container login-container">
        <div class="card login-card">
            <div class="card-body">
                <h3 class="text-center" style="color: maroon;">Iniciar Sesion</h3><br><br>
                <form action="../Scripts/Comprueba_Login.php" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text fas fa-user" id="basic-addon1"></span>
                        <input type="text" class="form-control" id="email" placeholder="Usuario" name="user">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text fas fa-lock" id="basic-addon1"></span>
                        <input type="password" class="form-control" id="loginPassword" placeholder="Contraseña" name="pass" required>
                    </div>
                    <div class="mb-3">
            <div class="g-recaptcha" data-sitekey="6LccmR0qAAAAAMnf_ciVols2t2F9ned4iYeWxHT4">

            </div>
                    <br>
                    <button type="submit" class="btn text-light btn-block" style="background-color: maroon;">Entrar</button>
                </form><br>
                <?php
        if (isset($_GET['status']) && $_GET['status'] == 'failed_login') {
            echo '<div class="alert alert-danger">Usuario O Contraseña Incorrectos.</div>';
          }
          if (isset($_GET['status']) && $_GET['status'] == 'failed_capchat') {
            echo '<div class="alert alert-danger">Por favor, completa el reCAPTCHA correctamente.</div>';
          }
          if (isset($_GET['status']) && $_GET['status'] == 'failed') {
            echo '<div class="alert alert-danger">Por favor, completa el reCAPTCHA correctamente Para Poder Registrarse.</div>';
          }
          if (isset($_GET['status']) && $_GET['status'] == 'registro_exitoso') {
            echo '<div class="alert alert-success">Usuario Registrado Exitosamente</div>';
          }
        ?>
                <h6>No tienes cuenta? <a href="#" onclick="showSection('Registrate')">Registrate aqui</a></h6>
            </div>
        </div>
    </div>
</section>




<!-- AQUI INICIALIZA EL REGISTRARSE -->

<section id="Registrate" class="content-section">
    <div class="container login-container">
        <div class="card login-card">
            <div class="card-body">
                <h3 class="text-center" style="color: maroon;">Registrate</h3><br>
                <form action="../Scripts/Registra_Usuario_Huesped.php" method="post" onsubmit="return validarContraseñas()">
                    <div class="input-group mb-3">
                        <span class="input-group-text fas fa-user" id="basic-addon1"></span>
                        <input type="text" class="form-control" id="user" placeholder="Nombre de Usuario" name="usuario">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text fas fa-envelope" id="basic-addon1"></span>
                        <input type="email" class="form-control" id="email" placeholder="Correo" name="correo" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text fas fa-lock" id="basic-addon1"></span>
                        <input type="password" class="form-control" id="registerPassword" placeholder="Contraseña" name="contra" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text fas fa-lock" id="basic-addon1"></span>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmar Contraseña" name="contra2" required>
                    </div>
                    <span id="error" class="error">Las contraseñas no coinciden</span><br>
                    <div class="mb-3">
            <div class="g-recaptcha" data-sitekey="6LccmR0qAAAAAMnf_ciVols2t2F9ned4iYeWxHT4">

            </div>
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: maroon;">Registrarte</button>
                </form>
                <h6>Ya tienes cuenta? <a href="#" onclick="showSection('reservaciones')">Inicia Sesion aqui</a></h6>
            </div>
            <?php
        ?>
        </div>
    </div>
</section>

<script>
    function validarContraseñas() {
        var password = document.getElementById('registerPassword').value;
        var confirmPassword = document.getElementById('confirmPassword').value;
        var error = document.getElementById('error');

        if (password !== confirmPassword) {
            error.style.display = 'block';
            return false;
        } else {
            error.style.display = 'none';
            return true;
        }
    }

    document.getElementById('registerPassword').addEventListener('input', function() {
        validarContraseñas();
    });

    document.getElementById('confirmPassword').addEventListener('input', function() {
        validarContraseñas();
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../Js/Panel_Admin.js"></script>
</body>
</html>
