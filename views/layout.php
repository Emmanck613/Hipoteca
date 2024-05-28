<?php 
    //isset revisa si una variable esta definida
    if(!isset($_SESSION)) {
        session_start();
    }
    
    $auth = $_SESSION['login'] ?? null; //si no existe, es nulo

    if(!isset($inicio)){
        $inicio = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>

    <link rel="stylesheet" href="../build/css/app.css">

</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="logotipo bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsivo">
                </div>

                <div class="derecha">

                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">

                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>   
                    </nav>
                </div>
            </div> <!-- Barra -->
            
            <?php 
                if($inicio){
                    echo "<h1>Venta de Casas y Departamentos de Lujo</h1>";
                }
            ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
</body>
</html>