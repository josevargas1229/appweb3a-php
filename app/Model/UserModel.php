<?php
    class UserModel{
        //creamos la instancia para conectar con la base de datos
        private $dbconnection;

        //creamos el constructor para conectar desde ahí con la base de datos
        public function __construct(){
            //llamamos a la clase conexión para vincular el model user con la base de datos
            require_once('app/config/BDConnection.php');
            //creamos la instancia de la conexión a la base de datos en dbconnection
            $this->dbconnection=new BDConnection();
        }

        //vamos a crear todos loss métodos que requieran conexión a la base de datos en la instancia user
        public function getAll(){
            //creamos la consulta a ejecutar
            $sql='SELECT * FROM users';
            //obtenemos la conexión a la base de datos
            $connection=$this->dbconnection->getConnection();
            //ejecutar la consulta
            $result=$connection->query($sql);
            //creamos un arreglo para manipular a result
            $users=array();
            //vamos a descomponer a result desde un ciclo
            while($user=$result->fetch_assoc()){
                $users[]=$user;
            }
            //cerramos la conexión a la base de datos
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "users"
            return $users;
        }
        
        //método para obtener a un usuario por su ID
        public function getByID($id){
            //creamos la consulta a ejecutar
            $sql='SELECT * FROM users WHERE idUsuarios='.$id;
            //obtenemos la conexión a la base de datos
            $connection=$this->dbconnection->getConnection();
            //ejecutar la consulta
            $result=$connection->query($sql);
            //verificamos que traiga datos y los sacamos a una variable
            if($result && $result->num_rows>0){
                $user=$result->fetch_assoc();
            }else{
                $user=false;
            }
            //cerramos la conexión a la base de datos
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "users"
            return $user;
        }

        //método para validar un logueo (usuario y contraseña)
        public function getCredentials($us,$ps){
            //paso1: creamos la consulta
            $sql="SELECT * FROM users WHERE usuario=$us AND password=$ps";
            //paso2: conectamos a la base de datos
            $connection=$this->dbconnection->getConnection();
            //paso3: ejecutamos la consulta
            $result=$connection->query($sql);
            //paso4: preparamos la respuesta
            if($result && $result->num_rows>0){
                $user=$result->fetch_assoc();
            }else{
                $user=false;
            }
            //paso5: cerramos la conexion
            $this->dbconnection->closeConnection();
            //paso6: arrojamos resultados
            return $user;
        }

        //método para eliminar un usuario
        public function deleteRow($id){
            //paso1: creamos la consulta
            $sql="DELETE FROM users WHERE idUsuarios=".$id;
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
        // metodo para insertar un usuario
        public function insert($user){
            //paso1 creamos la consulta
            $sql="INSERT INTO users(nombre, email, usuario, password, puesto,avatar) 
            VALUES('".$user['nombre']."','".$user['email']."','".$user['usuario']."',
            '".$user['password']."','".$user['puesto'].",".$user['avatar']."')";
            //paso 2 conectamos a la base de datos
            $connection =$this->dbconnection->getConnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt){
                $res=true;
            }else{
                $res=false;
            }
            //paso 5 cerramos la coneccion
            $this->dbconnection->closeConnection();
            //paso 6 arrojamos resultados
            return $res;
        }

        //metodo para editar un usuario
        public function update($user){
            //paso1 creamos la consulta
            $sql="UPDATE users SET nombre='".$user['nombre']."', email='".$user['email']."', usuario='".$user['usuario']."', password='".$user['password']."', puesto='".$user['puesto']."', avatar='".$user['avatar']."' WHERE idUsuarios='".$user['idUsuarios'];
            //paso 2 conectamos a la base de datos
            $connection =$this->dbconnection->getConnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt){
                $res=true;
            }else{
                $res=false;
            }
            //paso 5 cerramos la coneccion
            $this->dbconnection->closeConnection();
            //paso 6 arrojamos resultados
            return $res;
        }
    }
?>