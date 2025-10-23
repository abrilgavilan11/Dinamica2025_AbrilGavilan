<?php
include_once '../control/ia/funciones/dialog.php';
include_once '../control/ia/funciones/bot.php';
$ia = new Dialog();
$obj = new Bot();
if (!isset($_SESSION['historial'])) {
    $_SESSION['historial'] = [];
    //Bandera para que no se repita el codigo
    $_SESSION['iniciador'] = false;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensajeIA = end($_SESSION['historial'])['bot'];
    
    if (isset($_POST['mensaje']) && $mensajeIA != "Agotaste tus intentos 😥" && $mensajeIA != "Correcto!!!"){
        $mensaje = $_POST['mensaje'];

        $iaMensaje = $ia->empezar($mensaje);
        $respuesta = $obj->verificador($iaMensaje);
        $_SESSION['historial'][] = ['usuario' => $mensaje, 'bot' => $respuesta];
    }
        

} else {
    $respuesta = $obj->iniciar();
    $_SESSION['historial'][] = ['usuario' => '', 'bot' => $respuesta];

}

//seccion de la interfaz del chat

if (isset($_SESSION['historial'])) {

            for ($i = 0; $i < count($_SESSION['historial']); $i++) {

                if ($_SESSION['historial'][$i]['usuario'] != ""){

                    echo "<div class='alert alert-success'><strong>Vos:</strong> " . $_SESSION['historial'][$i]["usuario"] . "</div>";
                }
                if ($_SESSION['historial'][$i]['bot'] != ""){

                    echo "<div class='alert alert-primary'><strong>Bot:</strong> " . $_SESSION['historial'][$i]["bot"] . " </div>";
                }
            }
        }

?>