<?php
    class PresentsController{
        private $vista;

        public function index(){
            $vista="app/View/admin/presents/IndexPresentsView.php";
            include_once("app/View/admin/PlantillaView.php");
        }
    }
?>