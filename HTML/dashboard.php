<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}
echo "Bienvenue sur votre espace sécurisé !";
?>
