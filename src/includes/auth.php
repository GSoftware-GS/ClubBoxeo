<?php
session_start();

// Redirige si no hay sesión activa
if (!isset($_SESSION['loggedin'])) {
    header("Location: ./noAccess.php");
    exit();
}
?>