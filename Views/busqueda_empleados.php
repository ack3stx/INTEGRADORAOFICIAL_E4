<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
</head>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionista.css">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
</head>
<body>
<?php
  session_start();
  include '../Clases/BasedeDatos.php';
  
  $db = new Database();
  $db->conectarDB();

  if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "administrador") {
?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand" href="Panel_Admin.php">Hotel Laguna Inn</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="busqueda_reserva.php">
              <i class="fas fa-book"></i> Reservaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_reservas_fisicas_admin.php">
              <i class="fas fa-book"></i> Reservas Fisicas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_habitaciones.php">
              <i class="fas fa-bed"></i> Habitaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_huesped.php">
              <i class="fas fa-users"></i> Huesped
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_empleados.php">
              <i class="fas fa-user"></i> Personal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reportes_hotel.php">
              <i class="fas fa-hotel"></i> Hotel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_facturacion.php">
              <i class="fas fa-file-alt"></i> Facturacion
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="costos.php">
              <i class="fas fa-dollar-sign"></i> Costos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notificaciones.php">
            <button type="button" class="btn btn-danger position-relative fas fa-envelope">
  <span class="position-absolute top-1 start-75 translate-middle p-1 bg-success border border-light rounded-circle">
    <span class="visually-hidden"></span>
  </span>
</button>
            </a>
          </li>
        </ul>
        <div class="header-right">
          <div class="btn-group">
          <?php
  if (isset($_SESSION["usuario"])) 
  {
    echo "<button class='btn btn-danger dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
              ".$_SESSION["usuario"]."
            </button>";
  }
  ?>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="cambiar_datos_cuenta_admin.php">Cuenta</a></li>
  
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="../Scripts/Cerrar_Sesion.php">Cerrar Sesión</a></li>
            </ul>
          </div>
          <i class="fas fa-user text-white ml-2"></i>
        </div>
      </div>
    </div>
  </nav>

  <h2 class="color-hotel">Personal</h2>
                <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalpersonal">
    Agregar Nuevo Empleado
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="modalpersonal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Nuevo Empleado</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="personalForm" class="toggle-form" onsubmit="addData(event, 'personal')" action="../Scripts/Registra_Usuario_Recepcionista.php" method="post">
            <h5>CREACION DE USUARIO</h5><br>
                <label for="staffEmail">Nombre de Usuario:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="usuario" required  maxlength="30"><br>
                <label for="staffEmail">Email:</label>
                <input class="form-control me-2" type="email" id="staffEmail" name="correo" required maxlength="40"><br>
                <label for="staffEmail">Contraseña:</label>
                <input class="form-control me-2" type="password" id="staffEmail" name="contra" required maxlength="30"><br>
                <h5>INFORMACION</h5>
                <label for="staffName">Nombre:</label>
                <input class="form-control me-2" type="text" id="staffName" name="nombre" required maxlength="30"><br>
                <label for="staffName">Apellido Paterno:</label>
                <input class="form-control me-2" type="text" id="staffName" name="ap_paterno" required maxlength="30"><br>
                <label for="staffName">Apellido Materno:</label>
                <input class="form-control me-2" type="text" id="staffName" name="ap_materno" required maxlength="30"><br>
                <label for="staffName">Fecha Nacimiento:</label>
                <input class="form-control me-2" type="date" id="f_nac" name="f_nac" required min="1950-01-01" max="<?= date('Y-m-d', strtotime('-18 years')) ?>"><br>
                <label for="staffName">Direccion:</label>
                <input class="form-control me-2" type="text" id="staffName" name="direccion" required maxlength="100"><br>
                <label for="staffName">Ciudad:</label>
                <input class="form-control me-2" type="text" id="staffName" name="ciudad" required maxlength="50"><br>
                <label for="staffName">Estado:</label>
                <input class="form-control me-2" type="text" id="staffName" name="estado" required maxlength="50"><br>
                <label for="staffName">Codigo Postal:</label>
                <input class="form-control me-2" type="text" id="staffName" name="cd_postal" required maxlength="5"><br>
                <label for="staffName">Pais:</label>
                <input class="form-control me-2" type="text" id="staffName" name="pais" required maxlength="50"><br>
                <label for="staffName">Genero:</label>
                <select class="form-control me-2" id="roomStatus" name="genero" required>
                  <option class="form-control me-2" value="H">Hombre</option>
                  <option class="form-control me-2" value="M">Mujer</option>
                </select><br>
                <label for="staffName">Telefono:</label>
                <input class="form-control me-2" type="text" id="staffName" name="telefono" required maxlength="10"><br>
              <h5>INFORMACION PERSONAL</h5><br>
                <label for="staffEmail">Curp:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="curp" required maxlength="18"><br>
                <label for="staffEmail">Fecha Contratacion:</label>
                <input class="form-control me-2" type="date" id="f_cont" name="f_cont" required max="<?= date('Y-m-d', strtotime('-18 years')) ?>"><br>
                <label for="staffEmail">Nss:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="nss" required maxlength="11"><br>
                <label for="staffEmail">Afore:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="afore" required maxlength="30"><br>
                <label for="staffEmail">Numero Emergencia:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="num2" required maxlength="10"><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark text text-light btn btn-outline-warning" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-dark text text-light btn btn-outline-warning" id="submitButton">Agregar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <br><br>
                <h4 class="color-hotel">Busqueda</h4>
<form class="d-flex" role="search" method="post">
    <input class="form-control me-2" type="text" placeholder="Nombre" aria-label="Nombre" name="nombre" id="nombre">
    <input class="form-control me-2" type="text" placeholder="Apellido Paterno" aria-label="Apellido Paterno" name="ap_paterno" id="ap_paterno">
    <input class="form-control me-2" type="text" placeholder="Apellido Materno" aria-label="Apellido Materno" name="ap_materno" id="ap_materno">
    <button class="btn btn-outline-danger" type="submit" id="buscar-btn" >Buscar</button>
</form>

                <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    if (!empty($nombre) && !empty($ap_paterno) && !empty($ap_materno)) {
        $cadena = "SELECT CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO, ' ', PERSONA.APELLIDO_MATERNO) AS NOMBRE, 
                          PERSONA.FECHA_DE_NACIMIENTO, PERSONA.DIRECCION, PERSONA.CIUDAD, PERSONA.ESTADO, PERSONA.CODIGO_POSTAL, 
                          PERSONA.PAIS, PERSONA.GENERO, PERSONA.NUMERO_DE_TELEFONO, RECEPCIONISTA.CURP, 
                          RECEPCIONISTA.FECHA_DE_CONTRATACION, RECEPCIONISTA.NUMERO_DE_SEGURIDAD_SOCIAL, 
                          RECEPCIONISTA.AFORE, RECEPCIONISTA.NUMERO_DE_EMERGENCIA
                   FROM PERSONA
                   INNER JOIN RECEPCIONISTA ON RECEPCIONISTA.PERSONA_RECEPCIONISTA = PERSONA.ID_PERSONA 
                   WHERE PERSONA.NOMBRE = '$nombre' 
                   AND PERSONA.APELLIDO_PATERNO = '$ap_paterno' 
                   AND PERSONA.APELLIDO_MATERNO = '$ap_materno'";
        $tabla = $db->seleccionar($cadena);

        if (empty($tabla)) {
            echo "<p>El empleado no existe.</p>";
        } else {
            echo "
            <div class='table-responsive h-25'>
                <table class='table table-hover table-bordered table-danger'>
                    <thead class='table-dark'>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Dirección</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>Código Postal</th>
                            <th>País</th>
                            <th>Género</th>
                            <th>Teléfono</th>
                            <th>CURP</th>
                            <th>Fecha de Contratación</th>
                            <th>Número de Seguro Social</th>
                            <th>Afore</th>
                            <th>Número de Emergencia</th>
                        </tr>
                    </thead>
                    <tbody>
            ";

            foreach ($tabla as $reg) {
                echo "
                        <tr>
                            <td>{$reg->NOMBRE}</td>
                            <td>{$reg->FECHA_DE_NACIMIENTO}</td>
                            <td>{$reg->DIRECCION}</td>
                            <td>{$reg->CIUDAD}</td>
                            <td>{$reg->ESTADO}</td>
                            <td>{$reg->CODIGO_POSTAL}</td>
                            <td>{$reg->PAIS}</td>
                            <td>{$reg->GENERO}</td>
                            <td>{$reg->NUMERO_DE_TELEFONO}</td>
                            <td>{$reg->CURP}</td>
                            <td>{$reg->FECHA_DE_CONTRATACION}</td>
                            <td>{$reg->NUMERO_DE_SEGURIDAD_SOCIAL}</td>
                            <td>{$reg->AFORE}</td>
                            <td>{$reg->NUMERO_DE_EMERGENCIA}</td>
                        </tr>
                ";
            }

            echo "
                    </tbody>
                </table>
            </div>
            ";
        }

        $db->desconectarBD();
    }
}
?>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <?php
    $db->desconectarBD();
  } else {
  ?>
<head>
  <style>
    body, html {
      height: 100%;
    }
    .bg-dark {
      background-color: #343a40 !important;
    }
    .flex-center {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      color: white;
    }
    .error-container {
      text-align: center;
    }
    .error-icon {
      font-size: 100px;
    }
    .error-code {
      font-size: 80px;
      margin-bottom: 20px;
    }
    .error-message {
      font-size: 24px;
    }
  </style>
</head>
<body class="bg-dark">
  <div class="container flex-center">
    <div class="error-container">
      <i class="fas fa-times-circle error-icon"></i>
      <div class="error-code">404</div>
      <div class="error-message">Pagina no Encontrada</div>
      <p>Es posible que la página que está buscando se haya eliminado, haya cambiado de nombre o no esté disponible temporalmente.</p>
      <a href="../index.php" class="btn btn-primary mt-4">Pagina Principal</a>
    </div>
  </div>
</body>
<?php
  }
