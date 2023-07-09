<?php
    class ClientModel{
        //mantenemos la información de los usuarios como nombre, contraseña y correo del usuario separada de la información adicional de los clientes, como su direccion, telefono, etc.
        //creamos la instancia para conectar con la base de datos
        private $dbconnection;

        //creamos el constructor para conectar desde ahí con la base de datos
        public function __construct(){
            //llamamos a la clase conexión para vincular el model user con la base de datos
            require_once('app/config/BDConnection.php');
            //creamos la instancia de la conexión a la base de datos en dbconnection
            $this->dbconnection=new BDConnection();
        }

        //vamos a crear todos loss métodos que requieran conexión a la base de datos en la instancia client
        public function getAll(){
            //creamos la consulta a ejecutar
            $sql='SELECT * FROM clientes';
            //obtenemos la conexión a la base de datos
            $connection=$this->dbconnection->getConnection();
            //ejecutar la consulta
            $result=$connection->query($sql);
            //creamos un arreglo para manipular a result
            $clients=array();
            //vamos a descomponer a result desde un ciclo
            while($client=$result->fetch_assoc()){
                $clients[]=$client;
            }
            //cerramos la conexión a la base de datos
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "clients"
            return $clients;
        }
        
        //método para obtener a un cliente por su ID
        public function getByID($id){
            //creamos la consulta a ejecutar
            $sql='SELECT * FROM clientes WHERE id_cliente='.$id;
            //obtenemos la conexión a la base de datos
            $connection=$this->dbconnection->getConnection();
            //ejecutar la consulta
            $result=$connection->query($sql);
            //verificamos que traiga datos y los sacamos a una variable
            if($result && $result->num_rows>0){
                $client=$result->fetch_assoc();
            }else{
                $client=false;
            }
            //cerramos la conexión a la base de datos
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "clients"
            return $client;
        }

        //método para eliminar un cliente
        public function deleteRow($id){
            //paso1: creamos la consulta
            $sql="DELETE FROM cliente WHERE id_cliente=".$id;
            //paso2: conectamos a la base de datos
            $connection=$this->dbconnection->getConnection();
            //paso3: ejecutamos la consulta
            $result=$connection->query($sql);
            //paso4: preparamos la respuesta
            if($result){
                $res=true;
            }else{
                $res=false;
            }
            //paso5: cerramos la conexion
            $this->dbconnection->closeConnection();
            //paso6: arrojamos resultados
            return $res;
        }
        //método para editar un cliente
        public function updateClient($id,$clientData){
            //paso1: creamos la consulta
            $sql="UPDATE clientes SET telefono=".$clientData['telefono'].", calle=".$clientData['calle'].", numero_int=".$clientData['numero_int'].", numero_ext=".$clientData['numero_ext'].", id_colonia=".$clientData['id_colonia'].", idlocalidad=".$clientData['idlocalidad']." WHERE id_usuario=".$id;
            //paso2: conectamos a la base de datos
            $connection=$this->dbconnection->getConnection();
            //paso3: ejecutamos la consulta
            $result=$connection->query($sql);
            //paso4: preparamos la respuesta
            if($result){
                $res=true;
            }else{
                $res=false;
            }
            //paso5: cerramos la conexion
            $this->dbconnection->closeConnection();
            //paso6: arrojamos resultados
            return $res;
        }
        //método para insertar un cliente
        public function insertClient($clientData){
            //paso1: creamos la consulta
            $sql="INSERT INTO clientes (id_cliente, nombre,telefono,correo,calle,numero_int,numero_ext,id_colonia,idlocalidad) VALUES (".$clientData['id_cliente'].",".$clientData['nombre'].",".$clientData['telefono'].",".$clientData['correo'].",".$clientData['calle'].",".$clientData['numero_int'].",".$clientData['numero_ext'].",".$clientData['id_colonia'].",".$clientData['idlocalidad'].")";
            //paso2: conectamos a la base de datos
            $connection=$this->dbconnection->getConnection();
            //paso3: ejecutamos la consulta
            $result=$connection->query($sql);
            //paso4: preparamos la respuesta
            if($result){
                $res=true;
            }else{
                $res=false;
            }
            //paso5: cerramos la conexion
            $this->dbconnection->closeConnection();
            //paso6: arrojamos resultados
            return $res;
        }
    }
?>