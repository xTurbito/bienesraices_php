<?php 

require 'includes/config/databases.php';
$db = conectarDB();


$errores = [];

//Autenticar el usuario
if($_SERVER['REQUEST_METHOD'] === 'POST'){


    $email = mysqli_real_escape_string($db,filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ;
    $password = mysqli_real_escape_string($db,$_POST['password']);

    if(!$email){
        $errores[] = "El email es obligatorio o no es valido";
    }

    if(!$password){
        $errores[] = "El Password es obligatorio";
    }

    if(empty($errores)){

        //Revisar si existe el usuario
        $query = "SELECT *  FROM usuarios WHERE email = '{$email}' ";
        $resultado = mysqli_query($db, $query);
        

        if( $resultado -> num_rows){
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            //Verificar si el password es correcto

            $auth = password_verify($password ,$usuario['password']);
            
            if($auth){
                //El usuario esta autenticado
                session_start();

                //LLenar el arreglo de la sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: /admin');
 
            }else{
                $errores[] = 'El password es incorrecto';
            }
        }else {
            $errores[] = "El usuario no existe";
        }
    }
}


//Incluye el header
require 'includes/funciones.php';


includeTemplate('header');
?>
    
    

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <form method="POST" class="formulario" action="">
        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="email" >

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" > 


        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>
    
    <?php
includeTemplate('footer');

?>