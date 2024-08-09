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
    $mesn = $db->obtenerMesActualn();
?>
    <title>Document</title>
</head>
<body>
<?php
  session_start();
  
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
  <br>
  <form action="" method="post" class="d-flex">
    <select name="Grafica" class="form-select w-75">
      <option value="1">Grafica Meta Del Mes</option>
      <option value="2">Grafica Ventas Del Mes Empleados</option>
      <option value="3">Grafica Estadisticas Reservaciones Del Año</option>
    </select>&nbsp;
    <button type="submit" class="btn btn-outline-danger">Buscar</button>
  </form>
  <?php
    $Grafica = 0;
    extract($_POST);
    if ($Grafica == 1) {
        $consulta = "SELECT SUM(DETALLE_PAGO.MONTO_TOTAL) AS TOTAL_MONTOL, X.TOTAL_MONTOF
FROM (SELECT SUM(DETALLE_PAGO.MONTO_TOTAL) AS TOTAL_MONTOF
FROM RESERVACION
INNER JOIN DETALLE_PAGO ON RESERVACION.ID_RESERVACION = DETALLE_PAGO.RESERVACION
WHERE RESERVACION.RECEPCIONISTA IS NOT NULL AND MONTH(RESERVACION.FECHA_) = $mesn AND YEAR(RESERVACION.FECHA_) = $año) AS X
LEFT JOIN RESERVACION ON RESERVACION.RECEPCIONISTA IS NULL AND MONTH(RESERVACION.FECHA_) = $mesn AND YEAR(RESERVACION.FECHA_) = $año
LEFT JOIN DETALLE_PAGO ON RESERVACION.ID_RESERVACION = DETALLE_PAGO.RESERVACION;";
        $array = $db->seleccionar($consulta);
        foreach ($array as $monto_total) {
            $montola = $monto_total->TOTAL_MONTOL;
            $montofa = $monto_total->TOTAL_MONTOF;
        }
        if (!isset($montola)) {
            $montola = 0;
        }
        if (!isset($montofa)) {
            $montofa = 0;
        }
        $mesn2 = $mesn - 1;
        $consulta2 = "SELECT SUM(DETALLE_PAGO.MONTO_TOTAL) AS TOTAL_MONTOL, X.TOTAL_MONTOF
FROM (SELECT SUM(DETALLE_PAGO.MONTO_TOTAL) AS TOTAL_MONTOF
FROM RESERVACION
INNER JOIN DETALLE_PAGO ON RESERVACION.ID_RESERVACION = DETALLE_PAGO.RESERVACION
WHERE RESERVACION.RECEPCIONISTA IS NOT NULL 
AND MONTH(RESERVACION.FECHA_) = $mesn2
AND YEAR(RESERVACION.FECHA_) = $año) AS X
LEFT JOIN RESERVACION ON RESERVACION.RECEPCIONISTA IS NULL AND MONTH(RESERVACION.FECHA_) = $mesn2 AND YEAR(RESERVACION.FECHA_) = $año
LEFT JOIN DETALLE_PAGO ON RESERVACION.ID_RESERVACION = DETALLE_PAGO.RESERVACION;";
        $array2 = $db->seleccionar($consulta2);
        foreach ($array2 as $monto_total2) {
            $montole = $monto_total2->TOTAL_MONTOL;
            $montofe = $monto_total2->TOTAL_MONTOF;
        }
        if (!isset($montole)) {
            $montole = 0;
        }
        if (!isset($montofe)) {
            $montofe = 0;
        }
        $totala = $montola + $montofa;
        $totale = $montole + $montofe;
        $aumento = $totale * .20;
        $montole = $montole + $aumento;
        $montofe = $montofe + $aumento;
        $totale = ($aumento * 2) + $totale;
        echo
        "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var chartDiv = document.getElementById('ventas_mes');

        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Linea', 'Fisico'],
          ['$mes ahora', $montola, $montofa],
          ['$mes Esperado', $montole, $montofe],
        ]);

        var classicOptions = {
          series: {
            0: {targetAxisIndex: 0}
          },
          title: 'Meta de $mes',
          vAxes: {
            0: {title: 'Nivel de Ventas'}
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
    </script>
    <div style='width: 100%; text-align: center; margin-bottom: 20px;'>
  <h5>Total ahora: $totala &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Esperado: $totale</h5>
</div>";
        echo "<div id='ventas_mes' class='container-fluid' style='height: 500px;'></div>";
    }
    if ($Grafica == 2) {
        $consulta3 = "SELECT CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO) AS NOMBRE, SUM(DETALLE_PAGO.MONTO_TOTAL) AS TOTAL_VENTAS
FROM ROLES
INNER JOIN ROL_USUARIO ON ROL_USUARIO.ROL = ROLES.ID_ROL
INNER JOIN USUARIOS ON USUARIOS.ID_USUARIO = ROL_USUARIO.USUARIO
INNER JOIN PERSONA ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
INNER JOIN RECEPCIONISTA ON RECEPCIONISTA.PERSONA_RECEPCIONISTA = PERSONA.ID_PERSONA
INNER JOIN RESERVACION ON RESERVACION.RECEPCIONISTA = RECEPCIONISTA.ID_RECEPCIONISTA
INNER JOIN DETALLE_PAGO ON DETALLE_PAGO.RESERVACION = RESERVACION.ID_RESERVACION
WHERE RESERVACION.RECEPCIONISTA IS NOT NULL AND MONTH(RESERVACION.FECHA_) = $mesn AND YEAR(RESERVACION.FECHA_) = $año
GROUP BY NOMBRE
ORDER BY TOTAL_VENTAS DESC
LIMIT 5;";
        $array3 = $db->seleccionar($consulta3);
        $empleado1 = $array3[0]->NOMBRE;
        $empleado2 = $array3[1]->NOMBRE;
        $empleado3 = $array3[2]->NOMBRE;
        $empleado4 = $array3[3]->NOMBRE;
        $empleado5 = $array3[4]->NOMBRE;

        $ventas1 = $array3[0]->TOTAL_VENTAS;
        $ventas2 = $array3[1]->TOTAL_VENTAS;
        $ventas3 = $array3[2]->TOTAL_VENTAS;
        $ventas4 = $array3[3]->TOTAL_VENTAS;
        $ventas5 = $array3[4]->TOTAL_VENTAS;

        echo "
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Empleados', 'Nivel de Ventas'],
          ['$empleado1', $ventas1],
          ['$empleado2', $ventas2],
          ['$empleado3', $ventas3],
          ['$empleado4', $ventas4],
          ['$empleado5', $ventas5]
        ]);

        var options = {
          title: 'Chess opening moves',
          legend: { position: 'none' },
          chart: {
            title: 'Reportes de $mes',
            subtitle: 'Reportes de ventas de los Empleados'
          },
          bars: 'horizontal',
          axes: {
            x: {
              0: { side: 'top', label: 'Nivel de Ventas'}
            }
          },
          bar: { groupWidth: '90%' }
        };

        var chart = new google.charts.Bar(document.getElementById('ventas_empleados'));
        
        function drawChart() {
          var chartWidth = document.getElementById('ventas_empleados').offsetWidth;
          var chartHeight = document.getElementById('ventas_empleados').offsetHeight;
          options.width = chartWidth;
          options.height = chartHeight;
          chart.draw(data, options);
        }

        drawChart();
        window.addEventListener('resize', drawChart);
      }
    </script>
    <style>
        #ventas_empleados {
            width: 100%;
            height: 500px;
        }
    </style>";

        echo "<div id='ventas_empleados'></div>";
    }
    if ($Grafica == 3) {
        $consulta4 = "WITH MESES AS (
    SELECT 1 AS MES UNION ALL
    SELECT 2 UNION ALL
    SELECT 3 UNION ALL
    SELECT 4 UNION ALL
    SELECT 5 UNION ALL
    SELECT 6 UNION ALL
    SELECT 7 UNION ALL
    SELECT 8 UNION ALL
    SELECT 9 UNION ALL
    SELECT 10 UNION ALL
    SELECT 11 UNION ALL
    SELECT 12
)
SELECT MESES.MES, COALESCE(COUNT(RESERVACION.ID_RESERVACION), 0) AS CANTIDAD_RESERVACIONES
FROM MESES
LEFT JOIN RESERVACION ON MONTH(RESERVACION.FECHA_) = MESES.MES 
AND YEAR(RESERVACION.FECHA_) = 2024
AND RESERVACION.ESTADO_RESERVACION NOT IN ('CANCELADA')
AND RESERVACION.RECEPCIONISTA IS NULL
GROUP BY MESES.MES
ORDER BY MESES.MES;";
        $array4 = $db->seleccionar($consulta4);

        $enerol = $array4[0]->CANTIDAD_RESERVACIONES;
        $febrerol = $array4[1]->CANTIDAD_RESERVACIONES;
        $marzol = $array4[2]->CANTIDAD_RESERVACIONES;
        $abrill = $array4[3]->CANTIDAD_RESERVACIONES;
        $mayol = $array4[4]->CANTIDAD_RESERVACIONES;
        $juniol = $array4[5]->CANTIDAD_RESERVACIONES;
        $juliol = $array4[6]->CANTIDAD_RESERVACIONES;
        $agostol = $array4[7]->CANTIDAD_RESERVACIONES;
        $septiembrel = $array4[8]->CANTIDAD_RESERVACIONES;
        $octubrel = $array4[9]->CANTIDAD_RESERVACIONES;
        $noviembrel = $array4[10]->CANTIDAD_RESERVACIONES;
        $diciembrel = $array4[11]->CANTIDAD_RESERVACIONES;

        $consulta5 = "WITH MESES AS (
    SELECT 1 AS MES UNION ALL
    SELECT 2 UNION ALL
    SELECT 3 UNION ALL
    SELECT 4 UNION ALL
    SELECT 5 UNION ALL
    SELECT 6 UNION ALL
    SELECT 7 UNION ALL
    SELECT 8 UNION ALL
    SELECT 9 UNION ALL
    SELECT 10 UNION ALL
    SELECT 11 UNION ALL
    SELECT 12
)
SELECT MESES.MES, COALESCE(COUNT(RESERVACION.ID_RESERVACION), 0) AS CANTIDAD_RESERVACIONES
FROM MESES
LEFT JOIN RESERVACION ON MONTH(RESERVACION.FECHA_) = MESES.MES 
AND YEAR(RESERVACION.FECHA_) = 2024
AND RESERVACION.ESTADO_RESERVACION NOT IN ('CANCELADA')
AND RESERVACION.RECEPCIONISTA IS NOT NULL
GROUP BY MESES.MES
ORDER BY MESES.MES;";

        $array5 = $db->seleccionar($consulta5);

        $enerof = $array5[0]->CANTIDAD_RESERVACIONES;
        $febrerof = $array5[1]->CANTIDAD_RESERVACIONES;
        $marzof = $array5[2]->CANTIDAD_RESERVACIONES;
        $abrilf = $array5[3]->CANTIDAD_RESERVACIONES;
        $mayof = $array5[4]->CANTIDAD_RESERVACIONES;
        $juniof = $array5[5]->CANTIDAD_RESERVACIONES;
        $juliof = $array5[6]->CANTIDAD_RESERVACIONES;
        $agostof = $array5[7]->CANTIDAD_RESERVACIONES;
        $septiembref = $array5[8]->CANTIDAD_RESERVACIONES;
        $octubref = $array5[9]->CANTIDAD_RESERVACIONES;
        $noviembref = $array5[10]->CANTIDAD_RESERVACIONES;
        $diciembref = $array5[11]->CANTIDAD_RESERVACIONES;

        $consulta6 = "SELECT COALESCE(COUNT(RESERVACION.ID_RESERVACION), 0) AS TOTAL_RESERVACIONESL, X.TOTAL_RESERVACIONESF
