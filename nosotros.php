<?php 

require 'includes/app.php';


includeTemplate('header');
?>
    
    

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error optio facilis maxime nam distinctio veritatis in culpa doloribus totam dolorem dolor, numquam asperiores molestiae, temporibus ducimus fuga corrupti expedita sint!</p>
            
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique delectus quae, fuga corrupti molestiae debitis nesciunt iusto libero, aut odit, quaerat expedita nam soluta! Repellat veniam repudiandae odio blanditiis itaque.</p>
            </div>

        </div>
    </main>
    
    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam ullam, voluptate quos vitae veniam corrupti rem et quas aut reprehenderit quam accusamus voluptatum, hic sequi. Illum saepe ullam iste assumenda?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam ullam, voluptate quos vitae veniam corrupti rem et quas aut reprehenderit quam accusamus voluptatum, hic sequi. Illum saepe ullam iste assumenda?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam ullam, voluptate quos vitae veniam corrupti rem et quas aut reprehenderit quam accusamus voluptatum, hic sequi. Illum saepe ullam iste assumenda?</p>
            </div>
        </div>
    </section>
    <?php
includeTemplate('footer');

?>