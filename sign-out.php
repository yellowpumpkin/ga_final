<?php 
    session_start();
    unset($_SESSION['officer-ga_login']);
    unset($_SESSION['leader_login']);
    unset($_SESSION['admin_login']);
    header('location: index');
?>