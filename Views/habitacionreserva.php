<?php
include '../Clases/BasedeDatos.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/reservavista.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css">
        <title>Laguna Inn</title>
        <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
</head>
<style>



.resumen-item button {
            background-color: rgb(116, 13, 13);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-left: 10%;
        }

        .resumen-item button:hover {
            background-color: #ffff;
        }

        
#room-summary .resumen-item {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 5px;
    background-color: #ffff;
}
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

  #persona{
    width: 30%;
    height: 50%;
    margin-left: 20%;
    margin-top: 10%;
    display: inline-block;
  }

  /* Estilo existente */
.fixed-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #2ecc71; /* Color del fondo del footer */
    color: white;
    text-align: center;
    padding: 10px 0;
    z-index: 1000; /* Asegura que el footer esté siempre por encima de otros elementos */
}

.hidden-content {
    display: none;
    background-color: white;
    color: black;
    padding: 10px;
    max-height: 300px; /* Altura máxima del contenido desplegable */
    overflow-y: auto; /* Habilita el scroll si el contenido excede la altura máxima */
}

/* Botón para bajar el contenido */
.scroll-button {
    display: block;
    width: 100%;
    background-color: #3498db; /* Color del botón de scroll */
    color: white;
    padding: 10px;
    text-align: center;
    cursor: pointer;
    margin-bottom: 10px;
}

.scroll-button:hover {
    background-color: #2980b9;
}

.toggle-button {
    cursor: pointer;
}

.reserve-button {
    background-color: #3498db; /* Color del botón de reserva */
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-top: 10px;
}

.reserve-button:hover {
    background-color: #2980b9;
}
#contenedor-fluido
{
    width: 100vw !important; 
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding: 20px;
}
#dobid
            {
                width: 100vw !important; 
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding: 20px;
            }
            #sencid
            {
                width: 100vw !important; 
    margin-left: 0 !important; 
    margin-right: 0 !important;
    padding: 20px;
            }
            #kingid
            {
                width: 100vw !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding: 20px;
            }
            #card-custom
            {
                width: 100vw !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding: 20px;
            }
@media screen and (min-width: 950px) {
            .desplegable {
                display: none;
            }
            #contenedor-fluido{
                margin: 0;
            }
            #info1
            {
                display: none;
                position:fixed;
    top: 0%;
    left: 30%;
    transform: translate(-50%, -50%);
    height: 70%;
    width:40%;
    overflow: hidden;
            }
            .scroll-container {
    display: flex;
    flex-direction: column;
    max-height: 100%; /* Limita la altura máxima del contenedor para permitir el scroll */
    overflow-y: auto;
    padding-right: 10px;
}
#form-persona
{
    display: none;
            position: absolute;
    top: 75%;
    left: 30%;
    transform: translate(-50%, -50%);
    height: 130%;
    width:150%;
    padding-left:25%;
}

        }
        @media screen and (max-width: 949px) {
            #info1
            {
                margin-left: 5%;
    margin-top: 1%;
    height: 100%;
    width: 100%;
            }
            .card-body
        {
            top: 100%;
    height: 100%;
    width: 100%;
        }
        #form-persona
{
    display: none;
            position: absolute;
    top: 75%;
    left: 30%;
    transform: translate(-50%, -50%);
    height: 130%;
    width:150%;
    padding-left:25%;
}
#persona
{
    width: 73%;
}
}

.card-body {
    flex: 1; /* Permite que el contenido principal ocupe el espacio disponible */
}

</style>
<body>
<header style="height: 20%;">
    <div class="row" style="height: 20%;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4 " style="height: 20%;">
      <div class="container-fluid" style="height: 20%;">
        <a class="navbar-brand p-2 w-25 h-50 d-inline-block col-lg-3" href="../index.php" style="margin-top: -8%;">
          <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px; " class="rounded-circle rounded-1">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center col-lg-9 bg-light" id="navbarNav">
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
              <a class="nav-link" href="Calendario.php"><label>RESERVAR AHORA</label></a>
            </li>
            <?php

