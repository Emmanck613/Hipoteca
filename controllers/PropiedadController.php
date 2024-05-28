<?php 

namespace Controllers;
//controlador se comunica con el modelo.
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router){

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        
        //mostrar mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
       
        //para mantener la misma instancia de una clase, vamos a importar el valor
        $router->render('propiedades/admin', [
            //pasar datos
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo de mensajes de errores
        $errores = Propiedad::getErrores();

        //agregar soporte al metodo post con request

        if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
            //Crear instancia
            $propiedad = new Propiedad($_POST['propiedad']);
        
            //**subir archivos
            //generar nombre unico para imagenes
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                    
            //setear la imagen
            //realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['IMAGEN']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['IMAGEN'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
                }
                    
            //validar
            $errores = $propiedad->validar();
        
            if (empty($errores)){
            //crear carpeta
                if (!is_dir (CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
        
                //Guardar la imagen al servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
        
                //Guarda en la BD
                $propiedad->guardar();
              }
            
        }
        
        $router->render('propiedades/crear', [
            //pasar datos
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $ID = validarRedireccionar('/admin');

        $propiedad = Propiedad::find($ID);

        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        //metodo post para actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //asignar los atributos
            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
            //validacion
            $errores = $propiedad->validar();
    
            //generar nombre unico para imagenes
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                
            //subida de archivos
            if ($_FILES['propiedad']['tmp_name']['IMAGEN']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['IMAGEN'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
    
            //Revisar el arreglo de errores si esta vacio
            if (empty($errores)){
                if ($_FILES['propiedad']['tmp_name']['IMAGEN']){
                     //***ALMACENAR IMAGEN */
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar ID
            $ID = $_POST['id'];
            $ID = filter_var($ID, FILTER_VALIDATE_INT);
            
            if($ID) {
    
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($ID);
                    $propiedad->eliminar();
                } 
            }
        }
    
    }
}