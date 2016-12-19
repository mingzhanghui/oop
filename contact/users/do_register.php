<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/8/16
 * Time: 3:36 PM
 */
if (!array_key_exists('check_submit', $_POST)) {
  die('You can\'t see this page without submitting the reigister form.');
}

include '../public/pdo.php';

// 缩短变量名
$username = htmlspecialchars(trim($_POST['username']));
$pwd = $_POST['pwd'];
$repwd = $_POST['repwd'];

//　判断密码并加密
if (strcmp($pwd, $repwd) !== 0) {
  echo "<script>alert('两次密码输入不一致'); location.href='register.php'</script>";
}
$pwd = md5($pwd);

// 检验用户名合法
$isValidUsername = false;

$len = strlen($username);
if ($len < 5 || 16 < $len) {
  echo "<script>alert('用户名长度5到16位'); location.href='register.php'</script>";
} else {
  $sql = "SELECT username FROM users WHERE username=?";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $row_count = $stmt->rowCount();
    if ($row_count === 1) {
      echo "<script>alert('用户名已存在'); location.href='register.php'</script>";
    } else if ($row_count === 0) {
      $isValidUsername = true;
    }
  } catch (PDOException $e) {
    echo "Exception " . $e->getCode() . ": " . $e->getMessage() . "<br />" .
      " in " . $e->getFile() . " on line " . $e->getLine() . "<br />";
  }
}

if ($isValidUsername) {
  try {
    $sql = "INSERT INTO `users`(`username`, `pwd`) VALUE(:username, :pwd)";
    $stmt = $pdo->prepare($sql);

    $arr = array('username'=>$username, 'pwd'=>$pwd);
    $stmt->execute($arr);

    echo "<script>location.href='login.php'</script>";

  } catch (PDOException $e) {
    echo "Exception " . $e->getCode() . ": " . $e->getMessage() . "<br />" .
      " in " . $e->getFile() . " on line " . $e->getLine() . "<br />";
  }
}
