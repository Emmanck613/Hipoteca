<?php 

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {

    public static function crear(Router $router) {
        
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //crear nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);
            $errores = $vendedor->validar();
    
            //No hay errores, guardar
            if(empty($errores)){
                $vendedor->guardar();
            }
        }
    
        $router->render('vendedores/crear',[
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router) {
        $errores = Vendedor::getErrores();
        $ID = validarRedireccionar('/admin');

        //obtener datos de vendedor
        $vendedor = Vendedor::find($ID);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //sincronizar el objeto en memoria con los nuevos objetos escrito por el usuario
            //Asignar valores
            $args = $_POST['vendedor'];
    
            $vendedor->sincronizar($args);
    
            //validacion
            $errores = $vendedor->validar();
            
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar',[
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //validar ID
            $ID = $_POST['id'];
            $ID = filter_var($ID, FILTER_VALIDATE_INT);
        
            if($ID) {
                //valida el tipo a eliminar
                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($ID);
                    $vendedor->eliminar();
                    
                }
            }
        }
    }

}