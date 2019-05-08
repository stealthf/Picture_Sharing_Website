<?php
session_start();
$_SESSION["admin"]="1";
header('location:admin.php');
?>