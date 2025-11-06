<?php
// Start output buffering to prevent header issues
ob_start();

include_once(__DIR__ . '/../../configuracion.php');
include_once(__DIR__ . '/../../controller/session.php');

// Initialize session
$session = new Session();

// Close the session
$session->cerrar();

// Clear output buffer and send headers
ob_end_clean();

// Redirect to login
header('Location: ../login.php');
exit();
?>