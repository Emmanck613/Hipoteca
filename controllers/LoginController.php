<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(Router $router){

        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $auth = new Admin($_POST); //va crear una nueva isntancia con los valores en post
            
            $errores = $auth->validar();

            if(empty($errores)){
                //verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado){
                    $errores = Admin::getErrores();
                } else {
                //verificar password. //Resultado existe
                $autenticado = $auth->comprobarPassword($resultado);

                if($autenticado){
                    //auth el usuario
                    $auth->autenticar();
                } else {
                    //pass incorrecto
                    $errores = Admin::getErrores();
                }
            }
        }
    }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

}