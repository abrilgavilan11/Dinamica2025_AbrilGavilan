<?php 
    function data_submitted() {
        $_AAux = array();
        if (!empty($_POST)) {
            $_AAux = $_POST;
        } else if (!empty($_GET)) {
            $_AAux = $_GET;
        }

        if (count($_AAux)) {
            foreach ($_AAux as $indice => $valor) {
                if ($valor == "") {
                    $_AAux[$indice] = 'null';
                }
            }
        }
        return $_AAux;
    }

    function verEstructura($e) {
        echo "<pre>";
        print_r($e);
        echo "</pre>"; 
    }

    // Modifique la funcion __autoload() ya que me aparece como obsoleta y no es compatible con mi version de php
    spl_autoload_register(function ($class_name) {
        $directories = array(
            $_SESSION['ROOT'].'model/',
            $_SESSION['ROOT'].'model/conector/',
            $_SESSION['ROOT'].'controller/',
        );

        foreach ($directories as $directory) {
            $file = $directory . $class_name . '.php';
            if (file_exists($file)) {
                require_once($file);
                return;
            }
        }
    });
?>
