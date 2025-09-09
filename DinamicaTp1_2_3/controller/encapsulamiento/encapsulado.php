<?php
    /*
    Su propósito es recoger los datos que el usuario envía a través
    de un formulario web, ya sea por el método POST o GET, y devolverlos
    en una sola variable.
    */
    function encapsuladorDeMetodos(){
        $datos = [];
        if(!empty($_POST)){
            $datos = $_POST;
        }elseif(!empty($_GET)){
            $datos = $_GET;
        }
        return $datos;
    }
?>