<?php
    class OrderModel{
        //creamos la instancia para conectar con la base de datos
        private $dbconnection;

        //creamos el constructor para conectar desde ahí con la base de datos
        public function __construct(){
            //llamamos a la clase conexión para vincular el model user con la base de datos
            require_once('app/config/BDConnection.php');
            //creamos la instancia de la conexión a la base de datos en dbconnection
            $this->dbconnection=new BDConnection();
        }

        //vamos a crear todos loss métodos que requieran conexión a la base de datos en la instancia order
        public function getAll(){
            //creamos la consulta a ejecutar
            $sql='SELECT pedidos.id_pedido,usuarios.nombre AS Usuario, fecha,productos.nombre AS Producto,cantidad,precio_unitario FROM pedidos 
            INNER JOIN detallespedido ON pedidos.id_pedido=detallespedido.id_pedido
            INNER JOIN usuarios ON pedidos.id_usuario=usuarios.id_usuario
            INNER JOIN productos ON productos.id_producto=detallespedido.id_producto';
            //obtenemos la conexión a la base de datos
            $connection=$this->dbconnection->getConnection();
            //ejecutar la consulta
            $result=$connection->query($sql);
            //creamos un arreglo para manipular a result
            $orders=array();
            //vamos a descomponer a result desde un ciclo
            while($order=$result->fetch_assoc()){
                $orders[]=$order;
            }
            //cerramos la conexión a la base de datos
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "users"
            return $orders;
        }
        
        //método para obtener a los pedidos de un usuario por su ID
        public function getByID($id){
            //creamos la consulta a ejecutar
            $sql='SELECT pedidos.id_pedido,usuarios.nombre AS Usuario, fecha,productos.nombre AS Producto,cantidad,precio_unitario FROM pedidos 
            INNER JOIN detallespedido ON pedidos.`id_pedido`=detallespedido.`id_pedido`
            INNER JOIN usuarios ON pedidos.`id_usuario`=usuarios.`id_usuario`
            INNER JOIN productos ON productos.`id_producto`=detallespedido.id_producto
            WHERE id_usuario='.$id;
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

        //método para eliminar un pedido
        public function deleteRow($id){
            //paso1: creamos la consulta
            $sql="DELETE FROM pedidos WHERE id_pedido=".$id;
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
        //método para editar los detalles de un producto en un pedido específico
        public function updateUser($id,$orderData){
            //paso1: creamos la consulta
            $sql="UPDATE detallespedido SET cantidad =".$orderData['cantidad']." WHERE id_pedido =".$orderData['id_pedido']
                ." AND id_producto =" .$orderData['id_producto'];
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
        //método para insertar un pedido
        public function insertOrder($orderData,$orderDetails){
            //paso1: creamos la consulta
            $sql = "INSERT INTO orders (id_usuario, fecha) VALUES (:id_usuario, :fecha)";
    
            // Paso 2: Conectamos a la base de datos
            $connection = $this->dbconnection->getConnection();
    
            // Paso 3: Preparamos la consulta
            $statement = $connection->prepare($sql);
    
            // Paso 4: Enlazamos los valores a los parámetros
            $statement->bindParam(':id_usuario', $orderData['id_usuario']);
            $statement->bindParam(':fecha', $orderData['fecha']);
    
            // Paso 5: Ejecutamos la consulta
            $result = $statement->execute();
    
            // Paso 6: Insertamos los detalles del pedido
            if ($result) {
                $orderID = $connection->lastInsertId();
        
            // Iteramos sobre los detalles del pedido
            foreach ($orderDetails as $detail) {
                $productID = $detail['id_producto'];
                $quantity = $detail['cantidad'];
            
            // Creamos la consulta para insertar el detalle del pedido
            $sql = "INSERT INTO order_details (id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)";
            
            // Preparamos la consulta
            $statement = $connection->prepare($sql);
            
            // Enlazamos los valores a los parámetros
            $statement->bindParam(':id_pedido', $orderID);
            $statement->bindParam(':id_producto', $productID);
            $statement->bindParam(':cantidad', $quantity);
            
            // Ejecutamos la consulta
            $statement->execute();
            }
            //paso5: cerramos la conexion
            $this->dbconnection->closeConnection();
            //paso6: arrojamos resultados
            return $res;
            }
        }
    }
?>