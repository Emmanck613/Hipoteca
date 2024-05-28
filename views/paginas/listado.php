<div class="contenedor-anuncios">
    <!-- iterar sobre la bd -->        
    <?php foreach($propiedades as $propiedad ) { ?>
        <div class="anuncio">
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->IMAGEN; ?>" >

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->TITULO; ?> </h3>
                <P><?php echo $propiedad->DESCRIPCION; ?> </P>
                <p class="precio"><?php echo $propiedad->PRECIO; ?> </p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $propiedad->WC; ?> </p>
                    </li>

                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono_estacionamiento">
                        <p><?php echo $propiedad->ESTACIONAMIENTO; ?> </p>
                    </li>

                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                        <p><?php echo $propiedad->HABITACIONES; ?> </p>
                    </li>
                </ul>

                <a href="/propiedad?id=<?php echo $propiedad->ID; ?>" class="boton boton-amarillo-block">
                    Ver propiedad
                </a>
            </div> <!--cont anuncios-->
        </div><!--anuncios-->
        <?php }; ?>
    </div> <!--.contenedor anuncios-->
