<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/9/16
 * Time: 10:09 PM
 */
include_once (__DIR__ . "/config.php");

session_start();
if (!isset($_SESSION['isLogin']) ||  $_SESSION['isLogin'] !== 1) {
  header("Location: {$domain}/users/login.php");
}