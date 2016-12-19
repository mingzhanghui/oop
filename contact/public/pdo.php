<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/8/16
 * Time: 3:03 PM
 */
require_once('config.php');

function connect_db($dsn, $name, $pwd) {
  $pdo = null;
  try {
    $pdo = new PDO($dsn, $name, $pwd);
//  置错误处理的方式为异常处理功能
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  设置结果集返回格式为关联数组
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  catch (PDOException $e) {
    echo "Exception " . $e->getCode() . ": " . $e->getMessage() . "<br />" .
      " in " . $e->getFile() . " on line " . $e->getLine() . "<br />";
  }
  return $pdo;
}

$pdo = connect_db($pdo_dsn, $pdo_username, $pdo_password);