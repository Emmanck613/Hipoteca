<?php 

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['ID', 'NOMBRE', 'APELLIDO', 'TELEFONO'];

    public $ID;
    public $NOMBRE;
    public $APELLIDO;
    public $TELEFONO;

    public function __construct($args = [])
    {
        $this->ID = $args['ID'] ?? null;
        $this->NOMBRE = $args['NOMBRE'] ?? '';
        $this->APELLIDO = $args['APELLIDO'] ?? '';
        $this->TELEFONO = $args['TELEFONO'] ?? '';
    }

    public function validar() {
        
        //validar si esta vacio
        if(!$this->NOMBRE){
            self::$errores[] = "El nombre es obligatorio";
        }

        if(!$this->APELLIDO){
            self::$errores[] = "El apellido es obligatorio";
        }

        if(!$this->TELEFONO){
            self::$errores[] = "El telefono es obligatorio";
        }

        if(!preg_match('/[0-9]{10}/', $this->TELEFONO)){
            //una expresion regular es una forma de buscar un patron dentro de un texto
            //en este caso comparamos que solo tenga num del 0-9 y sea 10 digitos
            self::$errores[] = 'Formato incorrecto';
        }

        return self::$errores;
    }
}