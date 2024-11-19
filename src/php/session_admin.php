<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['rol'] !== 'admin') {
    // Redirige a una página de error o al login si no tiene acceso
    header('Location: noAccess.php');
    exit;
}
?>