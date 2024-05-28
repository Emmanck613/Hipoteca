<main class="contenedor seccion contenido-centrado">
        <h1> <?php echo $propiedad->TITULO; ?> </h1>
        
        <img loading="lazy" src="/imagenes/<?php echo $propiedad->IMAGEN; ?>" alt="imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad->PRECIO; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->WC; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono_estacionamiento">
                    <p><?php echo $propiedad->ESTACIONAMIENTO; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad->HABITACIONES; ?></p>
                </li>
            </ul>

            <?php echo $propiedad->DESCRIPCION; ?>
            
        </div>
    </main>