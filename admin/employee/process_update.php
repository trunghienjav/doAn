<?php
$id = $_POST['id']; 
$name = $_POST['name'];
$email = $_POST['email'];
$level = $_POST['level'];

require '../connect.php';
$sql = "update admin
set
name = '$name',
email = '$email',
level = '$level'
where id = '$id' ";
mysqli_query($connect,$sql);
mysqli_close($connect);