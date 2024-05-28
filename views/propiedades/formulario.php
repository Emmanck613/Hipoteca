<fieldset>
                <legend>Informacion General</legend>

                <label for="TITULO">Titulo:</label>
                <input type="text" id="TITULO" name="propiedad[TITULO]" placeholder="Titulo Propiedad" value="<?php echo s( $propiedad->TITULO); ?>">
            
                <label for="PRECIO">Precio:</label>
                <input type="number" id="PRECIO" name="propiedad[PRECIO]" placeholder="Precio Propiedad"  value="<?php echo s( $propiedad->PRECIO); ?>">
            
                <label for="IMAGEN">Imagen:</label>
                <input type="file" id="IMAGEN" accept="image/jpeg, image/png" name="propiedad[IMAGEN]">
            
                <?php if($propiedad->IMAGEN) { ?>
                    <img src="/imagenes/<?php echo $propiedad->IMAGEN ?>" class="imagen-small">
                <?php } ?>    

                <label for="DESCRIPCION">Descripcion:</label>
                <textarea id="DESCRIPCION" name="propiedad[DESCRIPCION]"><?php echo s( $propiedad->DESCRIPCION); ?></textarea>            
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="HABITACIONES">Habitaciones:</label>
                <input 
                type="number" 
                id="HABITACIONES" 
                name="propiedad[HABITACIONES]" 
                placeholder="Ej: 3" 
                min="1" max="9"  
                value="<?php echo s( $propiedad->HABITACIONES); ?>">

                <label for="WC">Baños:</label>
                <input type="number" id="WC" name="propiedad[WC]" placeholder="Ej: 3" min="1" max="9"  value="<?php echo s( $propiedad->WC); ?>">

                <label for="ESTACIONAMIENTO">Estacionamiento:</label>
                <input type="number" id="ESTACIONAMIENTO" name="propiedad[ESTACIONAMIENTO]" placeholder="Ej: 3" min="1" max="9" 
                value="<?php echo s( $propiedad->ESTACIONAMIENTO); ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                            
                <label for="vendedor">Vendedor</label>
                <select name="propiedad[VENDEDORES_ID]" id="vendedor">
                    <option selected value="">-- Seleccione --</option> 
                    <!-- con foreach vamos a iterar sobre cada objeto-->
                    <?php foreach($vendedores as $vendedor ) { ?> 
                        <!--Va hacer que al escoger una opcion si hay un error y se detiene, se mantenga la opcion selecionada--> 
                        <option 
                         <?php echo $propiedad->VENDEDORES_ID === $vendedor->ID ? 'selected' : ''; ?>
                         value="<?php echo s($vendedor->ID); ?>">
                         <?php echo s($vendedor->NOMBRE) . " ". s($vendedor->APELLIDO); ?> </option>                 
                    <?php } ?>
                </select>
            </fieldset>