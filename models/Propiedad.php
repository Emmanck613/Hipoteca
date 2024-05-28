<?php 

namespace Model;

class Propiedad extends ActiveRecord{
    //variables
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['ID', 'TITULO', 
    'PRECIO', 'IMAGEN', 'DESCRIPCION', 'HABITACIONES', 'WC',
    'ESTACIONAMIENTO', 'CREADO', 'VENDEDORES_ID'];

    public $ID;
    public $TITULO;
    public $PRECIO;
    public $IMAGEN;
    public $DESCRIPCION;
    public $HABITACIONES;
    public $WC;
    public $ESTACIONAMIENTO;
    public $CREADO;
    public $VENDEDORES_ID;

    public function __construct($args = [])
    {
        $this->ID = $args['ID'] ?? null;
        $this->TITULO = $args['TITULO'] ?? '';
        $this->PRECIO = $args['PRECIO'] ?? '';
        $this->IMAGEN = $args['IMAGEN'] ?? '';
        $this->DESCRIPCION = $args['DESCRIPCION'] ?? '';
        $this->HABITACIONES = $args['HABITACIONES'] ?? '';
        $this->WC = $args['WC'] ?? '';
        $this->ESTACIONAMIENTO = $args['ESTACIONAMIENTO'] ?? '';
        $this->CREADO = date('Y/m/d');
        $this->VENDEDORES_ID = $args['VENDEDORES_ID'] ?? 1;
    }

    public function validar() {
        
        //validar si esta vacio
        if(!$this->TITULO){
            self::$errores[] = "Debe añadir un titulo";
        }

        if(!$this->PRECIO){
            self::$errores[] = "El precio es obligatorio";
        }

        if(strlen( $this->DESCRIPCION) < 50 ){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$this->HABITACIONES){
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$this->WC){
            self::$errores[] = "El numero de baños es obligatorio";
        }

        if(!$this->ESTACIONAMIENTO){
            self::$errores[] = "El numero de lugares de estacionamiento es obligatorio";
        }

        if(!$this->VENDEDORES_ID){
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->IMAGEN ) {
             self::$errores[] = "La imagen de la propiedad es obligatoria";
        }

        return self::$errores;
    }
}