if(isset($_SESSION["usuario"])){

    echo ' 
           <div class="dropdown">
                  <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btnusr">
                      <span class="material-symbols-outlined ">
                          account_circle
                      </span>
                  </button>
                  <ul class="dropdown-menu glass">
                      <li>
                        <a class="dropdown-item" href="panelusuario.php">
                            <span class="material-symbols-outlined lia">manage_accounts</span>
                            Gestionar cuenta
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="ver_datos_personales.php">
                            <span class="material-symbols-outlined lia">person</span>
                            Datos Personales
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="datospersonales.php">
                            <span class="material-symbols-outlined lia">edit</span>
                            Modificar mis Datos
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="historialreservaciones.php">
                            <span class="material-symbols-outlined">travel_explore</span>
                            Historial de Reservación
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../Scripts/Cerrar_Sesion.php">
                            <span class="material-symbols-outlined">logout</span>
                            Cerrar Sesión
                        </a>
                    </li>
                      <?php
                      
                      
                      ?>
                      
                  </ul>
                  
                  
              </div>';
  
  }
  else {
    echo '   <li class="nav-item">
                <a class="nav-link" href="Login.php"><label>INICIAR SESION</label></a>
              </li>';
  }
  
  ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
    </header> 

    <section class="header-section">
        <div class="header-content">
            <p>HOTEL LAGUNA INN</p>
            <h1>RESERVACIONES</h1>
        </div>
      
    </section>


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
<!--FORMULARIO PERSONA
            <form id="form-persona" style="display: none;
            position: absolute;
    top: 80%;
    left: 30%;
    transform: translate(-50%, -50%);
    height: 130%;
    width:150%;
    padding-left:25%;" action="../Scripts/recibirinfopersona.php" method="post">
                <div id="persona">
                <label for="staffName">Nombre:</label>
                <input class="form-control me-2" type="text" id="nombre" name="nombre" required ><br>
                <label for="staffName">Apellido Paterno:</label>
                <input class="form-control me-2" type="text" id="ap_paterno" name="ap_paterno" required ><br>
                <label for="staffName">Apellido Materno:</label>
                <input class="form-control me-2" type="text" id="ap_materno" name="ap_materno" required ><br>
                <label for="staffName">Fecha Nacimiento:</label>
                <input class="form-control me-2" type="date" id="f_nac" name="f_nac" required><br>
                <label for="staffName">Direccion:</label>
                <input class="form-control me-2" type="text" id="direccion" name="direccion" required><br>
                <label for="staffName">Ciudad:</label>
                <input class="form-control me-2" type="text" id="ciudad" name="ciudad" required ><br>
                <label for="staffName">Estado:</label>
                <input class="form-control me-2" type="text" id="estado" name="estado" required><br>
                <label for="staffName">Codigo Postal:</label>
                <input class="form-control me-2" type="text" id="cd_postal" name="cd_postal" required ><br>
                <label for="staffName">Pais:</label>
                <input class="form-control me-2" type="text" id="pais" name="pais" required ><br>
                <label for="staffName">Genero:</label>
                <select class="form-control me-2" id="genero" name="genero" required>
                  <option class="form-control me-2" value="H">Hombre</option>
                  <option class="form-control me-2" value="M">Mujer</option>
                </select><br>
                <label for="staffName">Telefono:</label>
                <input class="form-control me-2" type="text" id="telefono" name="telefono" required ><br>

                <input type="submit" value="Continuar" class="text">

              </form>
                <div class="form-check mb-3 mt-4">
        <input type="checkbox" class="form-check-input" id="facturar" onclick="toggleBilling()">
        <label class="form-check-label" for="facturar">Desea Facturar</label>
      </div>


      <div id="billingForm" style="display: none;">
       <form>
         <h4 class="mb-3">Datos de Facturación</h4>
        <div class="mb-3">
          <label for="nombreFactura" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombreFactura" name="nombreFactura" placeholder="Nombre completo" required>
        </div>
        <div class="mb-3">
          <label for="apellidoPaternoFactura" class="form-label">Apellido Paterno</label>
          <input type="text" class="form-control" id="apellidoPaternoFactura" name="apellidoPaternoFactura" placeholder="Apellido Paterno" required>
        </div>
        <div class="mb-3">
          <label for="apellidoMaternoFactura" class="form-label">Apellido Materno</label>
          <input type="text" class="form-control" id="apellidoMaternoFactura" name="apellidoMaternoFactura" placeholder="Apellido Materno" required>
        </div>
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label>
          <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle 123, Ciudad, País" required>
        </div>
        <div class="mb-3">
          <label for="rfc" class="form-label">RFC</label>
          <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" required>
        </div>
      </div>
      </div>
                </div> 
                
            </form>    





-->
    
<div class="fixed-footer desplegable">
    <div class="toggle-button">
        Ver resumen <span id="arrow">▲</span>
    </div>
    <div id="content" class="hidden-content">
        
    </div>
</div>

