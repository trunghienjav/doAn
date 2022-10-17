<?php
session_start();
require 'check_login.php';
$id = $_GET['id'];
unset($_SESSION['cart'][$id]);

if(isset($_SESSION['cart'])){
    header('location:view_cart.php');
    exit;
}else{
    header('location:index.php');
}