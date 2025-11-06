<?php 
function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        return $_AAux;
        
}
function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}

spl_autoload_register(function ($class_name) {
    $directorios = array(
        $_SESSION['ROOT'] . 'model/',
        $_SESSION['ROOT'] . 'model/conector/',
        $_SESSION['ROOT'] . 'controller/',
        $_SESSION['ROOT'] . 'util/');

    foreach ($directorios as $directorio) {
        $archivo = $directorio . $class_name . '.php';
        if (file_exists($archivo)) {
            require_once($archivo);
            return;
        }
    }
});

?>