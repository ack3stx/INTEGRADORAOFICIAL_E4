<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Credit Card Form</title>
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

        .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .input-group span#card-type {
            position: absolute;
            top: 35px;
            right: 10px;
            font-weight: bold;
            color: #888;
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

        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <form id="card-form" action="../Scripts/redireccionar.php" method="post">
            <div class="input-group">
                <label for="card-number">Número de Tarjeta</label>
                <input type="text" id="card-number" maxlength="19" placeholder="1234 5678 9012 3456" required>
                <span id="card-type"></span>
            </div>
            <div class="input-group">
                <label for="card-name">Nombre en la Tarjeta</label>
                <input type="text" id="card-name" placeholder="Nombre completo" required>
            </div>
            <div class="input-group">
                <label for="expiry-date">Fecha de Expiración</label>
                <input type="text" id="expiry-date" maxlength="5" placeholder="MM/YY" required>
            </div>
            <div class="input-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" maxlength="4" placeholder="123" required>
            </div>

            <div class="form-check mb-3 mt-4">
                <input type="checkbox" class="form-check-input" id="facturar" onclick="toggleBilling()">
                <label class="form-check-label" for="facturar">Desea Facturar</label>
            </div>

            <div id="billingForm" style="display: none;">
                <h4 class="mb-3">Datos de Facturación</h4>
                <div class="mb-3">
                    <label for="nombreFactura" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreFactura" name="nombreFactura" placeholder="Nombre completo">
                </div>
                <div class="mb-3">
                    <label for="apellidoPaternoFactura" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellidoPaternoFactura" name="apellidoPaternoFactura" placeholder="Apellido Paterno">
                </div>
                <div class="mb-3">
                    <label for="apellidoMaternoFactura" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellidoMaternoFactura" name="apellidoMaternoFactura" placeholder="Apellido Materno">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle 123, Ciudad, País">
                </div>
                <div class="mb-3">
                    <label for="rfc" class="form-label">RFC</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC">
                </div>
            </div>
            <button type="submit" id="submit-button" disabled>Enviar</button>
        </form>
    </div>

    <script>
        const habitaciones = JSON.parse(localStorage.getItem('tiposSeleccionados'));
        const facturacion = JSON.parse(localStorage.getItem('facturacion'));
        const cantidad = localStorage.getItem('cantidad');
        const fechainicio = localStorage.getItem('fechaInicio');
        const fechafin = localStorage.getItem('fechaFin');

        document.getElementById('card-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const cardNumber = document.getElementById('card-number').value.replace(/\s+/g, '');
            if (!luhnCheck(cardNumber)) {
                alert('Número de tarjeta inválido.');
            } else {
                mandardatos().then(() => {
                    this.submit(); // Envía el formulario después de completar la función mandardatos
                });
            }
        });

        document.getElementById('card-number').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
            const cardNumber = this.value.replace(/\s+/g, '');
            const cardType = document.getElementById('card-type');
            const cvvInput = document.getElementById('cvv');
            const visaRegex = /^4/;
            const masterCardRegex = /^5[1-5]/;
            const amexRegex = /^3[47]/;
            const discoverRegex = /^6(?:011|5)/;

            if (visaRegex.test(cardNumber)) {
                cardType.textContent = 'Visa';
                cvvInput.maxLength = 3;
            } else if (masterCardRegex.test(cardNumber)) {
                cardType.textContent = 'MasterCard';
                cvvInput.maxLength = 3;
            } else if (amexRegex.test(cardNumber)) {
                cardType.textContent = 'Amex';
                cvvInput.maxLength = 4;
            } else if (discoverRegex.test(cardNumber)) {
                cardType.textContent = 'Discover';
                cvvInput.maxLength = 3;
            } else {
                cardType.textContent = '';
                cvvInput.maxLength = 3;
            }

            this.value = cardNumber.replace(/(\d{4})(?=\d)/g, '$1 ');

            if (cardNumber.length >= 13 && luhnCheck(cardNumber)) {
                document.getElementById('submit-button').disabled = false;
            } else {
                document.getElementById('submit-button').disabled = true;
            }
        });

        document.getElementById('card-name').addEventListener('input', function () {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            enableSubmitButton();
        });

        document.getElementById('expiry-date').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9/]/g, '');
            let input = e.target.value;
            if (input.length === 2 && !input.includes('/')) {
                e.target.value = input + '/';
            }
            enableSubmitButton();
        });

        document.getElementById('cvv').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
            enableSubmitButton();
        });

        function enableSubmitButton() {
            const cardNumber = document.getElementById('card-number').value.replace(/\s+/g, '');
            const cardName = document.getElementById('card-name').value;
            const expiryDate = document.getElementById('expiry-date').value;
            const cvv = document.getElementById('cvv').value;

            document.getElementById('submit-button').disabled = !(cardNumber.length >= 13 && luhnCheck(cardNumber) && cardName.length > 0 && expiryDate.length === 5 && cvv.length >= 3);
        }

        function luhnCheck(cardNumber) {
            let sum = 0;
            let shouldDouble = false;
            for (let i = cardNumber.length - 1; i >= 0; i--) {
                let digit = parseInt(cardNumber.charAt(i), 10);
                if (shouldDouble) {
                    digit *= 2;
                    if (digit > 9) digit -= 9;
                }
                sum += digit;
                shouldDouble = !shouldDouble;
            }
            return sum % 10 === 0;
        }

        function mandardatos() {
            return fetch('../Scripts/recibirinfopersona.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'habitaciones': JSON.stringify(habitaciones),
                    'facturacion': JSON.stringify(facturacion),
                    'cantidad': cantidad,
                    'fechainicio': fechainicio,
                    'fechafin': fechafin
                })
            }).then(response => {
                console.log('Response status:', response.status);
                return response.json();
            }).then((data) => {
                console.log(data);
                alert('Datos enviados');
            }).catch((error) => {
                console.error('Error:', error);
            });
        }

        function toggleBilling() {
            const checkbox = document.getElementById('facturar');
            const billingForm = document.getElementById('billingForm');
            
            const inputIds = ['nombreFactura', 'apellidoPaternoFactura', 'apellidoMaternoFactura', 'direccion', 'rfc'];
            
            if (checkbox.checked) {
                billingForm.style.display = 'block';
                inputIds.forEach(inputId => {
                    document.getElementById(inputId).setAttribute('required', 'required');
                });
            } else {
                billingForm.style.display = 'none';
                inputIds.forEach(inputId => {
                    document.getElementById(inputId).removeAttribute('required');
                });
            }
        }
    </script>
</body>
</html>
