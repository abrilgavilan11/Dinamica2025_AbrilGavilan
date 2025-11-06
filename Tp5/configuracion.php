<?php
///////////////////////
// CONFIGURACION.php //
///////////////////////

// Archivo de configuracion global del proyecto
header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");
session_start();

// Nombre del proyecto (debe coincidir con carpeta real)
$PROYECTO ='tp5Login';

//variable que almacena el directorio del proyecto
$ROOT = dirname(__FILE__).'/';
$_SESSION['ROOT'] = $ROOT;

// Funciones globales
include_once($ROOT.'util/funciones.php');

// Variable que define la pagina de autenticacion del proyecto
$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/view/index.php";

// variable que define la pagina principal del proyecto (menu principal)
$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/index.php";

// Almacena el root en una variable de sesion para ser usada en todo el proyecto
$_SESSION['ROOT']=$ROOT;