?>
</body>
</html>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const exemptInputs = ['correo', 'contra', 'direccion', 'usuario'];
    const alphaInputs = ['nombre', 'ap_paterno', 'ap_materno', 'estado', 'ciudad', 'pais', 'afore'];
    const numericInputs = ['telefono', 'cd_postal', 'nss', 'num2'];
    const alphanumericInputs = ['curp'];
    
    const inputs = document.querySelectorAll('input[type="text"], input[type="date"]');
    const submitButton = document.getElementById('submitButton');
    const f_nac = document.getElementById('f_nac');
    const f_cont = document.getElementById('f_cont');

    function validateInputs() {
        let allValid = true;

        inputs.forEach(input => {
            const fieldName = input.getAttribute('name');
            const inputValue = input.value.trim();  // Eliminar espacios en blanco

            console.log(`Validando campo: ${fieldName} con valor: ${inputValue}`); // Para depuración

            if (alphaInputs.includes(fieldName)) {
                if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(inputValue)) {
                    input.style.borderColor = 'red';
                    allValid = false;
                } else {
                    input.style.borderColor = '';
                }
            } else if (numericInputs.includes(fieldName)) {
                if (!/^\d+$/.test(inputValue) || inputValue.length < 5) {
                    input.style.borderColor = 'red';
                    allValid = false;
                } else {
                    input.style.borderColor = '';
                }
            } else if (alphanumericInputs.includes(fieldName)) {
                if (!/^[a-zA-Z0-9]+$/.test(inputValue)) {
                    input.style.borderColor = 'red';
                    allValid = false;
                } else {
                    input.style.borderColor = '';
                }
            } else if (inputValue === '') {
                input.style.borderColor = 'red';
                allValid = false;
            } else {
                input.style.borderColor = '';
            }
        });

        console.log(`Inputs válidos: ${allValid}`); // Para depuración
        return allValid;
    }

    function calculateAge(birthday) {
        const today = new Date();
        const birthDate = new Date(birthday);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age;
    }

    function validateDates() {
        const nacDate = f_nac.value;
        const contDate = f_cont.value;
        const today = new Date().toISOString().split('T')[0];
        let valid = true;

        if (nacDate) {
            const age = calculateAge(nacDate);

            if (age < 18) {
                f_nac.style.borderColor = 'red';
                valid = false;
            } else {
                f_nac.style.borderColor = 'green';
            }

            const minDate = f_nac.getAttribute('min');
            if (new Date(nacDate) < new Date(minDate)) {
                f_nac.style.borderColor = 'red';
                valid = false;
            }
        }

        if (contDate) {
            if (new Date(contDate) > new Date(today)) {
                f_cont.style.borderColor = 'red';
                valid = false;
            } else {
                f_cont.style.borderColor = 'green';
            }

            if (nacDate && calculateAge(nacDate) >= 18) {
                const allowedMinContDate = new Date(nacDate);
                allowedMinContDate.setFullYear(allowedMinContDate.getFullYear() + 18);

                if (new Date(contDate) < allowedMinContDate) {
                    f_cont.style.borderColor = 'red';
                    valid = false;
                }
            }
        }

        console.log(`Fechas válidas: ${valid}`); // Para depuración
        return valid;
    }

    function validateForm() {
        const inputsValid = validateInputs();
        const datesValid = validateDates();

        const isFormValid = inputsValid && datesValid;
        console.log(`Formulario válido: ${isFormValid}`); // Para depuración

        // Habilitar o deshabilitar el botón de enviar basado en las validaciones
        submitButton.disabled = !isFormValid;
    }

    validateForm();

    inputs.forEach(input => {
        input.addEventListener('input', validateForm);
    });

    f_nac.addEventListener('input', validateForm);
    f_cont.addEventListener('input', validateForm);
});
</script>




