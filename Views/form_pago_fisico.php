<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
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
        <option value="tarjeta">Tarjeta</option>
        <option value="efectivo">Efectivo</option>
        <option value="transferencia">Transferencia</option>
    </select> <br>
    
    <div class="form-check mb-3 mt-4">
        <input type="checkbox" class="form-check-input" id="facturar" onclick="toggleBilling()">
        <label class="form-check-label" for="facturar">Desea Facturar</label>
    </div>

    <div id="billingForm" style="display: none;">
        <h4 class="mb-3">Datos de Facturación</h4>
        <div class="mb-3">
            <label for="nombreFactura" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreFactura" name="nombreFactura" placeholder="Nombre completo" maxlength="30"  onkeypress="return sololetras(event);"  >
        </div>
        <div class="mb-3">
            <label for="apellidoPaternoFactura" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellidoPaternoFactura" name="apellidoPaternoFactura" placeholder="Apellido Paterno" maxlength="30"  onkeypress="return sololetras(event);"  >
        </div>
        <div class="mb-3">
            <label for="apellidoMaternoFactura" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" id="apellidoMaternoFactura" name="apellidoMaternoFactura" placeholder="Apellido Materno" maxlength="30"  onkeypress="return sololetras(event);"  >
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle 123, Ciudad, País" maxlength="100">
        </div>
        <div class="mb-3">
            <label for="rfc" class="form-label">RFC</label>
            <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" maxLength="13">
        </div>
    </div>
    <button type="submit" id="submit-button">Enviar</button>
</form>
      </div>
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
        const cantidad = localStorage.getItem('cantidad');
        const fechainicio = localStorage.getItem('fechaInicio');
        const fechafin = localStorage.getItem('fechaFin');
        

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
                    'cantidad': cantidad,
                    'fechainicio': fechainicio,
                    'fechafin': fechafin,
                    'metodo': document.getElementById('metodo').value
                })
            }).then(response => {
                console.log('Response status:', response);
                return response.json();
            }).then((data) => {
                console.log(data);
                alert('datos enviados')
               setTimeout(() => {
                    window.location.href = "../index.php";
                }, 2000); // Redirigir después de 2 segundos 
            });
        }

function toggleBilling() {
    const checkbox = document.getElementById('facturar');
    const billingForm = document.getElementById('billingForm');
    
    // IDs de los inputs en el formulario de facturación
    const inputIds = ['nombreFactura', 'apellidoPaternoFactura', 'apellidoMaternoFactura', 'direccion', 'rfc'];
    
    // Mostrar u ocultar el formulario de facturación
    if (checkbox.checked) {
        billingForm.style.display = 'block';
    } else {
        billingForm.style.display = 'none';
    }

    // Hacer required o no los campos
    inputIds.forEach(function(inputId) {
        const inputElement = document.getElementById(inputId);
        if (checkbox.checked) {
            inputElement.setAttribute('required', 'required');
        } else {
            inputElement.removeAttribute('required');
        }
    });
}

function sololetras (e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = " abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        especiales = [8,13];
        tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla)== -1 && !tecla_especial){
            alert("Solo letras");
            return false;
        }
    }

    function solonumeros (e) {
        if(window.event){
            keynum = evt.keyCode;
        }
        else {
            keynum = evt.which;
        }

        if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 0){
            return true;
        }
        else{
            alert("Solo numeros");
            return false;
        }

    }
    

function validartelefono(input){
    input.value = input.value.replace(/\D/g, '');
    
};
    
    </script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const validacionInputs = [
        { name: 'nombreFactura', minLength: 3 },
        { name: 'apellidoPaternoFactura', minLength: 4 },
        { name: 'apellidoMaternoFactura', minLength: 4 },
        { name: 'direccion', minLength: 10 },
        { name: 'rfc', minLength: 13 }
    ];

    const boton = document.getElementById('submit-button');
    const inputs = document.querySelectorAll('input');

    function validarFormulario() {
        let allValid = true;

        validacionInputs.forEach(({ name, minLength, maxLength }) => {
            const input = document.querySelector(`[name="${name}"]`);
            const value = input.value.trim();

            if (value.length < minLength || (maxLength && value.length > maxLength)) {
                input.style.borderColor = 'red';
                allValid = false;
            } else {
                input.style.borderColor = 'green';
            }
        });

        boton.disabled = true;
    }

    inputs.forEach(input => {
        input.addEventListener('input', validarFormulario);
    });
});
</script>

</body>
</html>
