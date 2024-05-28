<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <!--Iterar por cada error presente en el arreglo errores-->
        <?php foreach($errores as $error): ?>
           <div class="alerta error">
                <?php echo $error; ?>
           </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" action="/login">
        <fieldset>
                <legend>Email y Password</legend>
                
                <label for="email">E-mail</label>
                <input name="email" type="email" placeholder="E-mail" id="email" required>
           
                <label for="password">Password</label>
                <input name="password" type="password" placeholder="Password" id="password" required>
           
            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>