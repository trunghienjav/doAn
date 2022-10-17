<?php
require '../admin/connect.php';
$id = $_GET['id'];
if(empty($_GET['id'])){
	header('location:index.php');
	exit();
}
$sql = "delete from rating
where id = '$id' ";
mysqli_query($connect,$sql);
echo 1;
mysqli_close($connect);