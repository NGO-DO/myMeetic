<?php
session_start();
if (array_key_exists('email', $_SESSION)) {
    session_unset();
    header("Location: /connexion.php");
    exit();
}
?>