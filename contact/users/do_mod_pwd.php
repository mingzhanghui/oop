<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/16/16
 * Time: 8:27 AM
 */
session_start();
$uid = $_SESSION['user']['id'];

if (isset($_POST['oldpwd'], $_POST['pwd'], $_POST['repwd'])) {
  require '../public/pdo.php';

  foreach ($_POST as $key=>$value) {
    if (strlen($value) < 5) {
      die("密码长度至少为５");
    }
  }
  if ($_POST['pwd'] != $_POST['repwd']) {
    die("两次密码输入不一致");
  }
  $sql = "SELECT pwd FROM users WHERE id=?";
  $dbpwd = '';
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid);
    $stmt->execute();
    $stmt->bindColumn(1, $dbpwd);
    $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }

  if ($dbpwd !== md5($_POST['oldpwd'])) {
    die("原密码错误");
  }
  if ($dbpwd == md5($_POST['pwd'])) {
    die("密码和上次相同");
  }

  $sql = "UPDATE users SET pwd=? WHERE id=?";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, md5($_POST['pwd']));
    $stmt->bindParam(2, $uid);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
  echo "<script>alert('密码修改成功');";
  echo "location.href='" . $_COOKIE['domain'] . "';";
  echo "</script>";
}