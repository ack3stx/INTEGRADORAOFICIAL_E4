<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/Login.css">
</head>
<body>
    <html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wight@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <style>
        .container {
    opacity: .9;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 
                0 10px 10px rgba(0, 0, 0, 0.22);
    position: relative;
    overflow: hidden;
    min-height: 450px;
    width: 600px;
    max-width: 100%;
}

@media (max-width: 1000px)
{
    .container {
        min-height: 400px;
        width: 550px;
    }
}

@media (max-width: 600px)
{
    .container {
        min-height: 350px;
        width: 440px;
    }
}

    </style>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand p-2 w-25 h-50 d-inline-block" href="#">
        <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 180px; height: 80px;" class="rounded-circle rounded-1">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav text-center">
          <li class="nav-item">
            <a class="nav-link" href="../index.html"><label>INICIO</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="nosotros.php"><label>NOSOTROS</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vistahab.php"><label>HABITACIONES</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.html #2424"><label>SERVICIOS</label></a>
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
<div class="row">
    <div class="container media-breakpoint-up sm media-sm md media-md lg media-lg" >
        <div class="form-container sign-up-container">
            <form action="#">
                <h1>Registrarse</h1>
                <input type="text" placeholder="Nombre" />
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Contraseña" />
                <button>Registrar</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#">
                <h1>Iniciar Sesión</h1>
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Contraseña" />
                <button  onclick="location.href='Panel_Admin.php'">Iniciar Sesión</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left" style="padding: 0%; background:maroon;
                background: -webkit-linear-gradient(to right, maroon, white);
                background: linear-gradient(to right, maroon, white);
                color: black;">
                    <h1>¡Que tal, Bienvenido!</h1>
                    <p>Ingresa tus datos para registrarte en la pagina y poder reservar</p>
                    <p></p>
                    <button class="ghost" id="signIn">Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right" style="padding: 0%; background:maroon;
                background: -webkit-linear-gradient(to right, white, maroon);
                background: linear-gradient(to right, white, maroon);
                color: black;">
                    <h1>¡Bievenido, de nuevo!</h1>
                    <p>Ingresa correo y contraseña para iniciar sesion</p>
                    <button class="ghost" id="signUp">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.querySelector('.container');
        
        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });
        
        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
        </script>
</body>
</html>