<div id="info1" class="container">
    <div class="scroll-container">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title custom1">Resumen de la Reserva</h5>
                <h6  id="fechas" class="card-subtitle custom2 mb-2 text-muted">12 jul -> 13 jul</h6>
                <button type="button" id="noches" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                    <i class="fa-solid fa-moon">&nbsp;&nbsp;&nbsp;&nbsp;1 noche</i>
                </button>
                <br><br>
                <hr class="mb-4">
                <div id="room-summary">
                    <!-- Resumen breve de habitaciones -->
                </div>
                <p><strong>Total &nbsp;&nbsp;&nbsp;&nbsp; MXN <span id="total-price">0.00</span></strong></p>
            </div>
            <!-- Fija los botones al fondo del contenedor -->
            <div class="fixed-buttons">
                <div class="d-grid gap-6 col-10 mx-auto">
                    <button class="btn btn-success" type="button" id="porsilasdudas" onclick="redireccionar();">Reservar Ahora</button> <br>
                    <button class="btn btn-success hidden" type="button" id="continuar" onclick="mostrarformulario('continuar');">Continuar</button>
                    <button class="btn btn-danger" type="button" id="borrarCambios">Borrar Cambios</button>
                </div>
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

<script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0"></script>
<script>
    document.querySelector('.toggle-button').addEventListener('click', function() {
    const content = document.getElementById('content');
    const arrow = document.getElementById('arrow');

    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
        arrow.textContent = "▼"; // Cambia la flecha hacia abajo
    } else {
        content.style.display = "none";
        arrow.textContent = "▲"; // Cambia la flecha hacia arriba
    }
});

function scrollToContent() {
    const content = document.getElementById('content');
    content.scrollIntoView({ behavior: 'smooth' });
}

</script>

<script>
  // Función que mueve el elemento si la pantalla es menor a 950px
  function moveElement() {
    const screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if (screenWidth < 950) {
      // Seleccionar el párrafo que se va a mover
      const info1 = document.getElementById('info1');

      // Seleccionar el segundo contenedor
      const content = document.getElementById('content');

      // Mover el párrafo al final del segundo contenedor si aún no se ha movido
      if (info1 && content && !content.contains(info1)) {
        content.appendChild(info1);
      }
    }
  }

  // Ejecutar al cargar la página
  window.onload = moveElement;

  // Ejecutar cuando se cambie el tamaño de la ventana
  window.onresize = moveElement;
</script>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  
    
    <script>
    /*document.addEventListener('DOMContentLoaded', function() {
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
            document.addEventListener('DOMContentLoaded',obtenerHabitaciones);
            
                
               
            
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
            document.addEventListener('DOMContentLoaded',obtenerHabitaciones);
                
            
          }
        }
      });

       
    if (startDate) {
        startDatePicker.setDate(startDate);}

    if (endDate) {
        endDatePicker.setDate(endDate);}

    });

   */

  </script>


