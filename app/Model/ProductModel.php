<?php
    class ProductModel{
        //creamos la instancia para conectar con la base de datos
        private $dbconnection;

        //creamos el constructor para conectar desde ahí con la base de datos
        public function __construct(){
            //llamamos a la clase conexión para vincular el model user con la base de datos
            require_once('app/config/BDConnection.php');
            //creamos la instancia de la conexión a la base de datos en dbconnection
            $this->dbconnection=new BDConnection();
        }

        //vamos a crear todos los métodos que requieran conexión a la base de datos en la instancia product
        public function getAll(){
            //creamos la consulta a ejecutar
            $sql='SELECT * FROM productos';
            //obtenemos la conexión a la base de datos
            $connection=$this->dbconnection->getConnection();
            //ejecutar la consulta
            $result=$connection->query($sql);
            //creamos un arreglo para manipular a result
            $products=array();
            //vamos a descomponer a result desde un ciclo
            while($product=$result->fetch_assoc()){
                $products[]=$product;
            }
            //cerramos la conexión a la base de datos
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "products"
            return $products;
        }
        
        //método para obtener a un producto por su ID
        public function getByID($id){
            //creamos la consulta a ejecutar
            $sql='SELECT * FROM productos WHERE id_producto=$id';
            //obtenemos la conexión a la base de datos
            $connection=$this->dbconnection->getConnection();
            //ejecutar la consulta
            $result=$connection->query($sql);
            //verificamos que traiga datos y los sacamos a una variable
            if($result && $result->num_rows>0){
                $product=$result->fetch_assoc();
            }else{
                $product=false;
            }
            //cerramos la conexión a la base de datos
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "products"
            return $product;
        }

        //método para eliminar un producto
        public function deleteRow($id){
            //paso1: creamos la consulta
            $sql="DELETE FROM productos WHERE id_producto=$id";
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
        //método para editar el precio y las existencias de un producto
        public function updateProduct($id,$productData){
            //paso1: creamos la consulta
            $sql="UPDATE producto SET precio=".$productData['precio'].", existencias=".$productData['existencias']." WHERE id_producto=$id";
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
        //método para insertar un producto
        public function insertProduct($productData){
            //paso1: creamos la consulta
            $sql="INSERT INTO productos (nombre,descripcion,id_tamano,precio,existencias,id_presentacion) VALUES (".$productData['id_producto'].",".$productData['nombre'].",".$productData['descripcion'].",".$productData['id_tamano'].",".$productData['precio'].",".$productData['existencias'].",".$productData['id_presentacion'].")";
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