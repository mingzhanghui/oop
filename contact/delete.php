<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/10/16
 * Time: 7:36 PM
 */
header("Content-Type: text/html; charset=utf-8");

if (!isset($_GET['id'])) {
  die('通信录条目ID没有设置');
}
session_start();
// 当前登录用户ID
$loginUID =  $_SESSION['user']['id'];

require 'public/pdo.php';
try {
// 查询创建这个联系人记录的用户ID
  $sql = "SELECT uid FROM contact WHERE id=?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $_GET['id']);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($loginUID != $row['uid']) {
      die("不能删除其他用户创建的联系人");
    }
  } else {
    die("没有这条记录,不能删除");
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}

try {
//  删除单条联系人记录
  $sql = "DELETE FROM contact WHERE id=?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $_GET['id']);
  $stmt->execute();
  if ($stmt->rowCount() == 1) {
    echo "<script>location.href='index.php'</script>";
  } else {
    echo "Unexpected ".$stmt->rowCount()." rows affected...";
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}