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
            $query = "select nombre_usuario,password from usuarios where nombre_usuario='$usuario'";
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
                echo "<div class='alert alert-success'>";
                echo "<h2 align='center'>BIENVENIDO ".$_SESSION['usuario']."</h2></div>";
                
                $consulta = "select roles.nombre
                from roles
                inner join rol_usuario on roles.id_rol=rol_usuario.rol
                inner join usuarios on usuarios.id_usuario=rol_usuario.usuario
                where usuarios.nombre_usuario='$usuario'";
                $resultado=$this->PDOLocal->query($consulta);

                switch ($resultado) {
                    case 'usuario':
                        echo"eres usuario";
                    break;
                    case 'recepcionista':
                        echo"eres recepcionista";
                        header("refresh:2;../Views/Panel_Recepcionista.php");
                    break;
                    case 'administrador':
                        echo"eres admin";
                    break;
                }
            }
            else
            {
                echo "<div class='alert alert-danger'>";
                echo "<h2 align='center'>USUARIO INCORRECTO</h2></div>";
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
}
?>