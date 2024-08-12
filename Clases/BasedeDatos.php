<?php
class Database
{
    private $PDOLocal;
    private $user="gaelico";
    private $password="1234";
    private $server="mysql:host=localhost; dbname=INTEGRADORA_ROL_USUARIOSv2; charset=utf8";
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
    public function prepare($sql) {
        try {
            return $this->PDOLocal->prepare($sql);
        } catch (PDOException $e) {
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
                           
                            $consulta = "SELECT USUARIOS.ID_USUARIO as ID FROM USUARIOS WHERE USUARIOS.NOMBRE_USUARIO = :usuario";
                            $stmt = $this->PDOLocal->prepare($consulta);
                            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                            $_SESSION['id_usuario'] = $resultado['ID'];

                            $id_usuario = $resultado['ID'];

                            $sql = "SELECT COUNT(*) as count FROM PERSONA WHERE USUARIO = :usuario";
                           $stmt = $this->PDOLocal->prepare($sql);
                           $stmt->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
                           $stmt->execute();
                          $row = $stmt->fetch(PDO::FETCH_ASSOC);

                           if ($row['count'] > 0) {

                            $huesped= "SELECT HUESPED.ID_HUESPED AS HUESPED
                                    FROM PERSONA INNER JOIN USUARIOS ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
                                    INNER JOIN HUESPED ON PERSONA.ID_PERSONA = HUESPED.PERSONA_HUESPED
                                    WHERE USUARIOS.ID_USUARIO= :id;  ";

                              $stmt = $this->PDOLocal->prepare($huesped);
                              $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
                              $stmt->execute();
                              $huesped= $stmt->fetchAll(PDO::FETCH_ASSOC);

                            $_SESSION['huesped'] = $huesped;

                            header("Location:../index.php");
                            
                          }
                          else {
                            header("Location:../Views/form_persona.php");
                      }



                           
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
                header('Location: ../Views/Login.php?status=failed_login');
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
            $stmt = $this->PDOLocal->prepare("CALL AGREGAR_HABITACIONES(:tipo)");
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

function detalle_reservacion($fechaInicio,$fechaFin,$titular,$ninos,$adultos,$tipo_habitacion){
    try{

        echo "Hola";
        $stmt = $this->PDOLocal->prepare("CALL Detalle_Reservacion_Combinado(:fechaInicio,:fechaFin,:titular,:ninos,:adultos,:tipo_habitacion)");
        $stmt->bindParam(':fechaInicio',$fechaInicio,PDO::PARAM_STR);
        $stmt->bindParam(':fechaFin',$fechaFin,PDO::PARAM_STR);
        $stmt->bindParam(':titular',$titular,PDO::PARAM_STR);
        $stmt->bindParam(':ninos',$ninos,PDO::PARAM_INT);
        $stmt->bindParam(':adultos',$adultos,PDO::PARAM_INT);
        $stmt->bindParam(':tipo_habitacion',$tipo_habitacion,PDO::PARAM_STR);
        $stmt->execute();

        echo "Adios";
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function detalle_pago($metodo_pago,$monto_total){
    try{
        echo "Hola";
     $stmt = $this->PDOLocal->prepare("CALL RegistrarPagoReservacionLinea(:metodo_pago,:monto_total)");
     $stmt->bindParam(':metodo_pago',$metodo_pago,PDO::PARAM_STR);
     $stmt->bindParam(':monto_total',$monto_total,PDO::PARAM_INT);
     $stmt->execute();

     echo "Adios";
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function reservacionpasada($huesped,$recepcionista,$fecha,$estado_reservacion){
    try{
        echo"Hola";
     $stmt = $this->PDOLocal->prepare("CALL linea_reservacion_vieja(:huesped,:recepcionista,:fecha_actual,:estado_reservacion)");
     $stmt->bindParam(':huesped',$huesped,PDO::PARAM_INT);
     $stmt->bindParam(':recepcionista',$recepcionista,PDO::PARAM_INT);
     $stmt->bindParam(':fecha_actual',$fecha,PDO::PARAM_STR);
     $stmt->bindParam(':estado_reservacion',$estado_reservacion,PDO::PARAM_STR);
     $stmt->execute();

     echo "Adios";
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }



}

function facturacion($nombre,$a_paterno,$a_materno,$rfc,$direccion){

    try{

        $stmt = $this->PDOLocal->prepare("CALL registro_facturacion(:nombre,:a_paterno,:a_materno,:rfc,:direccion)");
        $stmt->bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $stmt->bindParam(':a_paterno',$a_paterno,PDO::PARAM_STR);
        $stmt->bindParam(':a_materno',$a_materno,PDO::PARAM_STR);
        $stmt->bindParam(':rfc',$rfc,PDO::PARAM_STR);
        $stmt->bindParam(':direccion',$direccion,PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
}


?>