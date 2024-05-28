<?php 

namespace Model;

class ActiveRecord {
    
    //BD
    //usar statico para tener una sola instancias de bd
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //errores
    protected static $errores = [];

      //Definir la conexion a la bd
      public static function setDB($database){
        self::$db = $database;       
    }

    public function guardar() {
        if(!is_null($this->ID) ) {
            //actualizar
            $this->actualizar();
        } else { //si no existe un id se crea
            //creando un nuevo registro
            $this->crear();
        }
    }

    public function crear() {
        //sanitizar datos

        $atributos = $this->sanitizarDatos();
        //insertar datos mediante join.
        //join nos permite crear un nuevo string a partir de un arreglo
        //va tomar un arreglo y lo convierte a string. 
        //toma 2 paratm. el primero es el separador, en nuestro caso ,space y el segundo el arreglo

        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos) );
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos) );
        $query .= " ') ";

        //bd
        $resultado = self::$db->query($query);
        if($resultado){
            //Rediccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar() {
        //sanitizar datos
        $atributos = $this->sanitizarDatos();
        //el arreglo va unir atributos con valores
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        //vamos a unir nuestro arreglo con join para crear un string que sera nuestra inst.
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores );
        $query .= " WHERE ID = '" . self::$db->escape_string($this->ID) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado){
            //Rediccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }

    //ELIMINAR UN REGISTRO

    public function eliminar() {
          //Eliminar la propiedad
          $query = "DELETE FROM " . static::$tabla . " WHERE ID = " . self::$db->escape_string($this->ID) . " LIMIT 1";
          $resultado = self::$db->query($query);

          if($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }

    }

    //va iterar sobre $columnasDB. Se encarga de identificar y unir los atrb. de la BD
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'ID') continue; //va ignorar ID al no exisitir en el registro
            $atributos[$columna] = $this->$columna; //va mapear el arreglo con los datos de la bd
        }
        return $atributos;
    }

    public function sanitizarDatos() {
        $atributos = $this->atributos(); //mapear las columans con el obejeto en memoria
        $sanitizado = [];
        //vamos a recorrer el arreglo como un arreglo asociativo
        foreach($atributos as $key => $value ){ 
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($IMAGEN){
        //Elimina la imagen previa
        if( !is_null($this->ID) ){
           $this->borrarImagen();
        }

        //asignar al atributo de imagen el nombre de la imagen
        if($IMAGEN){
            $this->IMAGEN = $IMAGEN;
        }
    }

    //ELIMINA ARCHIVO imagen

    public function borrarImagen(){
         //COMPROBAR SI EXISTE ARCHIVO
         $existeArchivo = file_exists(CARPETA_IMAGENES . $this->IMAGEN);
         //si existe el archivo eliminar con unlink
         if($existeArchivo){
             unlink(CARPETA_IMAGENES . $this->IMAGEN);
         }
    }

    //validacion
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = []; 

        return static::$errores;
    }

    //**LISTA TODAS LAS PROPIEDADES */

    public static function all(){ //static va a heredar el metodo y busca el atributo $tabla en la clase donde se herede 
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }   

    //Obtener determinado numero de registros
    public static function get($cantidad){  
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    } 

    //Busca un registro por su ID
    public static function find($ID) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ID = ${ID}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado); //retorna el primer elemento de un arreglo
    }

    public static function consultarSQL($query){
        //consultar bd
        $resultado = self::$db->query($query);
       //iterar sobre los resultados de la bd
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro); //creamos un arreglo de objetos
        }
        //liberar la memoria
        $resultado->free();
        //retonar los resultados
        return $array;
    }
    
    //Va tomar los arreglos de la bd y va crear objetos
    protected static function crearObjeto($registro){
        $objeto = new static; //se refiere a la clase padre, es decir, crea un objeto de la clase actual
        //arreglo asociativo
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)) {//va checar si existe una propiedad
        //toma dos parametros, primero el objeto que vamos comparar
        //vamos a evaluar si el objeto tiene una llave(una propiedad como ID)         
               $objeto ->$key = $value;
            } //el if va ayudar mapear los datos del arreglo a objetos. 
        }
        return $objeto;
    }

    //sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = []){
        foreach($args as $key => $value){ //arreglo asociativo
            if(property_exists($this, $key ) && !is_null($value)){ //si no esta vacio va agregar valores
                $this->$key = $value; //vamos a iterar por las variables
            }
        } 
    }
}