<script>
    var habitacionesDoble = 0;
     var habitacionesKingSize = 0;
                var habitacionesSencilla = 0;
                var dobleG = 0
                var dobleK = 0;
                var dobleS = 0;

                var Dprecio = 0;
                var Kprecio = 0;
                var Sprecio = 0;
    var roomCount = 0; //contador total
    var roomdoble = 0;
    var roomSencilla = 0;
    var roomKing = 0;
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
            
             habitacionesDoble = data.doble[0].doble;
                 habitacionesKingSize = data["king-size "][0]["King Size"];
                 habitacionesSencilla = data.sencilla[0].Sencilla;
                dobleG = data.genteD[0];
                 dobleK = data.genteK[0];
                 dobleS = data.genteS[0];

                Dprecio = parseFloat(data.precioD[0].precio);
                 Kprecio = parseFloat(data.precioK[0].precio);
                 Sprecio = parseFloat(data.precioS[0].precio);

                if (habitacionesDoble === 0 && habitacionesKingSize === 0 && habitacionesSencilla === 0) {
                    crearTarjetaDoble('Habitación Doble', 'Nuestra Habitación Doble ofrece dos cómodas camas matrimoniales en un espacio de 28 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y un sillón individual.',dobleG.adultos, dobleG.niños,Dprecio,false);
                    crearTarjetaKingSize('Habitación King Size', 'Disfruta de nuestra lujosa Habitación King Size con una cama de gran tamaño, perfecto para una estadía confortable.',dobleK.adultos,dobleK.niños,Kprecio,false);
                    crearTarjetaSencilla('Habitación Sencilla', 'Nuestra Habitación Sencilla es ideal para viajeros solos, con una cómoda cama individual y todas las comodidades necesarias para una estadía agradable.',dobleS.adultos, dobleS.niños,Sprecio,false);
                
                    console.log("Mostrando notificación Toastify");
                    Toastify({
                text: "No hay habitaciones disponibles para las fechas seleccionadas",
                 //className: "info",
                 style: {
                 background: "rgba(214, 13, 13, 0.5)", 
                 color: "#fff", 
                 borderRadius: "8px", 
                 padding: "10px",
                 
                 }
                 }).showToast();
                 
                 setTimeout(function() {
                 window.location.href = "../Views/Calendario.php";
                   }, 4000);
        } else {
            const container = document.getElementById('contenedor-fluido');
            if (habitacionesDoble > 0) {
                
               crearTarjetaDoble('Habitación Doble', 'Nuestra Habitación Doble ofrece dos cómodas camas matrimoniales en un espacio de 28 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y un sillón individual.',dobleG.adultos, dobleG.niños,Dprecio,true);
            }
            else {
                crearTarjetaDoble('Habitación Doble', 'Nuestra Habitación Doble ofrece dos cómodas camas matrimoniales en un espacio de 28 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y un sillón individual.',dobleG.adultos, dobleG.niños,Dprecio,false);

            }
            if (habitacionesKingSize > 0) {
                
                crearTarjetaKingSize('Habitación King Size', 'Disfruta de nuestra lujosa Habitación King Size con una cama de gran tamaño, perfecto para una estadía confortable.',dobleK.adultos,dobleK.niños,Kprecio,true);
            }
            else {
                crearTarjetaKingSize('Habitación King Size', 'Disfruta de nuestra lujosa Habitación King Size con una cama de gran tamaño, perfecto para una estadía confortable.',dobleK.adultos,dobleK.niños,Kprecio,false);

            }
            if (habitacionesSencilla > 0) {
                crearTarjetaSencilla('Habitación Sencilla', 'Nuestra Habitación Sencilla es ideal para viajeros solos, con una cómoda cama individual y todas las comodidades necesarias para una estadía agradable.',dobleS.adultos, dobleS.niños,Sprecio,true);
            }
            else{
                crearTarjetaSencilla('Habitación Sencilla', 'Nuestra Habitación Sencilla es ideal para viajeros solos, con una cómoda cama individual y todas las comodidades necesarias para una estadía agradable.',dobleS.adultos, dobleS.niños,Sprecio,false);
            }
            console.log(data);
        }
        }).catch(error => { console.log(error)})
    }

    document.addEventListener('DOMContentLoaded',obtenerHabitaciones);

    function bloqueartarjeta(card){
        const texto = document.createElement('h5');
       texto.className = 'card-title';
       texto.innerText = 'No hay habitaciones disponibles';
       card.appendChild(texto);

        card.classList.add('disabled');
       card.style.opacity = '0.5';
       const addButton = card.querySelector('.btn');
    addButton.disabled = true;

    /*const cardText = card.querySelector('.card-text');
    cardText.style.display = 'none';
    const priceInfo = card.querySelector('.price-info');
    priceInfo.style.display = 'none'; */

   
    }





    function crearTarjetaDoble(titulo, descripcion,adultos,niños,precio,disponible)  {

            
        const container = document.getElementById('contenedor-fluido');

const cardContainer = document.createElement('div');
cardContainer.className = 'container-custom move-right';
cardContainer.id = 'dobid';
cardContainer.dataset.roomType = 'doble';

const card = document.createElement('div');
card.className = 'card card-custom';

const imageContainer = document.createElement('div');
imageContainer.className = 'image-container';

const img = document.createElement('img');
img.src = '../Imagenes/HABITACION_D.png';
img.alt = 'Habitación Doble';

if (habitacionesDoble === 1) {
    const texto = document.createElement('p');
    texto.className = 'card-text';
    texto.innerText = 'Solo queda 1 habitación disponible';
    card.appendChild(texto);
}

imageContainer.appendChild(img);

const cardBody = document.createElement('div');
cardBody.className = 'card-body card-body-custom';

const cardTitle = document.createElement('h5');
cardTitle.className = 'card-title';
cardTitle.innerText = 'Habitación Doble';

const cardSubtitle = document.createElement('h6');
cardSubtitle.className = 'card-subtitle mb-2 text-muted';
cardSubtitle.innerText = `Máximo de: ${adultos} huéspedes`;

const cardText = document.createElement('p');
cardText.className = 'card-text';
cardText.innerText = 'Nuestra Habitación Doble ofrece dos cómodas camas matrimoniales en un espacio de 28 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y un sillón individual.';

const cardFooter = document.createElement('div');
cardFooter.className = 'card-footer-custom';
            
            const priceInfo = document.createElement('div');
            priceInfo.className = 'price-info';
            
            const price = document.createElement('h6');
            price.innerText = `MXN ${precio}.00`;
            
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


            const kidsOptions = [3, 2, 1, 0];

            for (let i = 1; i <= adultos; i++) {
                const adultOption = document.createElement('li');
                adultOption.innerHTML = `<a class="dropdown-item">${i} Adulto${i > 1 ? 's' : ''}</a>`;
                adultOption.addEventListener('click', function() {
                    adultsButton.innerText = `${i} Adulto${i > 1 ? 's' : ''}`;
                    localStorage.setItem('selectedAdults', i);
                    addButton.disabled = false;

                    kidsButton.disabled = false;
                    kidsMenu.innerHTML = '';

                    let maxKids = kidsOptions[i - 1]; 
                    for (let j = 0; j <= maxKids; j++) {
                        const kidOption = document.createElement('li');
                        kidOption.innerHTML = `<a class="dropdown-item">${j} Niño${j > 1 ? 's' : ''}</a>`;
                        kidOption.addEventListener('click', function() {
                            kidsButton.innerText = `${j} Niño${j > 1 ? 's' : ''}`;
                            localStorage.setItem('selectedKids', j);
                        });
                        kidsMenu.appendChild(kidOption);
                    }

                    
                    kidsButton.innerText = `${maxKids} Niño${maxKids !== 1 ? 's' : ''}`;
                    localStorage.setItem('selectedKids', maxKids);
                });
                adultsMenu.appendChild(adultOption);
            }
          
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
            addButton.className = 'btn btn-danger custom-btn';
            addButton.id = 'doble';
            addButton.onclick = function() {
                mostrar();
                calcularPrecio('Doble',precio);
                
            };
            addButton.innerText = 'Añadir';
            addButton.disabled = true;
            
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

            if(!disponible){
                bloqueartarjeta(card);
            }
        }
        

        function crearTarjetaKingSize(titulo, descripcion,adultos,niños,precio,disponible)  {
            
            const container = document.getElementById('contenedor-fluido');
            
            const cardContainer = document.createElement('div');
            cardContainer.className = 'container-custom move-right';
            cardContainer.id= 'kingid';
            cardContainer.dataset.roomType = 'king-size';
            
            const card = document.createElement('div');
            card.className = 'card card-custom';
            
            const imageContainer = document.createElement('div');
            imageContainer.className = 'image-container';
            
            const img = document.createElement('img');
            img.src = '../Imagenes/HABITACION_K.png';
            img.alt = 'Habitación King Size';

            if(habitacionesKingSize === 1){
            const texto = document.createElement('p');
            texto.className = 'card-text';
            texto.innerText = 'Solo queda 1 habitación disponible';
            card.appendChild(texto);
            }
            
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
            price.innerText = `MXN ${precio}.00`;
            
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
            adultsButton.id = 'king-adults';
            adultsButton.setAttribute('data-bs-toggle', 'dropdown');
            adultsButton.setAttribute('aria-expanded', 'false');
            adultsButton.innerText = 'Adultos';
            
            const adultsMenu = document.createElement('ul');
            adultsMenu.className = 'dropdown-menu';
            adultsMenu.setAttribute('aria-labelledby', 'king-adults');

            const kidsOptions = {
            1: [1, 2, 0], 
            2: [1, 0],  };

            for (let i = 1; i <= 2; i++) {
                const adultOption = document.createElement('li');
                adultOption.innerHTML = `<a class="dropdown-item" >${i} Adulto${i > 1 ? 's' : ''}</a>`;
                adultOption.addEventListener('click', function() {
                    adultsButton.innerText = `${i} Adulto${i > 1 ? 's' : ''}`;
                    localStorage.setItem('selectedAdults', i);
                    addButton.disabled = false;

                    kidsButton.disabled = false;
                    kidsMenu.innerHTML = '';

                    let possibleKids = kidsOptions[i]; 
                    possibleKids.forEach(kidCount => {
                        const kidOption = document.createElement('li');
                        kidOption.innerHTML = `<a class="dropdown-item" ">${kidCount} Niño${kidCount > 1 ? 's' : ''}</a>`;
                        kidOption.addEventListener('click', function() {
                            kidsButton.innerText = `${kidCount} Niño${kidCount > 1 ? 's' : ''}`;
                            localStorage.setItem('selectedKids', kidCount);
                        });
                        kidsMenu.appendChild(kidOption);
                    });

             
                    let defaultKids = possibleKids[0]; 
                    kidsButton.innerText = `${defaultKids} Niño${defaultKids !== 1 ? 's' : ''}`;
                    localStorage.setItem('selectedKids', defaultKids);
                });
                adultsMenu.appendChild(adultOption);
            }

            dropdownAdults.appendChild(adultsButton);
            dropdownAdults.appendChild(adultsMenu);
            
            const dropdownKids = document.createElement('div');
            dropdownKids.className = 'dropdown';
            
            const kidsButton = document.createElement('button');
            kidsButton.className = 'btn dropdown-toggle';
            kidsButton.type = 'button';
            kidsButton.id = 'king-kids';
            kidsButton.setAttribute('data-bs-toggle', 'dropdown');
            kidsButton.setAttribute('aria-expanded', 'false');
            kidsButton.innerText = 'Niños';
            kidsButton.disabled = true;
            
            const kidsMenu = document.createElement('ul');
            kidsMenu.className = 'dropdown-menu';
            kidsMenu.setAttribute('aria-labelledby', 'king-kids');
            
            dropdownKids.appendChild(kidsButton);
            dropdownKids.appendChild(kidsMenu); 
            
            const addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.className = 'btn btn-danger custom-btn';
            addButton.id = 'king';
            addButton.onclick = function() {
                mostrar();
                calcularPrecio('King Size',precio);
               
            };
            addButton.innerText = 'Añadir';
            addButton.disabled = true;
            
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

            if(!disponible){
                bloqueartarjeta(card);
            }
        }
        
        function crearTarjetaSencilla(titulo, descripcion,adultos,niños,precio,disponible)  {
            
            const container = document.getElementById('contenedor-fluido');
            
            const cardContainer = document.createElement('div');
            cardContainer.className = 'container-custom move-right';
            cardContainer.id= 'sencid';
            cardContainer.dataset.roomType = 'sencilla';
            
            const card = document.createElement('div');
            card.className = 'card card-custom';
            
            const imageContainer = document.createElement('div');
            imageContainer.className = 'image-container';
            
            const img = document.createElement('img');
            img.src = '../Imagenes/HABITACION_S.png';
            img.alt = 'Habitación Sencilla';

            if(habitacionesSencilla === 1){
            const texto = document.createElement('p');
            texto.className = 'card-text';
            texto.innerText = 'Solo queda 1 habitación disponible';
            card.appendChild(texto);
            }
            
            imageContainer.appendChild(img);
            
            const cardBody = document.createElement('div');
            cardBody.className = 'card-body card-body-custom';
            
            const cardTitle = document.createElement('h5');
            cardTitle.className = 'card-title';
            cardTitle.innerText = 'Habitación Sencilla';
            
            const cardSubtitle = document.createElement('h6');
            cardSubtitle.className = 'card-subtitle mb-2 text-muted';
            cardSubtitle.innerText = `Máximo de: ${adultos} huéspedes`;
            
            const cardText = document.createElement('p');
            cardText.className = 'card-text';
            cardText.innerText = 'Nuestra Habitación Sencilla es ideal para viajeros solos, con una cómoda cama individual y todas las comodidades necesarias para una estadía agradable';
            
            const cardFooter = document.createElement('div');
            cardFooter.className = 'card-footer-custom';
            
            const priceInfo = document.createElement('div');
            priceInfo.className = 'price-info';
            
            const price = document.createElement('h6');
            price.innerText = `MXN ${precio}.00`;
            
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

            const kidsOptions = {
            1: [1, 0], 
            2: [0] };

            for (let i = 1; i <= adultos; i++) {
                const adultOption = document.createElement('li');
                adultOption.innerHTML = `<a class="dropdown-item" >${i} Adulto${i > 1 ? 's' : ''}</a>`;
                adultOption.addEventListener('click', function() {
                    adultsButton.innerText = `${i} Adulto${i > 1 ? 's' : ''}`;
                    localStorage.setItem('selectedAdults', i);
                    addButton.disabled = false;

                    kidsButton.disabled = false;
                    kidsMenu.innerHTML = '';

                    let possibleKids = kidsOptions[i]; 
                    possibleKids.forEach(kidCount => {
                        const kidOption = document.createElement('li');
                        kidOption.innerHTML = `<a class="dropdown-item" >${kidCount} Niño${kidCount > 1 ? 's' : ''}</a>`;
                        kidOption.addEventListener('click', function() {
                            kidsButton.innerText = `${kidCount} Niño${kidCount > 1 ? 's' : ''}`;
                            localStorage.setItem('selectedKids', kidCount);
                        });
                        kidsMenu.appendChild(kidOption);
                    });

                    
                    let defaultKids = possibleKids[0]; 
                    kidsButton.innerText = `${defaultKids} Niño${defaultKids !== 1 ? 's' : ''}`;
                    localStorage.setItem('selectedKids', defaultKids);
                });
                adultsMenu.appendChild(adultOption);
            }
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
            addButton.className = 'btn btn-danger custom-btn';
            addButton.id = 'sencilla';
            2
            addButton.onclick = function() {
                mostrar();
                calcularPrecio('Sencilla',precio);
                
            };
            addButton.innerText = 'Añadir';
            addButton.disabled = true;
            
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

            if(!disponible){
                bloqueartarjeta(card);
            }
        }  
        
        
  
        function redireccionar() {
            window.location.href = 'form_pago.php';
        }


 
 /*function mostrarformulario(buttonType) {
            var reservarboton = document.getElementById('porsilasdudas');
            var continuar = document.getElementById('continuar');

            if (buttonType === 'reservarboton') {
               
                document.getElementById('form-persona').style.display = 'block';
                document.getElementById('contenedor-fluido').style.display = 'none';
                document.getElementById('dobid').style.display = 'none';
                document.getElementById('kingid').style.display = 'none';
                document.getElementById('sencid').style.display = 'none';
                reservarboton.classList.add('hidden');
                continuar.classList.remove('hidden');
            } else {
                
                
                reservarboton.classList.remove('hidden');
                continuar.classList.add('hidden');
            }
        } */


