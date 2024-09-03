<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

estaAutenticado();

$db = conectarDB();

// Consulta para vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

$propiedad = new Propiedad;

// Ejecutar el código después de que el usuario envíe el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /*Crear una nueva instancia */
    $propiedad = new Propiedad($_POST);


    /* SUBIDA DE ARCHIVOS */
  
    //Generar un nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
    if ($_FILES['imagen']['tmp_name']) {
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($_FILES['imagen']['tmp_name']);
        $image->cover(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    //Validar
    $errores = $propiedad->validar();

    //Revisar que el arreglo de errores este vacio
    if (empty($errores)) {

        //Crear la carpeta para subir imagenes
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }

        //Guardar la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //Guardar en la base de datos
        $resultado = $propiedad->guardar();

        //Mensaje de exito o error
        if ($resultado) {
            //Redireccionar al usuario;

            header('Location: /admin?resultado=1');
        }
    }
}



includeTemplate('header');
?>



<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin/" class="boton boton-verde">Volver</a>


    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
includeTemplate('footer');

?>