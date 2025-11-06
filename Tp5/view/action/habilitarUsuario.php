<?php
include_once '../../configuracion.php';
include_once '../../controller/session.php';
include_once '../../controller/abm-usuario.php';

$session = new Session();
if (!$session->validar()) {
    header('Location: ../login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../listarUsuario.php');
    exit();
}
$datos = data_submitted();
$abmUsuario = new AbmUsuario();
$resultado = false;
if (isset($datos['idusuario'])) {
    // reutilizamos modificacion para setear a Habilitado
    $resultado = $abmUsuario->modificacion([
        'idusuario' => (int)$datos['idusuario'],
        'usdeshabilitado' => 'Habilitado'
    ]);
}
header('Location: ../listarUsuario.php?mensaje=' . ($resultado ? 'actualizado' : 'error'));
exit();