/*function realizarReserva() {
    // Aquí puedes añadir cualquier lógica o redirección necesaria
    console.log("Datos de reserva ya están almacenados. Procesando reserva...");
    window.location.href = 'form_pago.php'; // Cambia esto por la ruta adecuada
    // O simplemente invoca aquí a cualquier función que ya tengas definida para manejar la reserva
}

document.getElementById('porsilasdudas').addEventListener('click', function() {
    mostrarformulario('reservarboton');
}); */


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

        const adultos = localStorage.getItem('selectedAdults');
        const ninos = localStorage.getItem('selectedKids');
       
        

        const detalleHabitacion = {
            tipo: tipo,
            adultos: adultos,
            ninos: ninos,
            precioTotal : precioTotal
        };
        
        tiposSeleccionados.push(detalleHabitacion);
        localStorage.setItem('tiposSeleccionados', JSON.stringify(tiposSeleccionados));

        
        actualizarResumen(tipo);
        
    } else {
        console.error('Fechas no definidas en el localStorage.');
    }
}


function actualizarResumen(tipo) {
    const resumenContenido = document.getElementById('room-summary');
    
    const div = document.createElement('div');
    div.className = 'resumen-item';
    div.innerText = `Habitación: ${tipo}`;
    const boton = document.createElement('button');
    boton.innerHTML= '<i class="fas fa-trash-alt"></i>';

    boton.onclick = function() {
        resumenContenido.removeChild(div);
        roomCount -= 1;

        const index = tiposSeleccionados.findIndex(habitacion => habitacion.tipo === tipo);
        if (index > -1) {
            const precioTotal = tiposSeleccionados[index].precioTotal;
            acumulador -= precioTotal;
            price.innerText = `MXN ${acumulador}.00`;
            tiposSeleccionados.splice(index, 1);
            localStorage.setItem('tiposSeleccionados', JSON.stringify(tiposSeleccionados));
            localStorage.setItem('cantidad', acumulador);
        }

        // Disminuye el contador correspondiente y verifica si se debe habilitar el botón
        if(tipo === 'Doble'){
            roomdoble -= 1;
        } else if(tipo === 'King Size'){
            roomKing -= 1;
        } else if(tipo === 'Sencilla'){
            roomSencilla -= 1;
        }

        desabilitarbotonañadir(tipo);
    };

    div.appendChild(boton);
    resumenContenido.appendChild(div);

    // Aumenta el contador correspondiente y verifica si se debe deshabilitar el botón
    if(tipo === 'Doble'){
        roomdoble += 1;
    } else if(tipo === 'King Size'){
        roomKing += 1;
    } else if(tipo === 'Sencilla'){
        roomSencilla += 1;
    }

    roomCount += 1;
    desabilitarbotonañadir(tipo);
}



