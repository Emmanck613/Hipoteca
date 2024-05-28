<?php 

namespace Model;

class Admin extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!$this->email){
            self::$errores[] = "El email es obligatorio";
        }
        if(!$this->password){
            self::$errores[] = 'El passoword es obligatorio';
        }

        return self::$errores;
    }

    public function existeUsuario(){
        //ya existe una instancia de usuario
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = 'El usuario no existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object(); //nos va traer el res de lo que encontre en la bd
        
       $autenticado = password_verify($this->password, $usuario->password);
    //si no esta auth... 
       if(!$autenticado){
        self::$errores[] = 'El password es incorrecto';
        }

        return $autenticado;
    }

    public function autenticar(){
        session_start();

        //llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}