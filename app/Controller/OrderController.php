<?php

    class OrderController{
        private $vista;
        
        public function index(){
            $vista="app/View/admin/orders/IndexOrderView.php";
            include_once("app/View/PlantillaView.php");
        }
    }
?>