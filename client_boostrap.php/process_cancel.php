<?php
session_start();
require 'check_login.php';

$id = $_GET['id'];
require '../admin/connect.php';
$sql = "update orders set
status = 3
where id = '$id' ";
mysqli_query($connect,$sql);
mysqli_close($connect);