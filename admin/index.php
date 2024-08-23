<?php
    //Importa la conexion
    require '../includes/config/databases.php';
    $db = conectarDB();

    //Escribir el query
    $query = "SELECT * FROM propiedades";

    //Consutlar a la base de datos
    $resultadoConsulta = mysqli_query($db, $query);

//Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

//Incluye template
require '../includes/funciones.php';
includeTemplate('header');
?>



<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Propiedad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--Mostrar Resultados-->
            <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $propiedad['id']; ?></td>
                <td><?php echo $propiedad['titulo']; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla" alt="Imagen de la propiedad"></td>
                <td><?php echo $propiedad['precio']; ?></td>
                <td>
                    <a href="#" class="boton-rojo-block">Eliminar</a>
                    <a href="#" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>

</main>

<?php
//Cerrar la conexion
mysqli_close($db);

includeTemplate('footer');

?>