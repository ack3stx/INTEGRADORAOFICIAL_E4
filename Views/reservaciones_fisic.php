<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'recepcionista') {
    ?>
<?php
include '../Clases/BasedeDatos.php';
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página no Encontrada</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
    </html>
    <?php
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="../Estilos/reservafisica.css">
        <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
        <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionista.css">
    <title>Habitacion Rserva</title>
</head>

<body>
<style>
    .hidden{
        display: none;
    }

   .containers {
            display: flex;
            border: 1px solid black;
            border-radius: 20px;
            width: 40rem;
            height: 2rem;
            align-items: center;
          gap: 40px;
          padding: 0 120px;
          margin-left: 30%;
          margin-top: 3%;
        }

        .container input {
            flex: 1;
            height: 60%;
            width: 30%;
           
        }

        #card-container {
            display: none;
            max-width: 550px;
        }


        #scrollableModal{
            display: none;
        }
        
      
        #contenedor-fluido{
            display:block;
        }

    /*rgb(116, 13, 13);*/

    /*PIE DE PAGINA */

    .footer {
    background-color: rgb(116, 13, 13);
    color: white;
    padding: 20px 0;
    width: 100%;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    width: 100%;
    padding: 0 20px;
    color: white;
}
.footer-section {
    flex: 1;
    min-width: 200px;
    margin: 10px;
    color: white;
}
.footer-section h2 {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: white;
}
.footer-section p {
    margin: 5px 0;
    color: white;
}
.social-icons i {
    font-size: 1.2rem;
    margin-right: 10px;
    color: white;
}
@media (min-width: 768px) {
    .footer-section h2 {
        font-size: 1.5rem;
    }
    .footer-section p {
        font-size: 1rem;
    }
    .social-icons i {
        font-size: 1.5rem;
    }
}



.container{
    width: 30%;
    height: 50%;
    margin-left: 60%;
    margin-top: 10%;
    flex-wrap:wrap;
}


.conca {
        border-radius: 10px;
        border: 2px solid black;
        margin-left:10%
        


    }

    #añadir1 {
        margin-top: 40%;
        margin-left: -3%
    }

 
  .dropdown-toggle{
margin-bottom: 1%;

  }

  #info1{
    display:none;
  }

  #persona{
    width: 30%;
    height: 50%;
    margin-left: 20%;
    margin-top: 10%;
    display: inline-block;
  }

</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid h-25">
      <a class="navbar-brand" href="panel_recepcionista.php">Hotel Laguna Inn</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="reservaciones_fisicas.php">
              <i class="fas fa-calendar-plus"></i>Crear Reserva
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_reserva_recepcionista.php">
              <i class="fas fa-book"></i>Reservaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_habitaciones_recepcionista.php">
              <i class="fas fa-bed"></i>Habitaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_huesped_recepcionista.php">
              <i class="fas fa-users"></i>Huesped
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="check_in.php">
              <i class="fas fa-users"></i>Check-in
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="check_out.php">
              <i class="fas fa-users"></i>Check-out
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reservaciones_activas.php">
              <i class="fas fa-users"></i>Extender
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notificaciones_recepcionista.php">
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
            if (isset($_SESSION["usuario"])) {
              echo "<button class='btn btn-danger dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
                      ".$_SESSION["usuario"]."
                    </button>";
            }
          ?>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="cambiar_datos_cuenta_recepcionista.php">Cuenta</a></li>
              
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
  
     <!-- BARRITA BLANCA-->
      <form id="form" method="POST">
      <div class="barra-blanca">
        <div class="containers">
        <input type="text" id="startDate" placeholder="Fecha de inicio"> 
        <input type="text" id="endDate" placeholder="Fecha de fin">
        </div>

        
    </div>
</form>




<div class="d-flex justify-content-start flex-wrap position-relative w-50 p-0" id="contenedor-fluido">
    
</div>

<!--
<div class="modal fade" id="scrollableModal" tabindex="-1" aria-labelledby="scrollableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalLabel">Resumen de la Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-content">
                El contenido dinámico se insertará aquí 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-success" type="button">Reservar Ahora</button> <br>
                <button class="btn btn-danger" type="button" onclick="borrarCambios()">Borrar Cambios</button>
            </div>
        </div>
    </div>
