<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>check 2</title>
    <link rel="stylesheet" href="./check2.css">
    <link rel="stylesheet" href="../index/bootstrap-5.3.3-dist/css/bootstrap.css">
</head>
<body>
    <style>
        :root {  
  --pi: 22 / 7;
  --size: 120;
  --stroke: 5;
  --radius: calc((var(--size) / 2) - (var(--stroke) / 2));
  --circumference: calc(2 * var(--pi) * var(--radius));
  --color: #4ffa85;
}

body {
  background: rgb(116, 13, 13) !important;
  display: flex;
  min-height: 100vh;
  margin: 0;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  color: white;
}

.confirm {
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  width: calc(var(--size) * 1px);
  height: calc(var(--size) * 1px);
}

.confirm:after {
  content: "";
  left: 50%;
  top: 50%;
  width: 100%;
  height: 100%;
  transform: translate(-50%, -50%);
  position: absolute;
  border-radius: 50%;
  animation: pulse ease-in-out 1s 2s;
}

.confirm:before {
  content: "";
  left: 50%;
  top: 50%;
  width: 100%;
  height: 100%;
  transform: translate(-50%, -50%);
  position: absolute;
  border-radius: 50%;
  animation: pulse ease-in-out 1s 2.5s;
}

.confirm__progress {
  transform: rotate(-90deg);
  width: var(--size);
  height: var(--size);
}

.confirm__value {
  stroke: var(--color) !important;
  stroke-linecap: round;
  stroke-width: var(--stroke) !important;
  fill: none;
  stroke-dasharray: var(--circumference);
  animation: confirmprogress 2s alternate;
}
.confirm__inner {
  border-radius: 50%;
  background: var(--color) !important;
  width: 75%;
  height: 75%;
  top: 12.5%;
  left: 12.5%;
  transform-origin: 50% 50%;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 2em;
  animation: rotate 2s, confirminner alternate 1s 2s;
  animation-fill-mode: forwards;
}

.confirm__inner:after {
  content: "\231B";
  position: absolute;
  animation: confirminnerafter alternate 1s 2s;
  animation-fill-mode: forwards;
}

.action {
  margin-top: 3em;
}

@keyframes confirmprogress { /* Firefox */
  from {
    stroke-dashoffset: var(--circumference);
  }
  to {
    stroke-dashoffset: 0;
  }
}

@supports (cx: 0) {
  @keyframes confirmprogress { /* Chrome */
    from {
      stroke-dashoffset: calc(var(--circumference) * 1px);
    }
    to {
      stroke-dashoffset: 0;
    }
  }
}

@keyframes pulse {
  0% {
    transform: translate(-50%, -50%) scale(1, 1);
    opacity: 0;
    border: 5px solid var(--color);
  }
  50% {
    opacity: 1;
  }
  100% {
    border: 1px solid var(--color);
    transform: translate(-50%, -50%) scale(1.3, 1.3);
    opacity: 0;
  }
}

@keyframes confirminnerafter {
  from {
    content: "\231B";
  }
  to {
    content: "\2713";
    transform: rotateY(180deg);
  }
}

@keyframes confirminner {
  to {
    transform: rotateY(180deg);
  }
}

@keyframes rotate {
  to {
    transform: rotate(720deg);
  }
}

.contenedorxd {
  top: -250%;
  background-color: white !important;
  width: 70%;
  height: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.contenedor {
  top: -150%;
  background-color: white !important;
  width: 60%;
  height: 80vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  border-radius: 1%;
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

h1, h2, h5, h3 {
  color: black !important;
  opacity: 0;
  animation: fadeInUp 0.4s ease-in-out forwards;
}

.contenedorxd h5 {
  animation-delay: 0.6s;
}

.contenedorxd h1 {
  animation-delay: 0.7s;
}

.contenedorxd h2 {
  animation-delay: 0.8s;
}

.contenedorxd h3 {
  animation-delay: 0.9s;
}

@media (max-width: 576px) {
  .contenedorxd {
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
  h1, h2, h5, h3 {
    text-align: center;
    font-size: 90%; /* Ajusta el tamaño según sea necesario */
    word-break: break-word;
  }
}



    </style>
  <div class="contenedor">
      <div class="confirm">
        <svg class="confirm__progress">
          <circle class="confirm__value" cx="50%" cy="50%" r="54" />
        </svg>
        <div class="confirm__inner"></div>
      </div>
      <div class="contenedorxd" style="box-shadow: black;">
        <h5>Hotel Laguna Inn</h5>
        <h1>¡Pago exitoso!</h1>
        <h2>Gracias por tu preferencia</h2>
        <h3>Disfruta tu estancia en nuestro hotel</h3>

        <form id="autoSubmitForm" method="post" action="http://localhost:5000/sucess_email" style="display:none;">
            <input type="hidden" name="pago_exitoso" value="true">
        </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
      $(document).ready(function(){
          $.ajax({
              url: 'http://localhost:5000/sucess_email',
              type: 'POST',
              data: { pago_exitoso: 'true' },
              success: function(response) {
                  console.log(response.message);
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
              }
          });
      });
  </script>
</body>
</html>