function vaciarResumen() {
    const resumenContenido = document.getElementById('room-summary');
    resumenContenido.innerHTML = ''; // Vacía el contenido del resumen
    roomCount = 0;
    roomdoble = 0;
    roomKing = 0;
    roomSencilla = 0;
    acumulador = 0;
    document.getElementById('total-price').innerText = `MXN ${acumulador}.00`;
    tiposSeleccionados = [];
    localStorage.setItem('tiposSeleccionados', JSON.stringify(tiposSeleccionados));
    localStorage.setItem('cantidad', acumulador);

    document.getElementById('info1').style.display = 'none'; // Oculta la card del resumen

    actualizarEstadoBotonAñadir();
}


function actualizarEstadoBotonAñadir() {
    const addButtonDoble = document.getElementById('doble');
    const addButtonKing = document.getElementById('king');
    const addButtonSencilla = document.getElementById('sencilla');


    // con este comparador, lo que hago es que cuando se añaden, o se quieran habitaciones, el boton de añadir actualiza su estaod, para ya no pdoer agrefar o seguir ageregando gagagagagagagagga
    if (roomCount === 0) {
        addButtonDoble.disabled = false;
        addButtonKing.disabled = false;
        addButtonSencilla.disabled = false;
    } else if (roomCount !=  0) { 
        addButtonDoble.disabled = false;
        addButtonKing.disabled = false;
        addButtonSencilla.disabled = false;
    }
} 



