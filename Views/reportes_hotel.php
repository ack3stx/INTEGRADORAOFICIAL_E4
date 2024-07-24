<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/estilos_panel_busqueda.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <?php
    include '../Clases/BasedeDatos.php';
    $db = new Database();
    $db->conectarDB();
    list($mes, $año) = $db->obtenerMesYAñoActual();
    $mesn=$db->obtenerMesActualn();
    $consulta="SELECT SUM(detalle_pago.monto_total) AS Total_MontoL, X.Total_MontoF
FROM (SELECT SUM(detalle_pago.monto_total) AS Total_MontoF
FROM reservacion
INNER JOIN detalle_pago ON reservacion.id_reservacion = detalle_pago.reservacion
WHERE reservacion.recepcionista IS not NULL and month(reservacion.fecha_)=$mesn and year(reservacion.fecha_)=$año) as X,reservacion
INNER JOIN detalle_pago ON reservacion.id_reservacion = detalle_pago.reservacion
WHERE reservacion.recepcionista IS NULL and month(reservacion.fecha_)=$mesn and year(reservacion.fecha_)=$año";
    $array=$db->seleccionar($consulta);
    foreach($array as $monto_total)
    {
      $montola=$monto_total->Total_MontoL;
      $montofa=$monto_total->Total_MontoF;
    }
    $mesn2=$mesn-1;
    $consulta2="SELECT SUM(detalle_pago.monto_total) AS Total_MontoL, X.Total_MontoF
FROM (SELECT SUM(detalle_pago.monto_total) AS Total_MontoF
FROM reservacion
INNER JOIN detalle_pago ON reservacion.id_reservacion = detalle_pago.reservacion
WHERE reservacion.recepcionista IS not NULL and month(reservacion.fecha_)=$mesn2 and year(reservacion.fecha_)=$año) as X,reservacion
INNER JOIN detalle_pago ON reservacion.id_reservacion = detalle_pago.reservacion
WHERE reservacion.recepcionista IS NULL and month(reservacion.fecha_)=$mesn2 and year(reservacion.fecha_)=$año";
    $array2=$db->seleccionar($consulta2);
    foreach($array2 as $monto_total2)
    {
      $montole=$monto_total2->Total_MontoL;
      $montofe=$monto_total2->Total_MontoF;
    }
    echo
    "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var chartDiv = document.getElementById('chart_div');

        var data = google.visualization.arrayToDataTable([
          ['Galaxy', 'Linea', 'Fisico'],
          ['$mes ahora', $montola, $montofa],
          ['$mes Esperado', $montole, $montofe],
        ]);

        var materialOptions = {
          chart: {
            title: 'Nearby galaxies',
            subtitle: 'distance on the left, brightness on the right'
          },
          series: {
            0: { axis: 'distance' },
            1: { axis: 'brightness' }
          },
          axes: {
            y: {
              distance: {label: 'parsecs', minValue: 0, maxValue: 100000},
              brightness: {side: 'right', label: 'apparent magnitude'}
            }
          }
        };

        var classicOptions = {
          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
          },
          title: 'Nearby galaxies - distance on the left, brightness on the right',
          vAxes: {
            0: {title: 'parsecs', viewWindow: {min: 0, max: 100000}},
            1: {title: 'apparent magnitude', viewWindow: {min: 0, max: 100000}}
          }
        };

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicOptions.width = chartDiv.offsetWidth;
          classicChart.draw(data, classicOptions);
        }

        drawClassicChart();
        window.addEventListener('resize', drawClassicChart);
      };
    </script>";

    echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Opening Move', 'Percentage'],
          ['King\'s pawn (e4)', 44],
          ['Queen\'s pawn (d4)', 31],
          ['Knight to King 3 (Nf3)', 12],
          ['Queen\'s bishop pawn (c4)', 10],
          ['Other', 3]
        ]);

        var options = {
          title: 'Chess opening moves',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Chess opening moves',
                   subtitle: 'popularity by percentage' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Percentage'} // Top x-axis.
            }
          },
          bar: { groupWidth: '90%' }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
";
?>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand" href="panel_recepcionista2.php">Hotel Laguna Inn</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="calendario.php">
              <i class="fas fa-calendar-plus"></i> Crear Reserva
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_reserva.php">
              <i class="fas fa-book"></i> Reservaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_habitaciones.php">
              <i class="fas fa-bed"></i> Habitaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_huesped.php">
              <i class="fas fa-bed"></i> Huesped
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_empleados.php">
              <i class="fas fa-bed"></i> Personal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reportes_hotel.php">
              <i class="fas fa-bed"></i> Hotel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_facturacion.php">
              <i class="fas fa-bed"></i> Facturacion
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notificaciones.php">
            <button type="button" class="btn btn-danger position-relative fas fa-envelope">
  <span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
    <span class="visually-hidden"></span>
  </span>
</button>
            </a>
          </li>
        </ul>
        <div class="header-right">
          <div class="btn-group">
            <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
              Tomasillo
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="cambiar_datos_cuenta_recepcionista.php">Cuenta</a></li>
              <li><a class="dropdown-item" href="#">Historial</a></li>
              <li><a class="dropdown-item" href="#">Opciones</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="../Php/Cerrar_Sesion.php">Cerrar Sesión</a></li>
            </ul>
          </div>
          <i class="fas fa-user text-white ml-2"></i>
        </div>
      </div>
    </div>
  </nav>
  <form action="" method="post">
    <select name="Grafica">
      <option value="1">Grafica Meta Del Mes</option>
      <option value="2">Grafica Ventas Del Mes Empleados</option>
    </select>
    <button type="submit">Buscar</button>
  </form>
  <?php
    extract($_POST);
    if($Grafica==1)
    {
      echo "<div id='chart_div' class='container-fluid' style='height: 500px;'></div>";
    }
    if ($Grafica==2) {
      echo "<div id='top_x_div' style='width: 900px; height: 500px;'></div>";
    }
  ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
