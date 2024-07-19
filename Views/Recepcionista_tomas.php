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
  <?php
    session_start();
    if (!isset($_SESSION["usuario"]))
    {
      header("Location:Login.php");
    }
  ?>
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
                        <li><a href="../Views/Calendario.php"><i class="fas fa-check"></i> -Crear Reserva</a></li>
                        <li><a href="#" onclick="showSection('reservaciones')"><i class="fas fa-calendar-check"></i> -Reservaciones</a></li>
                        <li><a href="#" onclick="showSection('habitaciones')"><i class="fas fa-door-open"></i> -Habitaciones</a></li>
                        <li><a href="#" onclick="showSection('huespedes')"><i class="fas fa-users"></i> -Huéspedes</a></li>
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
                                <li><a class="dropdown-item bg bg-danger btn btn-outline-danger list-group-item-action list-group-item-danger" href="../Php/Cerrar_Sesion.php">Cerrar Sesion</a></li>
                            </ul>
                        </div>
                          
                    <i class="fas fa-user btn btn-outline-danger"></i>
                </div>
            </header>
            <section id="reservaciones" class="content-section">
                <h2 class="color-hotel">Reservaciones</h2>
                <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalreservaciones">
    Agregar Nueva Reserva
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="modalreservaciones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Nueva Reserva</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <form id="reservacionesForm" class="toggle-form" onsubmit="addData(event, 'reservaciones')">
        <label for="guest">Huésped:</label>
        <input class="form-control me-2" type="text" id="guest" name="guest" required><br>
        <label for="room">Habitación:</label>
        <input class="form-control me-2" type="text" id="room" name="room" required><br>
        <label for="checkin">Entrada:</label>
        <input class="form-control me-2" type="date" id="checkin" name="checkin" required><br>
        <label for="checkout">Salida:</label>
        <input class="form-control me-2" type="date" id="checkout" name="checkout" required><br>
        <label for="status">Estado:</label>
        <select class="form-control me-2" id="status" name="status" required>
            <option class="form-control me-2" value="Registrado">Registrado</option>
            <option class="form-control me-2" value="Pendiente">Pendiente</option>
        </select><br>
        <button class="btn btn-outline-danger" type="submit">Agregar</button><br><br>
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
                <h4 class="color-hotel">Busqueda</h4><br>
                <form class="d-flex" role="search">
                   <input class="form-control me-2" type="number" id="checkout" name="checkout" placeholder=" Numero">&nbsp;
                    <label class="color-hotel" for="checkin">Fecha inicio:</label>&nbsp;
                    <input class="form-control me-2 width" type="date" id="checkin" name="checkin" style="width: 150px;">&nbsp;
                    <label class="color-hotel" for="checkout">Fecha fin:</label>&nbsp;
                    <input class="form-control me-2 width" type="date" id="checkout" name="checkout" style="width: 150px;">&nbsp;
                    <button class="btn btn-outline-danger" type="submit">Buscar</button>
                  </form><br><br>
                <table>
                    <thead>
                        <tr>
                            <th>Huésped</th>
                            <th>Habitación</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>101</td>
                            <td>2023-06-01</td>
                            <td>2023-06-05</td>
                            <td>Registrado</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>205</td>
                            <td>2023-06-03</td>
                            <td>2023-06-07</td>
                            <td>Pendiente</td>
                        </tr>
                        <tr>
                            <td>Bob Johnson</td>
                            <td>301</td>
                            <td>2023-06-05</td>
                            <td>2023-06-10</td>
                            <td>Registrado</td>
                        </tr>
                    </tbody>
                </table>
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
                <label for="roomNumber">Número:</label>
                <input class="form-control me-2" type="text" id="roomNumber" name="roomNumber" required><br>
                <label for="roomType">Tipo:</label>
                <input class="form-control me-2" type="text" id="roomType" name="roomType" required><br>
                <label for="roomStatus">Estado:</label>
                <select class="form-control me-2" id="roomStatus" name="roomStatus" required>
                    <option class="form-control me-2" value="Ocupada">Ocupada</option>
                    <option class="form-control me-2" value="Disponible">Disponible</option>
                </select><br>
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
                    <select class="form-control me-2">
                        <option value="Sencilla">Sencilla</option>
                        <option value="Doble">Doble</option>
                        <option value="King size">King size</option>
                    </select>&nbsp;
                    <label class="color-hotel">Estado:</label>&nbsp;
                    <select>
                        <option value="Ocupada">Ocupada</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Disponible">Disponible</option>
                    </select>&nbsp;
                    <button class="btn btn-outline-danger" type="submit">Buscar</button>
                  </form><br><br>
                <table>
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>Individual</td>
                            <td>Ocupada</td>
                        </tr>
                        <tr>
                            <td>205</td>
                            <td>Doble</td>
                            <td>Disponible</td>
                        </tr>
                        <tr>
                            <td>301</td>
                            <td>Suite</td>
                            <td>Ocupada</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section id="huespedes" class="content-section" style="display:none;">
                <h2 class="color-hotel">Huéspedes</h2>
                <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalhuespedes">
    Agregar Nuevo Huesped
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="modalhuespedes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Nuevo Huesped</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="huespedesForm" class="toggle-form" onsubmit="addData(event, 'huespedes')">
                <label for="guestName">Nombre:</label>
                <input class="form-control me-2" type="text" id="guestName" name="guestName" required><br>
                <label for="guestEmail">Email:</label>
                <input class="form-control me-2" type="email" id="guestEmail" name="guestEmail" required><br>
                <label for="guestRoom">Habitación:</label>
                <input class="form-control me-2" type="text" id="guestRoom" name="guestRoom" required><br>
                <label for="guestCheckin">Entrada:</label>
                <input class="form-control me-2" type="date" id="guestCheckin" name="guestCheckin" required><br>
                <label for="guestCheckout">Salida:</label>
                <input class="form-control me-2" type="date" id="guestCheckout" name="guestCheckout" required><br>
                <button class="btn btn-outline-success" type="submit">Buscar</button>
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
                  </ul>              </div>
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
        </main>
    </div>
    <script src="../Js/Panel_Admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>