<?php 

//Base de datods
require '../../includes/config/databases.php';

$db = conectarDB();


//Consulta para vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db , $consulta);

//Arreglo con mensajes de erores
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';


//Ejecutar el codigo despues que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    

   

    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    //Asignar files hacia una variable
    $imagen = $_FILES['imagen'];


    if(!$titulo){
        $errores[] = "Debes añadir un titulo";
    }

    if(!$precio){
        $errores[] = 'El precio es obligatorio';
    }
    
    if(strlen($descripcion) < 50 ){
        $errores[] = 'La descripcion es obligatoria y debe tener al menos 50 caracteres';
    }

    if(!$habitaciones){
        $errores[] = 'El Número de habitaciones es obligario';
    }

    if(!$wc){
        $errores[] = 'El Número de baños es obligario';
    }

    if(!$estacionamiento){
        $errores[] = 'El Número de lugares de Estacionamiento es obligario';
    }

    if(!$vendedorId){
        $errores[] = 'Elige un vendedor';
    }

    if(!$imagen['imagen'] || $imagen['error']){
        $erroes = 'La Imagen es obligatoria';
    }
    
    

    //Validar por tamaño (100kb máximo);
    $medida = 1000 * 100;

    if($imagen['size'] > $medida){
        $errores[] = 'La Imagen es muy pesada';
    }

    //echo "<pre>";
   // var_dump($errores);
    //echo "</pre>";


    //Revisar que el arreglo de errores este vacio
    if(empty($errores)){
    //Insertar en la base de datos
    $query = "INSERT INTO propiedades (titulo,precio,descripcion,habitaciones,wc,estacionamiento,creado, vendedorId) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado' , '$vendedorId' )";

    //echo $query;

    $resultado = mysqli_query($db, $query);

    if($resultado){
       //Redireccionar al usuario;

         header('Location: /admin');
     }
   
    }

 
}


require '../../includes/funciones.php';
includeTemplate('header');
?>
    
    

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin/" class="boton boton-verde">Volver</a>


        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                 <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">

            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="titulo" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?> ">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagn" name="imagen" accept="image/jpeg">

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

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>
    
    <?php
includeTemplate('footer');

?>