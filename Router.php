<?php 

namespace MVC;

class Router {
    public $rutasGet = [];
    public $rutasPOST = [];

    //Seran todas las urls que reaccionan a un metodo get
    public function get($url, $fn){
        $this->rutasGet[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', 
        '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGet[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth ){
            //si encuentra la ruta, sabremos que es protegida
            header('Location: /'); //si no ha iniciado session va al inicio
        }

        if($fn){
            // La url existe y hay una funcion asociada
            //call_user es una funcion que nos permite llamar una funcion cuando no sabemos su nombre
            call_user_func($fn, $this);
        } else {
            echo 'Pagina no encontrada';
        }
    }

    //Muestra una vista
    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            $$key = $value; //$$ significa variable de variable
            
        }

        ob_start(); //va iniciar un alm. en memoria
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();//limpiamos la memoria
        
        include __DIR__ . "/views/layout.php";

    }
}