FROM (SELECT COALESCE(COUNT(RESERVACION.ID_RESERVACION), 0) AS TOTAL_RESERVACIONESF
FROM RESERVACION
WHERE RESERVACION.RECEPCIONISTA IS NOT NULL 
AND YEAR(RESERVACION.FECHA_) = 2024) AS X
LEFT JOIN RESERVACION ON RESERVACION.RECEPCIONISTA IS NULL AND YEAR(RESERVACION.FECHA_) = 2024;";

        $array6 = $db->seleccionar($consulta6);
        foreach ($array6 as $total_lof) {
            $total_fisico = $total_lof->TOTAL_RESERVACIONESF;
            $total_linea = $total_lof->TOTAL_RESERVACIONESL;
        }
        $total_reservas = $total_fisico + $total_linea;
        echo "
<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script type='text/javascript'>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Mes', 'Linea', 'Fisico'],
      ['Enero', $enerol, $enerof],
      ['Febrero', $febrerol, $febrerof],
      ['Marzo', $marzol, $marzof],
      ['Abril', $abrill, $abrilf],
      ['Mayo', $mayol, $mayof],
      ['Junio', $juniol, $juniof],
      ['Julio', $juliol, $juliof],
      ['Agosto', $agostol, $agostof],
      ['Septiembre', $septiembrel, $septiembref],
      ['Octubre', $octubrel, $octubref],
      ['Noviembre', $noviembrel, $noviembref],
      ['Diciembre', $diciembrel, $diciembref]
    ]);

    var options = {
      title: 'Reservaciones Del Año $año',
      hAxis: {title: 'Mes', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('reservaciones_año'));
    
    function drawResponsiveChart() {
      var container = document.getElementById('reservaciones_año');
      options.width = container.offsetWidth;
      options.height = container.offsetHeight;
      chart.draw(data, options);
    }
    
    drawResponsiveChart();
    window.addEventListener('resize', drawResponsiveChart);
  }
</script>

<div style='width: 100%; text-align: center; margin-bottom: 20px;'>
  <h5>Total De Reservaciones: $total_reservas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total En Linea: $total_linea &nbsp;&nbsp; Total En Fisico: $total_fisico</h5>
</div>";
    
        echo "<div id='reservaciones_año' style='width: 100%; height: 500px;'></div>";    
    }
  ?>
</body>
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
</html>
