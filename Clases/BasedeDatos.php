<?php
class Database
{
    private $PDOLocal;
    private $user="gaelico";
    private $password="1234";
    private $server="mysql:host=localhost; dbname=INTEGRADORA_ROL_USUARIOSv2";
    function conectarDB()
    {
        try
        {
            $this->PDOLocal = new PDO($this->server,$this->user,$this->password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    function desconectarBD()
    {
        try
        {
            $this->PDOLocal = null;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }   
    }

    function  seleccionar($consulta)
    {
        try
        {
            $resultado = $this->PDOLocal->query($consulta);
            $fila = $resultado->fetchAll(PDO::FETCH_OBJ);
            return $fila;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }   
    }

    function ejecuta($consulta)
    {
        try
        {
            $this->PDOLocal->query($consulta);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    function verificar ($usuario,$contra)
    {
        try
        {
            $pase = false;
            $query = "select nombre_usuario,password from USUARIOS where nombre_usuario='$usuario'";
            $resultado=$this->PDOLocal->query($query);
            while($renglon = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                if(password_verify($contra,$renglon['password']))
                {
                    $pase=true;
                }
            }

            if ($pase)
            {
                session_start();
                $_SESSION["usuario"]= $usuario;
                
                $consulta = "select ROLES.nombre
                from ROLES
                inner join ROL_USUARIO on ROLES.id_rol=ROL_USUARIO.rol
                inner join USUARIOS on USUARIOS.id_usuario=ROL_USUARIO.usuario
                where USUARIOS.nombre_usuario='$usuario'";
                $resultado=$this->PDOLocal->query($consulta);
                $fila = $resultado->fetchAll(PDO::FETCH_OBJ);

                foreach($fila as $reg)
                {
                    switch ($reg->nombre) {
                        case 'usuario':
                            header("Location:../index.php");
                        break;
                        case 'recepcionista':
                            header("Location:../Views/Panel_Recepcionista.php");
                        break;
                        case 'administrador':
                            header("Location:../Views/Panel_Admin.php");
                        break;
                    }
                    $_SESSION["rol"]=$reg->nombre;
                }
            }
            else{
                header('Location: ../views/login.php?status=failed_login');
                exit();
            }


        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location:../index.php");
    }
    function agregarHabitaciones($tipo)
    {
        try
        {
            $stmt = $this->PDOLocal->prepare("CALL agregar_habitaciones(:tipo)");
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
   
    function obtenerMesActualn() {
        date_default_timezone_set('America/Monterrey');
        $meses = array(
            1 => 'Enero', 
            2 => 'Febrero', 
            3 => 'Marzo', 
            4 => 'Abril', 
            5 => 'Mayo', 
            6 => 'Junio', 
            7 => 'Julio', 
            8 => 'Agosto', 
            9 => 'Septiembre', 
            10 => 'Octubre', 
            11 => 'Noviembre', 
            12 => 'Diciembre'
        );
    
        $mesActual = date('n');
        return $mesActual;
        }

function obtenerMesYAñoActual() {
    date_default_timezone_set('America/Monterrey');
    $meses = array(
        1 => 'Enero', 
        2 => 'Febrero', 
        3 => 'Marzo', 
        4 => 'Abril', 
        5 => 'Mayo', 
        6 => 'Junio', 
        7 => 'Julio', 
        8 => 'Agosto', 
        9 => 'Septiembre', 
        10 => 'Octubre', 
        11 => 'Noviembre', 
        12 => 'Diciembre'
    );

    $mesActual = $meses[date('n')];
    $añoActual = date('Y');
    
    return array($mesActual, $añoActual);
}

function disponibilidad($fechaInicio,$fechaFin)
{
    try{
    $stmt = $this->PDOLocal->prepare("CALL Disponibilidad_habitaciones_doble(:fecha_inicio,:fecha_fin)");
    $stmt->bindParam(':fecha_inicio',$fechaInicio,PDO::PARAM_STR);
    $stmt->bindParam(':fecha_fin',$fechaFin,PDO::PARAM_STR);
    $stmt->execute();
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    

}

function disponibilidad_kingsize($fechaInicio,$fechaFin)
{
    try{
    $stmt = $this->PDOLocal->prepare("CALL Disponibilidad_habitaciones_kingsize(:fecha_inicio,:fecha_fin)");
    $stmt->bindParam(':fecha_inicio',$fechaInicio,PDO::PARAM_STR);
    $stmt->bindParam(':fecha_fin',$fechaFin,PDO::PARAM_STR);
    $stmt->execute();
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    

}


function disponibilidad_sencilla($fechaInicio,$fechaFin)
{
    try{
    $stmt = $this->PDOLocal->prepare("CALL Disponibilidad_habitaciones_sencilla(:fecha_inicio,:fecha_fin)");
    $stmt->bindParam(':fecha_inicio',$fechaInicio,PDO::PARAM_STR);
    $stmt->bindParam(':fecha_fin',$fechaFin,PDO::PARAM_STR);
    $stmt->execute();
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    

}

function calculo_reserva ($fechaInicio,$fechaFin,$tipohab)
{

    try{
        $stmt = $this->PDOLocal->prepare("CALL CALCULO_RESERVA(:fecha_inicio,:fecha_fin,:tipo)");
        $stmt->bindParam(':fecha_inicio',$fechaInicio,PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin',$fechaInicio,PDO::PARAM_STR);
        $stmt->bindParam(':tipo',$fechaInicio,PDO::PARAM_STR);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;



    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

}

function registro($nombre, $apellidopaterno, $apellidomaterno, $f_nac, $direccion, $ciudad, $estado,$codigo_postal,$pais,$genero,$numero_telefono,$usuario){

    try{

        $stmt = $this->PDOLocal->prepare("CALL RegistrarHuespedPersona_En_Linea(:nombre,:apellidopaterno,:apellidomaterno,:f_nac,:direccion,:ciudad,:estado,:codigo_postal,:pais,:genero,:numero_telefono,:usuario)");
        $stmt->bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $stmt->bindParam(':apellidopaterno',$apellidopaterno,PDO::PARAM_STR);
        $stmt->bindParam(':apellidomaterno',$apellidomaterno,PDO::PARAM_STR);
        $stmt->bindParam(':f_nac',$f_nac,PDO::PARAM_STR);
        $stmt->bindParam(':direccion',$direccion,PDO::PARAM_STR);
        $stmt->bindParam(':ciudad',$ciudad,PDO::PARAM_STR);
        $stmt->bindParam(':estado',$estado,PDO::PARAM_STR);
        $stmt->bindParam(':codigo_postal',$codigo_postal,PDO::PARAM_STR);
        $stmt->bindParam(':pais',$pais,PDO::PARAM_STR);
        $stmt->bindParam(':genero',$genero,PDO::PARAM_STR);
        $stmt->bindParam(':numero_telefono',$numero_telefono,PDO::PARAM_STR);
        $stmt->bindParam(':usuario',$usuario,PDO::PARAM_INT);

        $stmt->execute();
        
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }




}

function reservacion($recepcionista,$fecha,$estado_reservacion){
    try{

        $stmt = $this->PDOLocal->prepare("CALL CrearReservacion_En_Linea(:recepcionista,:fecha,:estado_reservacion)");
        $stmt->bindParam(':recepcionista',$recepcionista,PDO::PARAM_INT);
        $stmt->bindParam(':fecha',$fecha,PDO::PARAM_STR);
        $stmt->bindParam(':estado_reservacion',$estado_reservacion,PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}




}


?>