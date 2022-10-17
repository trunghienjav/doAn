<?php 
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$level = $_POST['level'];

require '../connect.php';
$sql = "insert into admin(name,email,password,level)
values('$name','$email','$password','$level') ";
mysqli_query($connect,$sql);
mysqli_close($connect);