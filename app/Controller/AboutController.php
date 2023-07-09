<?php
    class AboutController{
        private $vista;

        public function index(){
            $vista="app/View/public/IndexAboutView.php";
            include_once("app/View/PlantillaView.php");
        }
    }
?>