<?php
class Database
{
    private $PDOLocal;
    private $user="root";
    private $password="";
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
                }
            }
            else
            {
                header("Location=../Views/Iniciar_sesion.php");
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

}
?>