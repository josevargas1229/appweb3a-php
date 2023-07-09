<?php
    class ProductsController{
        private $vista;

        public function index(){
            $vista="app/View/admin/products/IndexProductsView.php";
            include_once("app/View/admin/PlantillaView.php");
        }
    }
?>