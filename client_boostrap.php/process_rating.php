<?php
session_start();
require '../admin/connect.php';
$product_id = $_POST['id'];
$customer_id = $_SESSION['id'];
$customer_name = $_SESSION['name'];
$comment = $_POST['comment'];
$rating = $_POST['rating'];
if(!isset( $_SESSION['id'])){
	$_SESSION['error'] = "You must login before comment";
	header('location:login.php');
	exit();
}
if(!isset($_SESSION['name']) || !isset($_POST['id']) || !isset( $_POST['comment']) || !isset($_POST['rating'])){
	$_SESSION['error'] = "You must comment and rate the product";
	header("location:product_details.php?id=$product_id");
	exit();
}
$sql = "insert into rating(customer_id, product_id, name, rating, comment)
values('$customer_id','$product_id','$customer_name','$rating','$comment') ";
// die($sql);
mysqli_query($connect,$sql);

mysqli_close($connect);
