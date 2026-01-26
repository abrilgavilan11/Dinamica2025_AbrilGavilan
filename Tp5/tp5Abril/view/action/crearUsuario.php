<?php
include_once '../../configuracion.php';
include_once '../../controller/session.php';
include_once '../../controller/abm-usuario.php';

$session = new Session();
if (!$session->validar()) { header('Location: ../login.php'); exit(); }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../listarUsuario.php'); exit(); }

$datos = data_submitted();
$required = ['usnombre','usmail','uspass','idrol'];
foreach($required as $r){ if(!isset($datos[$r]) || trim($datos[$r])===''){ header('Location: ../listarUsuario.php?mensaje=error'); exit(); }}

$param = [
  'idusuario' => null,
  'idrol' => (int)$datos['idrol'],
  'usnombre' => trim($datos['usnombre']),
  'uspass' => $datos['uspass'],
  'usmail' => trim($datos['usmail']),
  'usdeshabilitado' => 'Habilitado'
];

$abm = new AbmUsuario();
$ok = $abm->alta($param);
header('Location: ../listarUsuario.php?mensaje=' . ($ok ? 'actualizado' : 'error'));
exit();
