<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container" id="holiwis">
        <form id="payment-form" action="../Scripts/redireccionar.php" method="post">
            <h3 class="text-center">Método de Pago</h3><br>
            <select class="form-select" name="metodo" id="metodo" required>
                <option value="tar">Tarjeta</option>
                <option value="efe">Efectivo</option>
                <option value="tra">Transferencia</option>
            </select> <br>
            <button type="submit" id="submit-button">Enviar</button>
        </form>
    </div>

    <div class="confirmation" id="eso" style="display: none;">
        <div class="contenedorxd">
            <h5>Hotel Laguna Inn</h5>
            <h1>¡Pago exitoso!</h1>
            <h2>Gracias por tu preferencia</h2>
            <h3>Disfruta tu estancia en nuestro hotel</h3>
        </div>
    </div>

    <script>
        const persona = JSON.parse(localStorage.getItem('persona'));
        const habitaciones = JSON.parse(localStorage.getItem('tiposSeleccionados'));
        const facturacion = JSON.parse(localStorage.getItem('facturacion'));
        const cantidad = localStorage.getItem('cantidad');
        const fechainicio = localStorage.getItem('fechaInicio');
        const fechafin = localStorage.getItem('fechaFin');
        const ninos = localStorage.getItem('selectedKids');
        const adultos = localStorage.getItem('selectedAdults');

        document.getElementById('payment-form').addEventListener('submit', function () {
            // Aquí puedes realizar cualquier validación adicional si es necesario
            // Pero no prevengas el comportamiento predeterminado para que la redirección ocurra
            mandardatos(this);
        });

        function mandardatos(form) {
            fetch('../Scripts/recibirinfopersona_fisica.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'persona': JSON.stringify(persona),
                    'habitaciones': JSON.stringify(habitaciones),
                    'facturacion': JSON.stringify(facturacion),
                    'cantidad': cantidad,
                    'fechainicio': fechainicio,
                    'fechafin': fechafin,
                    'ninos': ninos,
                    'adultos': adultos,
                    'metodo': document.getElementById('metodo').value
                })
            }).then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then((data) => {
                console.log(data);
                setTimeout(() => {
                    window.location.href = "../index.php";
                }, 2000); // Redirigir después de 2 segundos
            });
        }
    </script>
</body>
</html>
