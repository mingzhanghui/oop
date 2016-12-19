<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/9/16
 * Time: 10:00 PM
 */
session_start();

$_SESSION['user'] = array();
unset($_SESSION['user']);
$_SESSION['isLogin'] = '';
unset($_SESSION['isLogin']);

session_destroy();

echo "<script>location.href='login.php'</script>";
