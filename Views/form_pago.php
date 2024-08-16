<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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

<div class="notifications">
   

</div>

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
        <input type="checkbox" class="form-check-input" id="facturar" >
        <label class="form-check-label" for="facturar">Desea Facturar</label>
      </div>

            <button type="submit" id="submit-button" disabled>Enviar</button>
        </form>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
       
        const habitaciones = JSON.parse(localStorage.getItem('tiposSeleccionados'));
        //const facturacion = JSON.parse(localStorage.getItem('facturacion'));
        const cantidad = localStorage.getItem('cantidad');
        const fechainicio = localStorage.getItem('fechaInicio');
        const fechafin = localStorage.getItem('fechaFin');
        
        

        const submitButton = document.getElementById('submit-button');

     

        function enableSubmitButton() {
            const cardNumber = document.getElementById('card-number').value.replace(/\s+/g, '');
            const cardName = document.getElementById('card-name').value;
            const expiryDate = document.getElementById('expiry-date').value;
            const cvv = document.getElementById('cvv').value;

            if (cardNumber.length >= 13 && luhnCheck(cardNumber) && cardName.length > 0 && expiryDate.length === 5 && cvv.length >= 3) {
                submitButton.disabled = false;
                
            } else {
                submitButton.disabled = true;
            }
        }

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

            // Validación del algoritmo de Luhn
            if (cardNumber.length >= 13) {
                if (!luhnCheck(cardNumber)) {
                    cardType.textContent += ' (Invalid)';
                }
            }
            enableSubmitButton();
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

        document.getElementById('card-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const cardNumber = document.getElementById('card-number').value.replace(/\s+/g, '');
            if (!luhnCheck(cardNumber)) {
                
                alert('Número de tarjeta inválido.');
            } else {
                mandardatos();
            }
        });

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

        function toggleBilling() {
    const checkbox = document.getElementById('facturar');
    const billingForm = document.getElementById('billingForm');
    
    
    const inputIds = ['nombreFactura', 'apellidoPaternoFactura', 'apellidoMaternoFactura', 'direccion', 'rfc'];
    
    
    if (checkbox.checked) {
        billingForm.style.display = 'block';
    } else {
        billingForm.style.display = 'none';
    }

    
    inputIds.forEach(function(inputId) {
        const inputElement = document.getElementById(inputId);
        if (checkbox.checked) {
            inputElement.setAttribute('required', 'required');
        } else {
            inputElement.removeAttribute('required');
        }
    });
}



        function mandardatos() {

            const checkbox = document.getElementById('facturar');
            
            const redirectUrl = checkbox.checked ? "../Views/formfacturacion.php" : "../index.php";

            fetch('../Scripts/recibirinfopersona.php', {
                body: new URLSearchParams({
                    
                    'habitaciones': JSON.stringify(habitaciones),
                    //'facturacion': JSON.stringify(facturacion),
                    'cantidad': cantidad,
                    'fechainicio': fechainicio,
                    'fechafin': fechafin,
                    
                }),
                method: 'POST'
            }).then(response => {
                console.log('response:',response)
              
                
            }).then((data) => {
               // console.log(data);
             
               Toastify({
                text: "Reservacion realizada con exito",
                 //className: "info",
                 style: {
                 background: "rgba(214, 13, 13, 0.5)", 
                 color: "#fff", 
                 borderRadius: "8px", 
                 padding: "10px"
                 }
                 }).showToast();
                 
                 setTimeout(function() {
                 window.location.href = redirectUrl;
                   }, 2000); 
                
            }).catch((error) => {
                console.log(error);
               
            });
        }

        
        document.addEventListener('DOMContentLoaded',mandardatos);
        
    </script>
</body>
</html>