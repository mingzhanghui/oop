<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/8/16
 * Time: 9:29 PM
 * 检查用户名是否可用
 */
include_once (__DIR__ . "/../public/pdo.php");

if (!isset($_POST)) {
  die("没有得到$_POST数据");
}

if (isset($_POST['username'])) {
  $username = htmlspecialchars(trim($_POST['username']));
  check_username($username, $pdo);
}

function check_username($username, $pdo) {
  $username = htmlspecialchars(trim($username));
  $len = strlen($username);

  if ($len < 5) {
    echo "<font color='red'>用户名至少5位</font>";
  } else if (16 < $len) {
    echo "<font color='red'>用户名最多16位</font>";
  } else {
    if (!preg_match('/^[A-Za-z][A-Za-z0-9_]{4,15}$/', $username)) {
      echo "<font color='red'>用户名英文字母或数字下划线,不能数字开头</font>";
    } else {
      $sql = "SELECT username FROM users WHERE username=:username";
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array('username'=>$username));
        $row_count = $stmt->rowCount();
        if ($row_count === 0) {
          echo "<font color='green'>用户名可用</font>";
          return true;
        } else if ($row_count == 1) {
          echo "<font color='red'>用户名已存在</font>";
        }
      } catch (PDOException $e) {
        echo "Exception " . $e->getCode() . ": " . $e->getMessage() . "<br />" .
          " in " . $e->getFile() . " on line " . $e->getLine() . "<br />";
      }
    }
  }
  return true;
}

