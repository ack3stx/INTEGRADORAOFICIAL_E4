<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="color-hotel">Hotel Laguna Inn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/Panel_Admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <style>
    .image-container {
            overflow: hidden;
        }

        .image-container img {
            transition: opacity 0.5s ease;
        }

        .image-container:hover img {
          filter: grayscale(100%);
            opacity: 0.5;
        }
  </style>
    <div class="container-fluid p-0">
        <main class="main-content">
            <header class="header bg bg-transparent shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <button class="btn btn-outline-danger fas fa-bars rounded-pill p-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"></button>
                <div class="offcanvas offcanvas-start bg bg-transparent" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                  <div class="offcanvas-header">
                    <h5 class="offcanvas-title text text-light" id="offcanvasWithBothOptionsLabel">Hotel Laguna Inn</h5>
                    <button type="button" class="btn-close bg bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                    <ul class="sidebar-menu">
                      <li><a href="#" onclick="showSection('reservaciones')"><i class="fas fa-calendar-check"></i> -Reservaciones</a></li>
                      <li><a href="#" onclick="showSection('habitaciones')"><i class="fas fa-door-open"></i> -Habitaciones</a></li>
                      <li><a href="#" onclick="showSection('huespedes')"><i class="fas fa-users"></i> -Huéspedes</a></li>
                      <li><a href="#" onclick="showSection('personal')"><i class="fas fa-user-tie"></i> -Personal</a></li>
                      <li><a href="#" onclick="showSection('hotel')"><i class="fas fa-hotel"></i> -Hotel</a></li>
                      <li><a href="#" onclick="showSection('facturacion')"><i class="fas fa-file-alt"></i> -Facturacion</a></li>
                    </ul>
                  </div>
                </div>
                <button type="button" class="btn btn-danger position-relative fas fa-envelope" onclick="showSection('informes')">
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    99+
                  <span class="visually-hidden">unread messages</span>
                  </span>
                </button>
                <div class="header-left">
                    <h1 class="text color-hotel fw-bold fs fs-2">Hotel Laguna  Inn</h1>
                </div>
                <div class="header-right">
                        <div class="btn-group">
                            <button class="form-control-plaintext dropdown-toggle text text-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <label class="color-hotel">Tomasillo</label>
                            </button>
                            <ul class="dropdown-menu bg bg-dark text text-light">
                                <li><a class="dropdown-item btn btn-outline-success list-group-item-action list-group-item-success" href="#" onclick="showSection('Cuenta')">Cuenta</a></li>
                                <li><a class="dropdown-item btn btn-outline-success list-group-item-action list-group-item-success" href="#">Historial</a></li>
                                <li><a class="dropdown-item btn btn-outline-success list-group-item-action list-group-item-success" href="#">Opciones</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item bg bg-danger btn btn-outline-danger list-group-item-action list-group-item-danger" href="#">Cerrar Sesion</a></li>
                            </ul>
                        </div>
                          
                    <i class="fas fa-user btn btn-outline-danger"></i>
                </div>
            </header>
            <section id="reservaciones" class="content-section">
                <h2 class="color-hotel">Reservaciones</h2><br><br>
                <form class="d-flex" role="search" action="" method="post">
                   <input class="form-control me-2" type="text" id="checkout" name="numero" placeholder=" Numero">&nbsp;
                    <label class="color-hotel" for="checkin">Fecha inicio:</label>&nbsp;
                    <input class="form-control me-2 width" type="date" id="checkin" name="fecha1" style="width: 150px;">&nbsp;
                    <label class="color-hotel" for="checkout">Fecha fin:</label>&nbsp;
                    <input class="form-control me-2 width" type="date" id="checkout" name="fecha2" style="width: 150px;">&nbsp;
                    <button class="btn btn-outline-danger" type="submit">Buscar</button>
                  </form><br><br>
                  <?php 
    include '../Clases/BasedeDatos.php';
    $conexion = new Database();
    $conexion->conectarDB();
    extract($_POST);
    if($_POST)
    {
        $consulta = "select distinct concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) as Nombre_Huesped, persona.numero_de_telefono,
reservacion.fecha_,reservacion.estado_reservacion,count(detalle_reservacion.id_detalle_reservacion) as Cantidad_de_habitaciones
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
inner join detalle_reservacion on detalle_reservacion.reservacion=reservacion.id_reservacion
where reservacion.id_reservacion=$numero
group by Nombre, persona.numero_de_telefono,reservacion.fecha_,reservacion.estado_reservacion;";

        $tabla = $conexion->seleccionar($consulta);

        echo "
            <table class='table table-hover'>
                <thead class='table-dark'>
                    <tr>
                    <th>Nombre</th><th>Telefono</th><th>Fecha Reservacion</th><th>Estado Reservacion</th><th>Cantidad Habitaciones</th>
                    </tr>
                </thead>
                <tbody>
            ";
            foreach($tabla as $reg)
            {
                echo "<tr>";
                echo "<td> $reg->Nombre_Huesped </td>";
                echo "<td> $reg->numero_de_telefono </td>";
                echo "<td> $reg->fecha_ </td>";
                echo "<td> $reg->estado_reservacion </td>";
                echo "<td> $reg->Cantidad_de_habitaciones </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $conexion->desconectarBD();

    }
    ?>
            </section>
            <section id="habitaciones" class="content-section" style="display:none;">
                <h2 class="color-hotel">Habitaciones</h2>
                <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalhabitaciones">
    Agregar Nueva Habitacion
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="modalhabitaciones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Nueva Habitacion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="habitacionesForm" class="toggle-form" onsubmit="addData(event, 'habitaciones')">
                <label for="roomType">Tipo:</label>
                <select class="form-control me-2" id="roomStatus" name="roomStatus" required>
                    <option class="form-control me-2" value="Sencilla">Sencilla</option>
                    <option class="form-control me-2" value="Doble">Doble</option>
                    <option class="form-control me-2" value="King Size">King Size</option>
                </select><br>
                <label for="roomStatus">Piso</label>
                <input class="form-control me-2" type="text" id="room" name="piso" required><br>
                <button class="btn btn-outline-danger" type="submit">Agregar</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark text text-light btn btn-outline-warning" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-dark text text-light btn btn-outline-warning" data-bs-dismiss="modal">Listo</button>
        </div>
      </div>
    </div>
  </div>
                <br><br>
                <h4 class="color-hotel">Busqueda</h4>
                <form class="d-flex" role="search">
                    <label class="color-hotel">Tipo:</label>&nbsp;
                    <select class="form-control me-2" name="tipo">
                        <option value="Sencilla">Sencilla</option>
                        <option value="Doble">Doble</option>
                        <option value="King size">King size</option>
                    </select>&nbsp;
                    <label class="color-hotel">Estado:</label>&nbsp;
                    <select name="estado">
                        <option value="Ocupada">Ocupada</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Disponible">Disponible</option>
                    </select>&nbsp;
                    <button class="btn btn-outline-danger" type="submit">Buscar</button>
                  </form><br><br>
                  <?php 
    include '../Clases/BasedeDatos.php';
    $conexion = new Database();
    $conexion->conectarDB();
    extract($_POST);
    if($_POST)
    {
        $consulta = "select habitacion.num_habitacion,habitacion.piso,habitacion.estado_habitacion,t_habitacion.nombre,
t_habitacion.descripcion,t_habitacion.precio,t_habitacion.cantidad_max_adultos,t_habitacion.cantidad_max_niños
from habitacion
inner join t_habitacion on habitacion.tipo_habitacion=t_habitacion.id_tipo_habitacion
where t_habitacion.nombre=$tipo and habitacion.estado_habitacion=$estado";

        $tabla = $conexion->seleccionar($consulta);

        echo "
            <table class='table table-hover'>
                <thead class='table-dark'>
                    <tr>
                    <th>Num Habitacion</th><th>Piso</th><th>Estado</th><th>Tipo</th><th>Descripcion</th><th>Costo</th><th>Cant Max Adultos</th><th>Cant Max Niños</th>
                    </tr>
                </thead>
                <tbody>
            ";
            foreach($tabla as $reg)
            {
                echo "<tr>";
                echo "<td> $reg->num_habitacion </td>";
                echo "<td> $reg->piso </td>";
                echo "<td> $reg->estado_habitacion </td>";
                echo "<td> $reg->nombre </td>";
                echo "<td> $reg->descripcion </td>";
                echo "<td> $reg->precio </td>";
                echo "<td> $reg->cantidad_max_adultos </td>";
                echo "<td> $reg->cantidad_max_niños </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $conexion->desconectarBD();

    }
    ?>
            </section>
            <section id="huespedes" class="content-section" style="display:none;">
                <h2 class="color-hotel">Huéspedes</h2>
                <br><br>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="text" placeholder="Nombre">
                    <input class="form-control me-2" type="text" placeholder="Apellido">
                    <button class="btn btn-outline-danger" type="submit">Buscar</button>
                  </form><br><br>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Habitación</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>101</td>
                            <td>2023-06-01</td>
                            <td>2023-06-05</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td>205</td>
                            <td>2023-06-03</td>
                            <td>2023-06-07</td>
                        </tr>
                        <tr>
                            <td>Bob Johnson</td>
                            <td>bob@example.com</td>
                            <td>301</td>
                            <td>2023-06-05</td>
                            <td>2023-06-10</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section id="#" class="content-section" style="display:none;">
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                  <h1 class="fas fa-exclamation-triangle"></h1>NO CUENTAS CON PERMISO PARA VER ESTE APARTADO
                </div>
              </div>
            </section>
            <section id="personal" class="content-section" style="display:none;">
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
            <form id="personalForm" class="toggle-form" onsubmit="addData(event, 'personal')">
                <label for="staffName">Nombre:</label>
                <input class="form-control me-2" type="text" id="staffName" name="staffName" required><br>
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
                <select class="form-control me-2" id="roomStatus" name="roomStatus" required>
                  <option class="form-control me-2" value="Hombre">Hombre</option>
                  <option class="form-control me-2" value="Mujer">Mujer</option>
                </select><br>
                <label for="staffName">Telefono:</label>
                <input class="form-control me-2" type="text" id="staffName" name="telefono" required><br>
                <h5>INFORMACION PERSONAL</h5><br>
                <label for="staffEmail">Curp:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="correo" required><br>
                <label for="staffEmail">RFC:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="correo" required><br>
                <label for="staffEmail">Nss:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="contraseña" required><br>
                <label for="staffEmail">Afore:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="contraseña" required><br>
                <label for="staffEmail">Numero Emergencia:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="contraseña" required><br>
                <h5>CREACION DE USUARIO</h5><br>
                <label for="staffEmail">Nombre de Usuario:</label>
                <input class="form-control me-2" type="text" id="staffEmail" name="usuario" required><br>
                <label for="staffEmail">Email:</label>
                <input class="form-control me-2" type="email" id="staffEmail" name="correo" required><br>
                <label for="staffEmail">Contraseña:</label>
                <input class="form-control me-2" type="password" id="staffEmail" name="contraseña" required><br>
                <button class="btn btn-outline-success" type="submit">Agregar</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark text text-light btn btn-outline-warning" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-dark text text-light btn btn-outline-warning" data-bs-dismiss="modal">Listo</button>
        </div>
      </div>
    </div>
  </div>
                <br><br>
                <h4 class="color-hotel">Busqueda</h4>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Nombre" aria-label="Nombre">
                    <select class="form-control me-2" name="Puestos">
                        <option value="Gerente">Gerente</option>
                        <option value="Recepcionista">Recepcionista</option>
                        <option value="Limpieza">Limpieza</option>
                      </select>
                    <button class="btn btn-outline-danger" type="submit">Buscar</button>
                  </form><br><br>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ana Pérez</td>
                            <td>Gerente</td>
                            <td>ana@example.com</td>
                        </tr>
                        <tr>
                            <td>Carlos García</td>
                            <td>Recepcionista</td>
                            <td>carlos@example.com</td>
                        </tr>
                        <tr>
                            <td>Laura López</td>
                            <td>Limpieza</td>
                            <td>laura@example.com</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section id="informes" class="content-section" style="display:none;">
                <h2 class="color-hotel">Back-Order</h2>
            </section>
            <section id="Cuenta" class="content-section">
              <h1 class="text-center">Cuenta</h1>
              <div class="btn-group dropup">
                <div class="rounded-circle w-50 mx-auto p-2 image-container">
                  <a href="#" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="../Imagenes/maluma.jpeg" class="rounded mx-auto d-block w-25 rounded-circle w-50" alt="..." style="transform: scale(1.1); transition: transform 0.3s ease;"></a> 
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><input type="file"></a></li>
                    <li><a class="dropdown-item" href="#">Cambiar Foto</a></li>
                    <li><a class="dropdown-item" href="#">Informacion Foto</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Ver Foto</a></li>
                  </ul>              
                </div>
              </div>
              <h3 class="text-center">Maluma_Baby</h3>
              <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nuevo Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">Checa que tengas bien agregado el correo</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Nueva Contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Confirmar Nueva Contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </section>
            <section id="facturacion" class="content-section" style="display:none;">
            <form class="d-flex" role="search">
                    <input class="form-control me-2" type="text" placeholder="Numero_habitacion">
                    <button class="btn btn-outline-danger" type="search">Buscar</button>
                  </form><br><br>
            </section>
        </main>
    </div>
    <script src="../Js/Panel_Admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