</div> -->

   <!-- Modal DE ADVERTENCIA 
   <div class="modal fade" id="exampleModalTogglee" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Advertencia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Seleccione la cantidad de personas que estarán en la habitación.
                    <br>
                    Hotel Laguna Inn.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

     Modal de CANCELACION
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Cambios Descartados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Los cambios han sido descartados.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


CARD DE CONTENIDOO CUANDO SE JUNTAN MAS DE 5 HABITACIONES
<div class="card" id="card-container">
        <img src="../Imagenes/RECEPCION.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Tus habitaciones</h5>
            <p class="card-text">Mira el resumen de tu reserva</p>
            <p><strong>Total &nbsp;&nbsp;&nbsp;&nbsp; MXN <span id="card-total-price">0.00</span></strong></p>
            <a href="#" class="btn btn-primary" id="ver-mas-btn">Ver más</a>
            <div class="modal fade" id="scrollableModal" tabindex="-1" aria-labelledby="scrollableModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollableModalLabel">Resumen de la Reserva</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modal-body-content">
                            <div id="card-room-summary">
                                Resumen breve de habitaciones 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-success" type="button" id="porsilasdudas">Reservar Ahora</button> <br>
                            <button class="btn btn-danger" type="button" >Borrar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<!--FORMULARIO PERSONA-->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">DATOS PERSONALES</h1>
      </div>
      <div class="modal-body">
      <form id="form-persona"">
      <h5>INFORMACION</h5>
                <label for="staffName">Nombre:</label>
                <input class="form-control me-2" type="text" id="staffName" name="nombre" required><br>
                <label for="staffName">Apellido Paterno:</label>
                <input class="form-control me-2" type="text" id="staffName" name="ap_paterno" required><br>
                <label for="staffName">Apellido Materno:</label>
                <input class="form-control me-2" type="text" id="staffName" name="ap_materno" required><br>
                <label for="staffName">Fecha Nacimiento:</label>
                <input class="form-control me-2" type="date" id="f_nac" name="f_nac" required><br>
                <label for="staffName">Direccion:</label>
                <input class="form-control me-2" type="text" id="staffName" name="direccion" required><br>
                <label for="staffName">Ciudad:</label>
                <input class="form-control me-2" type="text" id="staffName" name="ciudad" required><br>
                <label for="staffName">Estado:</label>
                <input class="form-control me-2" type="text" id="staffName" name="estado" required><br>
                <label for="staffName">Codigo Postal:</label>
                <input class="form-control me-2" type="text" id="staffName" name="cd_postal" required><br>
                <label for="staffName">Pais:</label>
                <input class="form-control me-2" type="text" id="staffName" name="pais" required><br>
                <label for="staffName">Genero:</label>
                <select class="form-control me-2" id="roomStatus" name="genero" required>
                  <option class="form-control me-2" value="H">Hombre</option>
                  <option class="form-control me-2" value="M">Mujer</option>
                </select><br>
                <label for="staffName">Telefono:</label>
                <input class="form-control me-2" type="text" id="staffName" name="telefono" required><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Aceptar</button>
        </form>   
      </div>
    </div>
  </div>
</div> 





<!---->
<div id="info1" class="container" style="display: none;
    position: absolute;
    top: 50%;
    left: 30%;
    transform: translate(-50%, -50%);
    height: 100%;
">
    <div class="card card-custom">
        <div class="card-body">
            <h5 class="card-title custom1">Resumen de la Reserva</h5>
            <h6  id="fechas" class="card-subtitle custom2 mb-2 text-muted">12 jul -> 13 jul</h6> <!--ESPACIO PARA MOSTRAR LAS FECHAS-->
            <button type="button" id="noches" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                <i class="fa-solid fa-moon">&nbsp;&nbsp;&nbsp;&nbsp;1 noche</i>
            </button>
            <br><br>
            <hr class="mb-4">
            <div id="room-summary">
                <!-- Resumen breve de habitaciones -->
            </div>
            <p><strong>Total &nbsp;&nbsp;&nbsp;&nbsp; MXN <span id="total-price">0.00</span></strong></p>
            <br><br>
            <div class="d-grid gap-6 col-10 mx-auto">
                <button class="btn btn-success" type="button" id="porsilasdudas" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Reservar Ahora</button> <br>
                <button class="btn btn-success hidden" type="button" id="continuar" onclick="mostrarformulario('continuar');">Continuar</button>
                <button class="btn btn-danger" type="button" id="borrarCambios">Borrar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Advertencia 
