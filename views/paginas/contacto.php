<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php 
            if($mensaje) { ?>
               <p class="alerta exito"> <?php echo $mensaje; ?></p> 
        <?php } ?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <h2>LLene el formulario de Contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset class="">
                <legend>Informacion Personal</legend>
                
                <label for="NOMBRE">Nombre</label>
                <input type="text" placeholder="Nombre" id="NOMBRE" name="contacto[NOMBRE]" required>
            
                <label for="MENSAJE">Mensaje:</label>
                <textarea id="MENSAJE" name="contacto[MENSAJE]" required></textarea>
           
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>
                
                <label for="opciones">Vende o compra:</label>
                <select id="opciones" name="contacto[TIPO]" required>
                    <option value="" disabled selected>-- Selecione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="PRESUPUESTO">Precio o Presupuesto</label>
                <input type="number" placeholder="Presupuesto" id="PRESUPUESTO" name="contacto[PRECIO]" required>
           
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>
                
                <P>Como desea ser contactado</P>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="TELEFONO" id="contactar-telefono" name="contacto[CONTACTO]" required>
                
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="EMAIL" id="contactar-email" name="contacto[CONTACTO]" required>
                </div>

                <div id="contacto">

                </div>

            
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>

    </main>