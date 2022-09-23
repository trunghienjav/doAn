<?php
session_start();
require '../check_admin_login.php';
$id = $_GET['id'];
require '../connect.php';
$sql = "delete from products
where id = '$id'";
mysqli_query($connect,$sql);
header('location:index.php');
mysqli_close($connect);