<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="warningModalLabel">Advertencia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3>Para poder reservar, debes de seleccionar una habitación</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div> -->

     <!--PIE DE PAGINA
     <br><br>
    <br><br>
    <footer class="footer">
  <div class="footer-container">
      <div class="footer-section">
          <h2>Contáctanos</h2>
          <p><i class="fa-solid fa-house"></i> Av. de la Cantera 8510, Colonia Las Misiones I, CP 31115, Torreón, México</p>
          <p><i class="fa-solid fa-envelope"></i> hotellagunainn@inn.com</p>
          <p><i class="fa-solid fa-phone"></i> +52 (614) 432-1500</p>
          <div class="social-icons">
              <i class="fa-brands fa-instagram"></i>
              <i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-whatsapp"></i>
          </div>
      </div>
      <div class="footer-section">
          <h2>Explora</h2>
          <p>Inicio</p>
          <p>Nosotros</p>
          <p>Habitaciones</p>
          <p>Amenidades</p>
      </div>
      <div class="footer-section">
          <h2>Novedades</h2>
          <p>Recibe las últimas ofertas y promociones del Hotel Laguna Inn</p>
          <input type="text" placeholder="Email">
          <i class="fa-solid fa-paper-plane"></i>
      </div>
  </div>
</footer>-->





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      var today = new Date();

      var startDate = localStorage.getItem('fechaInicio');
  var endDate = localStorage.getItem('fechaFin');

 

       var startDatePicker = flatpickr("#startDate", {
        dateFormat: "Y-m-d",
        minDate: today,
        locale: {
          firstDayOfWeek: 1,
          weekdays: {
            shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
          },
          months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
          }
        },
        enable: [
          function(date) {
           
            return (date.getFullYear() === 2024) || 
                   (date.getFullYear() === 2025 && date.getMonth() === 0);
          }
        ],
        onChange: function(selectedDates, dateStr, instance) {
          if (selectedDates.length > 0) {
            
            var minEndDate = new Date(selectedDates[0]);
            minEndDate.setDate(minEndDate.getDate() + 1); 
            endDatePicker.set('minDate', minEndDate);
            localStorage.setItem('fechaInicio', selectedDates[0].toISOString().slice(0, 10));
            obtenerHabitaciones();
            
                
               
            
          }
        }
      });

        var endDatePicker = flatpickr("#endDate", {
        dateFormat: "Y-m-d",
        minDate: today,
        locale: {
          firstDayOfWeek: 1,
          weekdays: {
            shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
          },
          months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
          }
        },
        enable: [
          function(date) {
           
            return (date.getFullYear() === 2024) || 
                   (date.getFullYear() === 2025 && date.getMonth() === 0);
          }
        ],
        onChange: function(selectedDates, dateStr, instance) {
          if (selectedDates.length > 0) {
           
            startDatePicker.set('maxDate', selectedDates[0]);
            localStorage.setItem('fechaFin', selectedDates[0].toISOString().slice(0, 10));
            obtenerHabitaciones();
                
            
          }
        }
      });

       
    if (startDate) {
        startDatePicker.setDate(startDate);}

    if (endDate) {
        endDatePicker.setDate(endDate);}

    });

   

  </script>


