<?php
    //definimos la clase default controller que será la que se invoque al abrir la página en un inicio
    class DefaultController{
        private $vista;
        //definimos el método index que es el método que se va a invocar cuando entremos a la página principal
        public function index(){
            $vista="app/View/admin/HomeView.php";
            //inicio sesion
            session_start();
            if(isset($_SESSION['logedin'])&&$_SESSION['logedin']==true){
            //inicializamos el atributo vista que contendrá la ruta de la pantalla a mostrar dentro de nuestra plantilla
            
            //incluimos al archivo de la plantilla para que éste sea llamado y lleve como variable a vista
            include_once("app/View/admin/PlantillaView.php");
            }else{
                include_once("app/View/admin/Plantilla2View.php");
            }

        }
    }
?>