document.getElementById('borrarCambios').onclick = vaciarResumen;




function toggleBilling() {
      var checkbox = document.getElementById("facturar");
      var billingForm = document.getElementById("billingForm");
      billingForm.style.display = checkbox.checked ? "block" : "none";
    }




        function mostrar() {
            document.getElementById('info1').style.display = 'block';
            document.getElementById('room-summary').style.display = 'block'; 

            const content = document.getElementById('content');
    const arrow = document.getElementById('arrow');

    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
        arrow.textContent = "▼"; // Cambia la flecha hacia abajo
    }
            
        }

        function desabilitarbotonañadir(buttonType) {
    if (roomdoble >= habitacionesDoble) {
        document.getElementById('doble').disabled = true;
    } else if (roomdoble < habitacionesDoble) {
        document.getElementById('doble').disabled = false;
    }

    if (roomKing >= habitacionesKingSize) {
        document.getElementById('king').disabled = true;
    } else if (roomKing < habitacionesKingSize) {
        document.getElementById('king').disabled = false;
    }

    if (roomSencilla >= habitacionesSencilla) {
        document.getElementById('sencilla').disabled = true;
    } else if (roomSencilla < habitacionesSencilla) {
        document.getElementById('sencilla').disabled = false;
    }
}
       /* document.addEventListener('DOMContentLoaded', function() {
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
        */

        /*              FORMULARIO DE PERSONA                                                                                                       

        function validarformulario(idFormulario) {
    var campos = document.querySelectorAll('#' + idFormulario + ' input, #' + idFormulario + ' select');
    var formValido = true;

    campos.forEach(function(campo) {
        if (campo.value === '') {
            campo.style.border = '2px solid red';
            setTimeout(() => {
                campo.style.border = '';
            }, 2000);
            formValido = false;
        } else {
            campo.style.border = '';
        }
    });

   
    if (document.getElementById('facturar').checked) {
        var camposFacturacion = document.querySelectorAll('#billingForm input');
        camposFacturacion.forEach(function(campo) {
            if (campo.value === '') {
                campo.style.border = '2px solid red';
                setTimeout(() => {
                    campo.style.border = '';
                }, 2000);
                formValido = false;
            } else {
                campo.style.border = '';
            }
        });
    }

    return formValido;
}

function enviarformulario(event) {
    event.preventDefault();
    var formularioValido = validarformulario('form-persona');

    if (formularioValido) {
        

        if (document.getElementById('facturar').checked) {
            const facturacion = {
                nombre: document.getElementById('nombreFactura').value,
                ap_paterno: document.getElementById('apellidoPaternoFactura').value,
                ap_materno: document.getElementById('apellidoMaternoFactura').value,
                direccion: document.getElementById('direccion').value,
                rfc: document.getElementById('rfc').value
            };

            localStorage.setItem('facturacion', JSON.stringify(facturacion));
        }

        alert("Datos guardados exitosamente");
        window.location.href = 'form_pago.php';
    }
}

 

document.getElementById('continuar').addEventListener('click',enviarformulario); */



        
    

      
 
  </script>
 
</body>
</html>