<script>
  const fechaInicio = localStorage.getItem('fechaInicio')
    const fechaFinal = localStorage.getItem('fechaFin')
    var acumulador = 0;
    const price = document.getElementById('total-price');
    const noches = document.getElementById('noches');
    const fechas = document.getElementById('fechas');
    let tiposSeleccionados = [];

    function obtenerHabitaciones() {
        fetch('../servicios/obtenerHabitaciones.php', {
            body:new URLSearchParams( {
                'startDate': fechaInicio,
                'endDate': fechaFinal
            }),
            method: 'POST'
        }).then(response => {
            return response.json()
        }).then((data) => {

            const container = document.getElementById('contenedor-fluido');

            container.innerHTML = '';
            
            const habitacionesDoble = data.doble[0].doble;
                const habitacionesKingSize = data["king-size "][0]["King Size"];
                const habitacionesSencilla = data.sencilla[0].Sencilla;
            
                if (habitacionesDoble === 0 && habitacionesKingSize === 0 && habitacionesSencilla === 0) {
            alert("No hay habitaciones disponibles");
        } else {
            const container = document.getElementById('contenedor-fluido');
            if (habitacionesDoble > 0) {
               crearTarjetaDoble('Habitación Doble', 'Nuestra Habitación Doble ofrece dos cómodas camas matrimoniales en un espacio de 28 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y un sillón individual.', 'doble');
            }
            if (habitacionesKingSize > 0) {
                crearTarjetaKingSize('Habitación King Size', 'Disfruta de nuestra lujosa Habitación King Size con una cama de gran tamaño, perfecto para una estadía confortable.', 'king-size');
            }
            if (habitacionesSencilla > 0) {
                crearTarjetaSencilla('Habitación Sencilla', 'Nuestra Habitación Sencilla es ideal para viajeros solos, con una cómoda cama individual y todas las comodidades necesarias para una estadía agradable.', 'sencilla');
            }
            console.log(data);
        }
        }).catch(error => { console.log(error)})
    }

    function crearTarjetaDoble(titulo, descripcion)  {

            
            const container = document.getElementById('contenedor-fluido');
            
            const cardContainer = document.createElement('div');
            cardContainer.className = 'container-custom move-right';
            cardContainer.dataset.roomType = 'doble';
            
            const card = document.createElement('div');
            card.className = 'card card-custom';
            
            const imageContainer = document.createElement('div');
            imageContainer.className = 'image-container';
            
            const img = document.createElement('img');
            img.src = '../Imagenes/HABITACION_D.png';
            img.alt = 'Habitación Doble';
            
            imageContainer.appendChild(img);
            
            const cardBody = document.createElement('div');
            cardBody.className = 'card-body card-body-custom';
            
            const cardTitle = document.createElement('h5');
            cardTitle.className = 'card-title';
            cardTitle.innerText = 'Habitación Doble';
            
            const cardSubtitle = document.createElement('h6');
            cardSubtitle.className = 'card-subtitle mb-2 text-muted';
            cardSubtitle.innerText = 'Máximo de: 4 huéspedes';
            
            const cardText = document.createElement('p');
            cardText.className = 'card-text';
            cardText.innerText = 'Nuestra Habitación Doble ofrece dos cómodas camas matrimoniales en un espacio de 28 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y un sillón individual.';
            
            const cardFooter = document.createElement('div');
            cardFooter.className = 'card-footer-custom';
            
            const priceInfo = document.createElement('div');
            priceInfo.className = 'price-info';
            
            const price = document.createElement('h6');
            price.innerText = 'MXN 900.00';
            
            const night = document.createElement('p');
            night.innerText = '1 noche';
            
            priceInfo.appendChild(price);
            priceInfo.appendChild(night);
            
            const controls = document.createElement('div');
            controls.className = 'controls';
            
            const dropdownAdults = document.createElement('div');
            dropdownAdults.className = 'dropdown';
            
            const adultsButton = document.createElement('button');
            adultsButton.className = 'btn dropdown-toggle';
            adultsButton.type = 'button';
            adultsButton.id = 'doble-adults';
            adultsButton.setAttribute('data-bs-toggle', 'dropdown');
            adultsButton.setAttribute('aria-expanded', 'false');
            adultsButton.innerText = 'Adultos';
            
            const adultsMenu = document.createElement('ul');
            adultsMenu.className = 'dropdown-menu';
            adultsMenu.setAttribute('aria-labelledby', 'doble-adults');
            
           
             const adultOption = document.createElement('li');
             adultOption.innerHTML = '<a class="dropdown-item" href="#">Adult Option</a>';
            adultsMenu.appendChild(adultOption);
            
            dropdownAdults.appendChild(adultsButton);
            dropdownAdults.appendChild(adultsMenu);
            
            const dropdownKids = document.createElement('div');
            dropdownKids.className = 'dropdown';
            
            const kidsButton = document.createElement('button');
            kidsButton.className = 'btn dropdown-toggle';
            kidsButton.type = 'button';
            kidsButton.id = 'doble-kids';
            kidsButton.setAttribute('data-bs-toggle', 'dropdown');
            kidsButton.setAttribute('aria-expanded', 'false');
            kidsButton.innerText = 'Niños';
            kidsButton.disabled = true;
            
            const kidsMenu = document.createElement('ul');
            kidsMenu.className = 'dropdown-menu';
            kidsMenu.setAttribute('aria-labelledby', 'doble-kids');
            
            dropdownKids.appendChild(kidsButton);
            dropdownKids.appendChild(kidsMenu);
            
            
            const addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.className = 'btn btn-success custom-btn';
            addButton.id = 'doble';
            addButton.onclick = function() {
                mostrar();
                calcularPrecio('Doble',900);
            };
            addButton.innerText = 'Añadir';
            
            controls.appendChild(dropdownAdults);
            controls.appendChild(dropdownKids);
            controls.appendChild(addButton); 
            
            cardFooter.appendChild(priceInfo);
           cardFooter.appendChild(controls);
            
            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardSubtitle);
            cardBody.appendChild(cardText);
            cardBody.appendChild(cardFooter);
            
            card.appendChild(imageContainer);
            card.appendChild(cardBody);
            
            cardContainer.appendChild(card);
            container.appendChild(cardContainer);
        }
        

        function crearTarjetaKingSize(titulo, descripcion)  {
            
            const container = document.getElementById('contenedor-fluido');
            
            const cardContainer = document.createElement('div');
            cardContainer.className = 'container-custom move-right';
            cardContainer.dataset.roomType = 'king-size';
            
            const card = document.createElement('div');
            card.className = 'card card-custom';
            
            const imageContainer = document.createElement('div');
            imageContainer.className = 'image-container';
            
            const img = document.createElement('img');
            img.src = '../Imagenes/HABITACION_K.png';
            img.alt = 'Habitación King Size';
            
            imageContainer.appendChild(img);
            
            const cardBody = document.createElement('div');
            cardBody.className = 'card-body card-body-custom';
            
            const cardTitle = document.createElement('h5');
            cardTitle.className = 'card-title';
            cardTitle.innerText = 'Habitación King Size';
            
            const cardSubtitle = document.createElement('h6');
            cardSubtitle.className = 'card-subtitle mb-2 text-muted';
            cardSubtitle.innerText = 'Máximo de: 3 huéspedes';
            
            const cardText = document.createElement('p');
            cardText.className = 'card-text';
            cardText.innerText = 'Disfruta de nuestra lujosa Habitación King Size con una cama de gran tamaño, perfecto para una estadía confortable.';
            
            const cardFooter = document.createElement('div');
            cardFooter.className = 'card-footer-custom';
            
            const priceInfo = document.createElement('div');
            priceInfo.className = 'price-info';
            
            const price = document.createElement('h6');
            price.innerText = 'MXN 1290.00';
            
            const night = document.createElement('p');
            night.innerText = '1 noche';
            
            priceInfo.appendChild(price);
            priceInfo.appendChild(night);
            
            const controls = document.createElement('div');
            controls.className = 'controls';
            
            const dropdownAdults = document.createElement('div');
            dropdownAdults.className = 'dropdown';
            
            const adultsButton = document.createElement('button');
            adultsButton.className = 'btn dropdown-toggle';
            adultsButton.type = 'button';
            adultsButton.id = 'doble-adults';
            adultsButton.setAttribute('data-bs-toggle', 'dropdown');
            adultsButton.setAttribute('aria-expanded', 'false');
            adultsButton.innerText = 'Adultos';
            
            const adultsMenu = document.createElement('ul');
            adultsMenu.className = 'dropdown-menu';
            adultsMenu.setAttribute('aria-labelledby', 'doble-adults');
            
            
             const adultOption = document.createElement('li');
             adultOption.innerHTML = '<a class="dropdown-item" href="#">Adult Option</a>';
             adultsMenu.appendChild(adultOption);
            
            dropdownAdults.appendChild(adultsButton);
            dropdownAdults.appendChild(adultsMenu);
            
            const dropdownKids = document.createElement('div');
            dropdownKids.className = 'dropdown';
            
            const kidsButton = document.createElement('button');
            kidsButton.className = 'btn dropdown-toggle';
            kidsButton.type = 'button';
            kidsButton.id = 'doble-kids';
            kidsButton.setAttribute('data-bs-toggle', 'dropdown');
            kidsButton.setAttribute('aria-expanded', 'false');
            kidsButton.innerText = 'Niños';
            kidsButton.disabled = true;
            
            const kidsMenu = document.createElement('ul');
            kidsMenu.className = 'dropdown-menu';
            kidsMenu.setAttribute('aria-labelledby', 'doble-kids');
            
            dropdownKids.appendChild(kidsButton);
            dropdownKids.appendChild(kidsMenu); 
            
            const addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.className = 'btn btn-success custom-btn';
            addButton.id = 'king';
            addButton.onclick = function() {
                mostrar();
                calcularPrecio('King Size',1200);
            };
            addButton.innerText = 'Añadir';
            
            controls.appendChild(dropdownAdults);
            controls.appendChild(dropdownKids);
            controls.appendChild(addButton); 
            
            cardFooter.appendChild(priceInfo);
           cardFooter.appendChild(controls);
            
            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardSubtitle);
            cardBody.appendChild(cardText);
            cardBody.appendChild(cardFooter);
            
            card.appendChild(imageContainer);
            card.appendChild(cardBody);
            
            cardContainer.appendChild(card);
            container.appendChild(cardContainer);
        }
        
        function crearTarjetaSencilla(titulo, descripcion)  {
            
            const container = document.getElementById('contenedor-fluido');
            
            const cardContainer = document.createElement('div');
            cardContainer.className = 'container-custom move-right';
            cardContainer.dataset.roomType = 'sencilla';
            
            const card = document.createElement('div');
            card.className = 'card card-custom';
            
            const imageContainer = document.createElement('div');
            imageContainer.className = 'image-container';
            
            const img = document.createElement('img');
            img.src = '../Imagenes/HABITACION_S.png';
            img.alt = 'Habitación Sencilla';
            
            imageContainer.appendChild(img);
            
            const cardBody = document.createElement('div');
            cardBody.className = 'card-body card-body-custom';
            
            const cardTitle = document.createElement('h5');
            cardTitle.className = 'card-title';
            cardTitle.innerText = 'Habitación Sencilla';
            
            const cardSubtitle = document.createElement('h6');
            cardSubtitle.className = 'card-subtitle mb-2 text-muted';
            cardSubtitle.innerText = 'Máximo de: 2 huéspedes';
            
            const cardText = document.createElement('p');
            cardText.className = 'card-text';
            cardText.innerText = 'Nuestra Habitación Sencilla es ideal para viajeros solos, con una cómoda cama individual y todas las comodidades necesarias para una estadía agradable';
            
            const cardFooter = document.createElement('div');
            cardFooter.className = 'card-footer-custom';
            
            const priceInfo = document.createElement('div');
            priceInfo.className = 'price-info';
            
            const price = document.createElement('h6');
            price.innerText = 'MXN 1290.00';
            
            const night = document.createElement('p');
            night.innerText = '1 noche';
            
            priceInfo.appendChild(price);
            priceInfo.appendChild(night);
            
            const controls = document.createElement('div');
            controls.className = 'controls';
            
            const dropdownAdults = document.createElement('div');
            dropdownAdults.className = 'dropdown';
            
            const adultsButton = document.createElement('button');
            adultsButton.className = 'btn dropdown-toggle';
            adultsButton.type = 'button';
            adultsButton.id = 'doble-adults';
            adultsButton.setAttribute('data-bs-toggle', 'dropdown');
            adultsButton.setAttribute('aria-expanded', 'false');
            adultsButton.innerText = 'Adultos';
            
            const adultsMenu = document.createElement('ul');
            adultsMenu.className = 'dropdown-menu';
            adultsMenu.setAttribute('aria-labelledby', 'doble-adults');
            
             
            const adultOption = document.createElement('li');
            adultOption.innerHTML = '<a class="dropdown-item" href="#">Adult Option</a>';
             adultsMenu.appendChild(adultOption);
            
            dropdownAdults.appendChild(adultsButton);
            dropdownAdults.appendChild(adultsMenu);
            
            const dropdownKids = document.createElement('div');
            dropdownKids.className = 'dropdown';
            
            const kidsButton = document.createElement('button');
            kidsButton.className = 'btn dropdown-toggle';
            kidsButton.type = 'button';
            kidsButton.id = 'doble-kids';
            kidsButton.setAttribute('data-bs-toggle', 'dropdown');
            kidsButton.setAttribute('aria-expanded', 'false');
            kidsButton.innerText = 'Niños';
            kidsButton.disabled = true;
            
            const kidsMenu = document.createElement('ul');
            kidsMenu.className = 'dropdown-menu';
            kidsMenu.setAttribute('aria-labelledby', 'doble-kids');
            
            dropdownKids.appendChild(kidsButton);
            dropdownKids.appendChild(kidsMenu); 
            
            const addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.className = 'btn btn-success custom-btn';
            addButton.id = 'sencilla';
            addButton.onclick = function() {
                mostrar();
                calcularPrecio('Sencilla',700);
            };
            addButton.innerText = 'Añadir';
            
            controls.appendChild(dropdownAdults);
            controls.appendChild(dropdownKids);
            controls.appendChild(addButton); 
            
            cardFooter.appendChild(priceInfo);
           cardFooter.appendChild(controls); 
            
            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardSubtitle);
            cardBody.appendChild(cardText);
            cardBody.appendChild(cardFooter);
            
            card.appendChild(imageContainer);
            card.appendChild(cardBody);
            
            cardContainer.appendChild(card);
            container.appendChild(cardContainer); 
        }  
        
        
  


  //mostramos el formulario de persona
    function mostrarformulario(buttonType) {
            var reservarboton = document.getElementById('porsilasdudas');
            var continuar = document.getElementById('continuar');

            if (buttonType === 'reservarboton') {
               
                document.getElementById('form-persona').style.display = 'block';
                document.getElementById('contenedor-fluido').style.display = 'none';
                reservarboton.classList.add('hidden');
                continuar.classList.remove('hidden');
            } else {
                
                
                reservarboton.classList.remove('hidden');
                continuar.classList.add('hidden');
            }
        }


        // calcular la diferencia entre dos fechas
    function calcularPrecio(tipo, precioPorNoche) {
    const fechaInicio = localStorage.getItem('fechaInicio');
    const fechaFinal = localStorage.getItem('fechaFin');

    if (fechaInicio && fechaFinal) {
        const fechaInicioDate = new Date(fechaInicio);
        const fechaFinalDate = new Date(fechaFinal);
       

        const diferenciaDias = (fechaFinalDate - fechaInicioDate) / (1000 * (3600 * 24));

        const precioTotal = diferenciaDias * precioPorNoche;
        console.log(`El precio total para una habitación ${tipo} es ${precioTotal} MXN`);

        acumulador += precioTotal;

        price.innerText = `MXN ${acumulador}.00`;
        noches.innerText = `${diferenciaDias} noches`;
        fechas.innerText = `${fechaInicio} -> ${fechaFinal}`;
        console.log(acumulador);

        

        localStorage.setItem('cantidad',acumulador);
        
        tiposSeleccionados.push(tipo);
        localStorage.setItem('tiposSeleccionados', JSON.stringify(tiposSeleccionados));

        
    } else {
        console.error('Fechas no definidas en el localStorage.');
    }
}


        function mostrar() {
            document.getElementById('info1').style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('continuar').addEventListener('click', guardardatospersona);
});

         

        //guardar datos de persona
        function guardardatospersona(){
            event.preventDefault();

            const persona = {
                nombre: document.getElementById('nombre').value,
                ap_paterno: document.getElementById('ap_paterno').value,
                ap_materno: document.getElementById('ap_materno').value,
                f_nac: document.getElementById('f_nac').value,
                direccion: document.getElementById('direccion').value,
                ciudad: document.getElementById('ciudad').value,
                estado: document.getElementById('estado').value,
                cd_postal: document.getElementById('cd_postal').value,
                pais: document.getElementById('pais').value,
                genero: document.getElementById('genero').value,
                telefono: document.getElementById('telefono').value,
            }

            localStorage.setItem('persona',JSON.stringify(persona));

            alert('Datos guardados exitosamente');
            window.location.href = 'form_pago.php';
        }
        

        
    document.addEventListener('DOMContentLoaded',obtenerHabitaciones);


      
 
  </script>
 
</body>
</html>