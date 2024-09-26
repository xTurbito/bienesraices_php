<?php

namespace App;

class Propiedad{

    //Base DE DATOS
    protected static $db;
    //Nos permite identificar para  mapear el objeto para la sanitizacion
    protected static $columnasDB = ['id', 'titulo', 'precio','imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    //Errores 
    protected static $errores= [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    //Definir la conexio a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? ''; 
        $this->titulo = $args['titulo'] ?? ''; 
        $this->precio = $args['precio'] ?? ''; 
        $this->imagen = $args['imagen'] ?? ''; 
        $this->descripcion = $args['descripcion'] ?? ''; 
        $this->habitaciones = $args['habitaciones'] ?? ''; 
        $this->wc = $args['wc'] ?? ''; 
        $this->estacionamiento = $args['estacionamiento'] ?? ''; 
        $this->creado = date('Y/m/d'); 
        $this->vendedorId = $args['vendedorId'] ?? 1; 
    }

    public function guardar(){

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

       
        //Insertar en la base de datos
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";
        
        $resultado = self::$db->query($query);

        return $resultado;
    }

    //Identificat y unir los atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        } 

        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }


        //Subida de archivos
        public function setImagen($imagen){
            //Asignar al atributo a la imagen el nombre de la imagen
            if($imagen){
                $this->imagen = $imagen;
            }
        }

        //Validacion
        public static function getErrores() {
            return self::$errores;
        }

        public function validar(){
            if (!$this->titulo) {
               self::$errores[] = "Debes añadir un título";
            }
        
            if (!$this->precio) {
                self::$errores[] = 'El precio es obligatorio';
            }
        
            if (strlen($this->descripcion) < 50) {
                self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
            }
        
            if (!$this->habitaciones) {
                self::$errores[] = 'El número de habitaciones es obligatorio';
            }
        
            if (!$this->wc) {
                self::$errores[] = 'El número de baños es obligatorio';
            }
        
            if (!$this->estacionamiento) {
                self::$errores[] = 'El número de lugares de estacionamiento es obligatorio';
            }
        
            if (!$this->vendedorId) {
                self::$errores[] = 'Elige un vendedor';
            }
        
            // Verificar si el archivo fue subido correctamente
            if(!$this->imagen){
                self::$errores[] = 'La imagen es obligatoria';
            }
        
            return self::$errores;
        }
    
        //Lista todos los registros
        public static function all(){
           $query = "SELECT * FROM propiedades";

         $resultado = self::consultarSQL($query);

         return $resultado;

        }

        //Busca un registro por su id
        public static function find($id){
            $query = "SELECT * FROM propiedades WHERE id = {$id}";

            $resultado = self::consultarSQL($query);

            return $resultado;
        }


        public static function consultarSQL($query){
            //Consultar a la base de datos
            $resultado = self::$db->query($query);

            //Iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = self::crearObjeto($registro);
            }
            //Liberar la memoria
            $resultado->free();


            //Retornar los resultados
            return $array;
        }


        protected static function crearObjeto($registro){
            $objeto = new self;

            foreach($registro as $key => $value){
                if(property_exists( $objeto, $key )){
                    $objeto -> $key = $value;
                }
            }

            return $objeto;
        }
}
