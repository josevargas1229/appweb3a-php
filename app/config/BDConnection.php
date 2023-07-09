<?php
    class BDConnection{
        //crear la instancia de conexión (un atributo para manipular la conexión)
        private $connection;

        //creamos el constructor de la clase conexión, en este método conectamos con la DB
        public function __construct(){
            //llamamos al archivo configuracion
            require_once('app/config/config.php');
            //creamos nuestra conexión a la base de datos
            $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            //manejo de errores 
            if($this->connection->connect_error){
                die('Error al conectar con la base de datos: '.$this->connection->connect_error);
            }
        }
        
    //método para llamar a la conexión
    public function getConnection(){
        return $this->connection;
    }
    
    //métoo para cerrar la conexión
    public function closeConnection(){
        $this->connection->close();
    }
    }
?>