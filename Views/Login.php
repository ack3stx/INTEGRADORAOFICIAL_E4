<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laguna Inn - Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            width: 600px;
            height: 500px;
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
    </style>
</head>
<body>
    <section id="Sesion">
        <div class="container login-container">
            <div class="card login-card">
                <div class="card-body">
                    <h3 class="card-title text-center">Laguna Inn - Iniciar Sesion</h3><br><br>
                    <form>
                        <div class="input-group mb-3">
                            <span class="input-group-text fas fa-envelope" id="basic-addon1"></span>
                            <input type="email" class="form-control" id="email" placeholder="Correo" required>
                        </div><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text fas fa-lock" id="basic-addon1"></span>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                        </div><br>
                        <button type="submit" class="btn text-light btn-block" style="background-color: maroon;">Entrar</button>
                    </form><br>
                    <h6>No tienes cuenta?  <a href="#Registrate" onclick="showSection('Registrate')">Registrate aqui</a></h4>
                </div>
            </div>
        </div>
    </section>
    <section id="Registrate" class="content-section">
        <div class="container login-container">
            <div class="card login-card">
                <div class="card-body">
                    <h3 class="card-title text-center">Laguna Inn - Registrate</h3><br><br>
                    <form>
                        <div class="input-group mb-3">
                            <span class="input-group-text fas fa-user" id="basic-addon1"></span>
                            <input type="email" class="form-control" id="user" placeholder="Nombre de Usuario" required>
                        </div><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text fas fa-envelope" id="basic-addon1"></span>
                            <input type="email" class="form-control" id="email" placeholder="Correo" required>
                        </div><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text fas fa-lock" id="basic-addon1"></span>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                        </div><br>
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </form><br>
                    <h6>No tienes cuenta?  <a href="#Sesion" onclick="showSection('Sesion')">Inicia Sesion aqui</a></h4>
                </div>
            </div>
        </div>
    </section>
    <script src="../Js/Panel_Admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
