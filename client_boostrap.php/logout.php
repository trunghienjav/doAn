
<?php
session_start();
require 'check_login.php';
unset($_SESSION['id']);
unset($_SESSION['name']);
setcookie('remember',null,-1);;// cũng giống như setcookie bên login, set -1 là hsd của cookie, nó là thời gian trong quá khứ nên coi như là xóa đi cái cookie
header('location:index.php');