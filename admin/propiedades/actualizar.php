<?php 

require '../../includes/app.php';
estaAutenticado();

//Validar id valido
$id = $_GET['id'];
$id  = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}


//Obtener los datos de la propiedad

$resultado =    mysqli_query($db,$consulta);
$propiedad = mysqli_fetch_assoc($resultado);


// Consulta para vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Arreglo con mensajes de errores
$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedorId'];
$imagenPropiedad = $propiedad['imagen'];

// Ejecutar el código después de que el usuario envíe el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    // Asignar archivos hacia una variable
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }

    if (!$precio) {
        $errores[] = 'El precio es obligatorio';
    }

    if (strlen($descripcion) < 50) {
        $errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
    }

    if (!$habitaciones) {
        $errores[] = 'El número de habitaciones es obligatorio';
    }

    if (!$wc) {
        $errores[] = 'El número de baños es obligatorio';
    }

    if (!$estacionamiento) {
        $errores[] = 'El número de lugares de estacionamiento es obligatorio';
    }

    if (!$vendedorId) {
        $errores[] = 'Elige un vendedor';
    }

    //Validar por tamaño (100kb máximo);
    $medida = 1000 * 1000;

    if($imagen['size'] > $medida){
        $errores[] = 'La Imagen es muy pesada';
    }  
    

    //echo "<pre>";
   // var_dump($errores);
    //echo "</pre>";


    //Revisar que el arreglo de errores este vacio
    if(empty($errores)){


    //Crear carpeta
    $carpetaImagenes = '../../imagenes/';

    if(!is_dir($carpetaImagenes)){
        mkdir($carpetaImagenes);
    }

    $nombreImagen = '';
   

    /* SUBIDA DE ARCHIVOS */
    
    if($imagen['name']){
        //Eliminar imagen previa

        unlink($carpetaImagenes . $propiedad['imagen']);
          //Generar un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
    }else {
        $nombreImagen = $propiedad['imagen'];
    }



    //Insertar en la base de datos
    $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = {$precio}, imagen= '{$nombreImagen}' ,descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedorId = {$vendedorId} WHERE id = {$id}";

    // echo $query;

    

    $resultado = mysqli_query($db, $query);

    if($resultado){
       //Redireccionar al usuario;

       header('Location: /admin?resultado=2');
     }
   
    }

 
}



includeTemplate('header');
?>
    
    

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/admin/" class="boton boton-verde">Volver</a>


        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                 <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form  class="formulario" method="POST" enctype="multipart/form-data">

            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="titulo" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagn" name="imagen" accept="image/jpeg">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="" class="imagen-small">

                <label for="descripcion">Descripcion:</label>
                <textarea  id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">


                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="esctacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor" id="vendedor">
                    <option value="">-- Seleccione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado) ) : ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> </option>

                    <?php endwhile ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>
    
    <?php
includeTemplate('footer');

?>