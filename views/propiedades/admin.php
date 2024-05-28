<main class="contenedor seccion">
        <h1>Admin de Bienes Raices </h1>
       
        <?php 
            if($resultado) {
                $mensaje = mostrarNotificacion(intval($resultado) );
                if($mensaje) { ?>
                    <p class="alerta exito"><?php echo s($mensaje) ?></p>
                <?php }  
            }
         ?>
           
        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo(a) Vendedor</a>
        
        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITULOS</th>
                    <th>IMAGEN</th>
                    <th>PRECIO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los  resultados-->
                <!-- codigo para iterar la base de datos -->

                <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->ID; ?></td>
                    <td><?php echo $propiedad->TITULO; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->IMAGEN; ?>" class="imagen-tabla"></td>
                    <td><?php echo $propiedad->PRECIO; ?></td>
                    <td>
                        <form class="w-100" method="POST" action="/propiedades/eliminar">

                            <!--Hidden inputs -->
                            <input type="hidden" name="id" value="<?php echo $propiedad->ID; ?>" >
                            <input type="hidden" name="tipo" value="propiedad" >

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>    

                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->ID; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         
        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TELEFONO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los  resultados-->
                <!-- codigo para iterar la base de datos -->

                <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->ID; ?></td>
                    <td><?php echo $vendedor->NOMBRE . " " . $vendedor->APELLIDO; ?></td>
                    <td><?php echo $vendedor->TELEFONO; ?></td>
                    <td>
                        <form class="w-100" method="POST" action="/vendedores/eliminar">

                            <!--Hidden inputs -->
                            <input type="hidden" name="id" value="<?php echo $vendedor->ID; ?>" >
                            <input type="hidden" name="tipo" value="vendedor" >

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>    

                        <a href="vendedores/actualizar?id=<?php echo $vendedor->ID; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</main>