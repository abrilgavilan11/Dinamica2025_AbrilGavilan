<?php
include_once 'dialog.php';
class Bot
{

    private $intMax;

    public function __construct()
    {

        $this->intMax = 3;
        if (!isset($_SESSION['estado'])) {
            $this->reinicio();
        }

    }

    public function iniciar()
    {

        $_SESSION['estado'] = "adivinando";
        $_SESSION['intento'] = 0;
        $_SESSION['descuento'] = false;
        $texto = "¿Qué corre y no tiene patas? 🤐";
        return $texto;
    }

    public function verificador($x)
    {
        $strg = "";
        if ($_SESSION['estado'] == "adivinando") {
            
            $_SESSION['intento']++;

            if ($x == 'RespuestaCorrecta') {
                $_SESSION['descuento'] = true;
                $_SESSION['estado'] = "fin";
                $strg = "Correcto!!!";
            }
            else{
                $strg = "Incorrecto, intentalo otra vez.";
            }

            if ($_SESSION['intento'] >= $this->intMax) {

                $strg = "Agotaste tus intentos 😥";
                $_SESSION['estado'] = "fin";
            }
        }
        return $strg;
    }

    public function reinicio(){
        $_SESSION['estado'] = "adivinando";
        $_SESSION['intento'] = 0;
        $_SESSION['descuento'] = false;
    }

    public function verificadorDescuento(){

        return $_SESSION['descuento'];
    }
}