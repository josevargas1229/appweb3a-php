<?php

    class OrderController{
        private $vista;
        
        public function index(){
            $vista="app/View/admin/orders/IndexOrderView.php";
            session_start();
            if(isset($_SESSION['logedin'])&&$_SESSION['logedin']==true){
            //incluimos al archivo de la plantilla para que éste sea llamado y lleve como variable a vista
            include_once("app/View/admin/PlantillaView.php");
            }else{
                include_once("app/View/admin/Plantilla2View.php");
            }
        }
    }
?>