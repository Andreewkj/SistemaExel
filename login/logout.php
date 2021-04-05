<?php
    session_start();
    unset($_SESSION['logado']);
    unset($_SESSION['nome']);
    unset($_SESSION['id']);
    unset($_SESSION['senha']);

    header("Location: login.php");

?>