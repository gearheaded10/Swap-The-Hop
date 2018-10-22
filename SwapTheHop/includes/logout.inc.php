<?php

if (isset($_POST['logoutButton'])){
    echo 'hey';
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}