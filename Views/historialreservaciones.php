<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="../Estilos/historial.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/historial.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

<header>
    <div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4 ">
      <div class="container-fluid">
        <a class="navbar-brand p-2 w-25 h-50 d-inline-block col-lg-3" href="index.php">
          <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;" class="rounded-circle rounded-1">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center col-lg-9" id="navbarNav">
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
        <div class="header-content">
            <div class="dropdown">
                <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btnusr">
                    <span class="material-symbols-outlined ">
                        account_circle
                    </span>
                </button>
                <ul class="dropdown-menu glass">
                    <li><a class="dropdown-item" href="panelusuario.php"><span class="material-symbols-outlined lia"></span>Gestionar cuenta</a></li>
                    <li><a class="dropdown-item" href="historialreservaciones.php"><span class="material-symbols-outlined">travel_explore</span>Historial de Reservación</a></li>
                    <li><a class="dropdown-item" href="../Scripts/Cerrar_Sesion.php"><span class="material-symbols-outlined">logout 
                    <?php
                    
                    
                    ?>
                    </span>Cerrar sesión</a></li>
                </ul>
                
                
            </div>
        </div>
    </div>';

}
else {
  echo '   <li class="nav-item">
              <a class="nav-link" href="Views/Login.php"><label>INICIAR SESION</label></a>
            </li>';
}

?>

          </ul>
        </div>
      </div>
    </nav>
  </div>
    </header>
    <br>
    

    <?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

$usuario = $_SESSION["usuario"];


$consulta = "select distinct concat(persona.nombre,'  ' ,persona.apellido_paterno,'   ', persona.apellido_materno) as Nombre_Huesped, reservacion.id_reservacion as folio_reserva,reservacion.estado_reservacion as estado
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
where usuarios.nombre_usuario =  '$usuario'
group by Nombre, folio_reserva,estado;";

$resultado = $db->seleccionar($consulta);

foreach($resultado as $value){

  $consulta_noches = "select (timestampdiff(day,detalle_reservacion.fecha_inicio,detalle_reservacion.fecha_fin)) as noches from
  detalle_reservacion 
  where detalle_reservacion.reservacion = '$value->folio_reserva';";

$resultado_noches = $db->seleccionar($consulta_noches);
if(isset($resultado_noches[0]->noches)) {
  $noches = $resultado_noches[0]->noches;
} ;
?>

<!--CARD DE LAS RESERVACIONES-->
<div class="card" style="width: 30rem;">
  <div class="card-body">
    <h5 class="card-title">Reservacion <?php echo $value->folio_reserva?></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">Nombre: <?php echo $value->Nombre_Huesped ?><br>
    Estado : <?php echo $value->estado ?>
    <br>Noches : <?php echo $noches ?>
    
  
  </h6>
    <p class="card-text"></p>
    <button type="button" class="btn btn-danger" style="margin-left: 70%;margin-top: -25%;" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver Detalles</button><br><br>
    <button type="button" class="btn btn-danger" style="margin-left: 70%;margin-top: -25%;">Editar</button>
  </div>
</div>
 <?php
}
 ?>
<!--MODALS-->


<!--BOTON DE VER DETALLES-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle de tu reservación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        
        $query = "select detalle_reservacion.titular_habitacion as titular, reservacion.id_reservacion as folio_reserva,reservacion.estado_reservacion as estado, (timestampdiff(day,detalle_reservacion.fecha_inicio,detalle_reservacion.fecha_fin)) as noches
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
inner join detalle_reservacion on detalle_reservacion.reservacion=reservacion.id_reservacion
where usuarios.nombre_usuario = '$usuario';";

        $resultados = $db->seleccionar($query);
        foreach($resultados as $value){
        ?>

        
        Titular de la habitación: <?php echo $value->titular?><br>
        


        

        <?php
        }
        ?>
      </div>
    
        
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>