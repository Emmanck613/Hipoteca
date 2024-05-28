<fieldset>
    <legend>Informacion General</legend>

    <label for="NOMBRE">Nombre:</label>
    <input type="text" id="NOMBRE" name="vendedor[NOMBRE]" placeholder="Nombre Vendedor(a)" 
    value="<?php echo s( $vendedor->NOMBRE); ?>">
    
    <label for="APELLIDO">Apellido:</label>
    <input type="text" id="APELLIDO" name="vendedor[APELLIDO]" placeholder="Apellido Vendedor(a)" 
    value="<?php echo s( $vendedor->APELLIDO); ?>">
     
</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>
    
    <label for="TELEFONO">Telefono:</label>
    <input type="text" id="TELEFONO" name="vendedor[TELEFONO]" placeholder="Telefono Vendedor(a)" 
    value="<?php echo s( $vendedor->TELEFONO); ?>">  

</fieldset>