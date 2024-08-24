<?php 


    //Validar id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

  //Importa la conexion
  require 'includes/config/databases.php';
  $db = conectarDB();
  //consultar
  $query = "SELECT * FROM propiedades  WHERE id = {$id} ";

  //obtener el resultado
  $resultado = mysqli_query($db,$query);
  $propiedad = mysqli_fetch_assoc($resultado);

    if(!$resultado -> num_rows){
        header('Location: /');
    }

require 'includes/funciones.php';
includeTemplate('header');
?>
    
    </header>
    

    <main class="contenedor seccion contenido-centrado">
        <h1>
        <?php echo $propiedad['titulo']; ?>
        </h1>

   
            <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad">
       
        <div class="resumen-propiedad">
            <p class="precio">
            <?php echo $propiedad['precio']; ?>
            </p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img  loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>  <?php echo $propiedad['wc']; ?> </p>
                </li>
                <li>
                    <img  loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono_estacionamiento">
                    <p>  <?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img  loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>  <?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p>
            <?php echo $propiedad['descripcion']; ?>
            </p>
        </div>
    </main>
    
<?php
mysqli_close($db);

includeTemplate('footer');

?>