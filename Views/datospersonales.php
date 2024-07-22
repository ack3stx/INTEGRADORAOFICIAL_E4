<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/datosp.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../phone-number-validation/css/demo.css">
        <link rel="stylesheet" href="../phone-number-validation/css/intlTelInput.css">
    <title>Datos personales </title>
    <style>
        #agua{
    display: none;


}
    </style>
</head>
<body>
    <section class="header-section ola chico ">
        <button class="btn glass" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            <span class="material-symbols-outlined">
                menu
            </span>
        </button>
        <div class="header-content">
            <p>LOS CEDROS HOTEL INN</p>
            <h1>HABITACIONES</h1>
            <div class="dropdown">
                <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-symbols-outlined ">
                        account_circle

                    </span>
                </button>
                <ul class="dropdown-menu glass">
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined lia">
                                person
                            </span> Gestionar cuenta </a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined">
                                travel_explore
                            </span>Historial de Reservación</a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined">
                                add_comment
                            </span>Comentarios</a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined">
                                favorite
                            </span>Favoritos</a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined">
                                logout
                            </span>Cerrar sesión</a></li>
                </ul>
            </div>

        </div>
    </section>
    <br>
    <div class="container utt">
    <h1><strong>Datos personales</strong></h1>
    <p style="align-items: center;">Actualiza tus datos y descubre cómo se utilizan</p>
    <br>
    <hr class="mb-4">
    <div class="juntos">
    <p id="no1">Nombre</p> 
    <p id="no2">Castro Etni</p>
</div>
    <button id="editar" type="button" class="btn lol" data-bs-toggle="button">Editar</button>
    
    <!--LO QUE SALE CUANDO LE DAS-->
    <div id="info">
        
        <div class="aaa">
        <p><strong>Nombre(s)</strong></p>&nbsp;&nbsp;<p class="arreglar"><strong>Apellido(s)</strong></p>
        </div>
        <input type="text">&nbsp;&nbsp;&nbsp;&nbsp;<input type="text">
        <button id="cancelar" type="button" class="btn lal" data-bs-toggle="button">Cancelar</button>
        
    </div>




    <!---->
    <hr class="mb-4">
    <p>Nombre para mostrar</p>
    <p id="bb">Elige un nombre para mostrar</p>
    <button id="editar2"  type="button" class="btn lol" data-bs-toggle="button">Editar</button>
    <!--LO QUE SALE DEL BOTON-->
    <div id="nommos">
        <p class="col-lg-2" style="margin-left: 30%; margin-top: -6%;"><strong>Nombre para mostrar</strong></p>
        <input class="col-lg-6"  style="margin-left: 30%;margin-bottom: 0%;" type="text">




    </div>
    <!---->
    <hr class="mb-4">
    <p id="coco">Dirección de email</p>
    <p id="ma">etnicastro9@gmail.com</p>
    <p id="mo">Este es el e-mail que usas para iniciar sesión y en el que recibes la confirmación de las reservas</p>
    <button style="margin-left: 90%;" id="editar3"  type="button" class="btn lol" data-bs-toggle="button">Editar</button>
    <!--LO QUE APARECE CUANDO LE DAS CLICK AL BOTON-->
<div id="agua">

    <p class="col-lg-2" style="margin-left: 30%; margin-top: -6%;"><strong>Email</strong></p>
    <input class="col-lg-6"  style="margin-left: 30%;margin-bottom: 0%;" type="text">

    
</div>



    <!---->
    <hr class="mb-4">
    <p>Numero de teléfono</p>
    <p>Indica tu número de teléfono</p>
    <button id="editar4"  type="button" class="btn lol" data-bs-toggle="button">Editar</button>
<!--LO QUE APARECE CUANDO LE DAS BOTON-->
<div id="paradise">
<p>Numero de Telefono</p>
<input type="tel" id="phone" placeholder="Escribe tu Número">




</div>






<!---->



    <hr class="mb-4">
    <p>Género</p>
    <p>Selecciona tu género</p>
    <hr class="mb-4">
    <p>Dirección</p>
    <p>Añade tu dirección</p>
    <hr class="mb-4">
    </div>

<div class="lg">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="list-group ">
                    <a href="#" class="list-group-item list-group-item-action">Datos personales</a>
                    <a href="#" class="list-group-item list-group-item-action">Preferencias</a>
                    <a href="#" class="list-group-item list-group-item-action">Seguridad</a>
                    <a href="#" class="list-group-item list-group-item-action">Datos de pago</a>
                    
            
                </div>
            </div>    
        </div>
    </div>
   </div> 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"> </script>
    <script src="../phone-number-validation/js/intlTelInput-jquery.js"></script>
    <script>
     






        document.getElementById('editar').addEventListener('click',function mostrar(){
        
           
            document.getElementById('info').style.display= 'block';
            document.getElementById('editar').style.display='none';
            document.getElementById('no2').style.display='none';
            document.getElementById('editar2').disabled=true;
        
        });
        
        
        document.getElementById('editar2').addEventListener('click',function mostrar(){
        
           
            document.getElementById('nommos').style.display= 'block';
            document.getElementById('editar2').style.display='none';
            document.getElementById('bb').style.display='none';
            document.getElementById('editar').disabled=true;
            
        
        });


        document.getElementById('editar3').addEventListener('click',function mostrar(){
        
           
        document.getElementById('agua').style.display= 'block';
        document.getElementById('editar3').style.display='none';
        document.getElementById('editar').disabled=true;
        document.getElementById('ma').style.display='none';
        document.getElementById('mo').style.display='none';
        document.getElementById('editar2').disabled=true;
        
    
    });
        
        </script>
</body>
</html>