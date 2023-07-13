<?php
include_once('app/Model/UserModel.php');
    class UserController{
        private $vista;
        private $modelo;
        
        public function index(){
            $modelo=new UserModel();
            $datos=$modelo->getAll();
            session_start();
            if(isset($_SESSION['logedin'])&&$_SESSION['logedin']==true){
            //incluimos al archivo de la plantilla para que éste sea llamado y lleve como variable a vista
                $vista="app/View/admin/users/IndexUserView.php";
                include_once("app/View/admin/PlantillaView.php");
            }else{
                $vista="app/View/admin/HomeView.php";
                include_once("app/View/admin/Plantilla2View.php");
            }
        }

        //creamos el metodo para manadar a llamar a la vista de agregar usuario
        public function CallFormAdd(){
            session_start();
            if(isset($_SESSION['logedin'])&&$_SESSION['logedin']==true){
            //incluimos al archivo de la plantilla para que éste sea llamado y lleve como variable a vista
                $vista='app/View/admin/users/AddUserView.php';
                include_once("app/View/admin/PlantillaView.php");
            }else{
                $vista="app/View/admin/HomeView.php";
                include_once("app/View/admin/Plantilla2View.php");
            }
        }

        //creamos el metodo para agregar un usuario
        public function Add(){
            //verificamos si el metodo de envio de datos es POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //almacenamos los datos enviados por el formulario en un arreglo
                    $datos=array(
                        'nombre'=>$_POST['nombre'],
                        'email'=>$_POST['email'],
                        'usuario'=>$_POST['usuario'],
                        'password'=>$_POST['password'],
                        'puesto'=>$_POST['puesto']
                    );
                    //rescatamos la imagen y la procesamos
                    if(isset($_FILES['avatar']) && $_FILES['avatar']['error']===UPLOAD_ERROR_OK){
                        //obtenemos los datos de la imagen que cargamos en el formulario
                        $nombreArchivo=$_FILES['avatar']['name'];
                        $tipoArchivo=$_FILES['avatar']['type'];
                        $tamanoArchivo=$_FILES['avatar']['size'];
                        $rutaTemporal=$_FILES['avatar']['tmp_name'];
                        //validamos tipos de archivos permitidos
                        $extenciones=array('jpg','jpeg','png');
                        $extencion=pathinfo($nombreArchivo,PATHINFO_EXTENSION);
                        if(!in_array($extencion,$extenciones)){
                            echo "El formato de la imagen no es válido";
                            exit;
                        }
                        //definimos el tamaño de la imagen a cargar
                        $tamanomax=3*1024*1024;
                        if($tamanoArchivo>$tamanomax){
                            echo "Ya mejor sube un video o una lona nmms";
                            exit;
                        }
                        //definimos el nombre que va a tener nuestro archivo
                        $nombreArchivo=uniqid('Avatar_').'.'.$extencion;
                        //definimos la ruta destino
                        $rutadestino="app/src/img/avatars/".$nombreArchivo;
                        if(!move_uploaded_file($rutaTemporal,$rutadestino)){
                            echo "Error al momento de cargar la imagen al servidor";
                            exit;
                        }
                        $datos['avatar']=$nombreArchivo;
                    }
                    //llamamos al metodo del modelo que agrega al usuario a la base de datos
                    $modelo=new UserModel();
                    $res=$modelo->insert($datos);
                    //podríamos poner un if que dependiendo de si se insertó o no va a redireccionar a la pantalla de index con los datos actualizados o me regresa al formulario para reintentar
                    //redireccionamos al index de usuarios
                    header("Location:http://localhost/php-appweb/?c=UserController&m=index");
            }
        }

        //Creamos el metodo para llamar a la vista de editar usuario
        public function CallFormEdit(){
            //verificamos que el metodo de envio de datos sea GET
            if($_SERVER['REQUEST_METHOD']=='GET'){
                //obtenemos el id del usuario a editar
                $id=$_GET['id'];
                //llamamos al metodo del modelo que obtiene los datos del usuario a editar
                $modelo=new UserModel();
                $datos=$modelo->getById($id);
                //llamamos a la vista de editar usuario
                
                session_start();
            if(isset($_SESSION['logedin'])&&$_SESSION['logedin']==true){
            //incluimos al archivo de la plantilla para que éste sea llamado y lleve como variable a vista
            $vista='app/View/admin/users/EditUserView.php';
                include_once("app/View/admin/PlantillaView.php");
            }else{
                $vista="app/View/admin/HomeView.php";
                include_once("app/View/admin/Plantilla2View.php");
            }
            }
        }
        //Creamos el metodo para editar un usuario
        public function Edit(){
            //verificamos que el metodo de envio de datos sea POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //almacenamos los datos enviados por el formulario en un arreglo
                $datos=array(
                    'idUsuarios'=>$_POST['idUsuarios'],//agregamos el id del usuario a editar
                    'nombre'=>$_POST['nombre'],
                    'email'=>$_POST['email'],
                    'usuario'=>$_POST['usuario'],
                    'password'=>$_POST['password'],
                    'puesto'=>$_POST['puesto'],
                    'avatar'=>$_POST['ava']
                );
                //rescatamos la imagen y la procesamos
                if(isset($_FILES['avatar']) && $_FILES['avatar']['error']===UPLOAD_ERROR_OK){
                    //obtenemos los datos de la imagen que cargamos en el formulario
                    $nombreArchivo=$_FILES['avatar']['name'];
                    $tipoArchivo=$_FILES['avatar']['type'];
                    $tamanoArchivo=$_FILES['avatar']['size'];
                    $rutaTemporal=$_FILES['avatar']['tmp_name'];
                    //validamos tipos de archivos permitidos
                    $extenciones=array('jpg','jpeg','png');
                    $extencion=pathinfo($nombreArchivo,PATHINFO_EXTENSION);
                    if(!in_array($extencion,$extenciones)){
                        echo "El formato de la imagen no es válido";
                        exit;
                    }
                    //definimos el tamaño de la imagen a cargar
                    $tamanomax=3*1024*1024;
                    if($tamanoArchivo>$tamanomax){
                        echo "Ya mejor sube un video o una lona nmms";
                        exit;
                    }
                    //definimos el nombre que va a tener nuestro archivo
                    $nombreArchivo=uniqid('Avatar_').'.'.$extencion;
                    //definimos la ruta destino
                    $rutadestino="app/src/img/avatars/".$nombreArchivo;
                    if(!move_uploaded_file($rutaTemporal,$rutadestino)){
                        echo "Error al momento de cargar la imagen al servidor";
                        exit;
                    }
                    //borramos la imagen anterior
                    $this->modelo=new UserModel();
                    $anterior=$this->modelo->getById($_POST['idUsuarios']);
                    if(!empty($anterior['avatar'])){
                        unlink('app/src/img/avatars/'.$anterior['avatar']);
                    }
                    $datos['avatar']=$nombreArchivo;
                }else{
                    $datos['avatar']=$_POST['ava'];
                }
                //llamamos al metodo del modelo que actualiza los datos del usuario
                $modelo=new UserModel();
                $modelo->update($datos);
                //redireccionamos al index de usuarios
                header("Location:http://localhost/php-appweb/?c=UserController&m=index");
            }
        }

        //Creamos el metodo para eliminar un usuario de la base de datos, este metodo se llamara una vez que 
        //se haya confirmado la eliminacion del usuario en la vista de index mediante un confirm de javascript
        public function Delete(){
            //verificamos que el metodo de envio de datos sea GET
            if($_SERVER['REQUEST_METHOD']=='GET'){
                //obtenemos el id del usuario a eliminar
                $id=$_GET['id'];
                //creo la instancia para obtener los datos a eliminar
                $this->modelo=new UserModel();
                $anterior=$this->modelo->getById($id);

                //llamamos al metodo del modelo que elimina al usuario de la base de datos
                $modelo=new UserModel();
                $modelo->deleteRow($id);
                if(!empty($anterior['avatar'])){
                    unlink('app/src/img/avatars/'.$anterior['avatar']);
                }                //redireccionamos al index de usuarios
                header("Location:http://localhost/php-appweb/?c=UserController&m=index");
            }
        }

        public function CallFormLogin(){
            
            session_start();
            if(isset($_SESSION['logedin'])&&$_SESSION['logedin']==true){
            //incluimos al archivo de la plantilla para que éste sea llamado y lleve como variable a vista
            $vista="app/View/admin/LoginView.php";
                include_once("app/View/admin/PlantillaView.php");
            }else{
                $vista="app/View/admin/LoginView.php";
                include_once("app/View/admin/Plantilla2View.php");
            }
        }
        public function Login(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $this->modelo=new UserModel();
                $usuario=$this->modelo->getCredentials($_POST['user'],$_POST['password']);
                if($usuario==false){
                    $vista="app/View/admin/LoginView.php";
                    include_once("app/View/admin/Plantilla2View.php");
                }else{
                    session_start();
                    $_SESSION['logedin']=true;
                    $_SESSION['avatar']=$usuario['avatar'];
                    $_SESSION['nombre']=$usuario['nombre'];

                    $vista="app/View/admin/HomeView.php";
                    include_once("app/View/admin/PlantillaView.php");
                }
            }
        }
    }
?>