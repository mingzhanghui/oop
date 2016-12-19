<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/8/16
 * Time: 4:43 PM
 */
header("Content-Type: text/html; charset=utf-8");

include '../public/pdo.php';

session_start();

if (isset($_POST['username'], $_POST['pwd'])) {
  // 返回给login.js的结果集
  $result = array();

  if ($_POST['username'] == '') {
    $result['status'] = 3;
    $result['msg'] = "<font color='red'>用户名没有输入</font>";
  } else if ($_POST['pwd'] == '') {
    $result['status'] = 4;
    $result['msg'] = "<font color='red'>密码没有输入</font>";
  } else {
    $username = htmlspecialchars(trim($_POST['username']));
    $pwd = md5($_POST['pwd']);

    $sql = "select id, pwd from users where username=?";
    try {
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $username);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    if ($stmt->rowCount() == 1) {
      if (strcmp($row['pwd'], $pwd) === 0) {
        // 用户ID, 用户名存入session
        $_SESSION['user'] = array('id'=>$row['id'], 'username'=>$username);
        $_SESSION['isLogin'] = 1;

        $result['status'] = 0;
        $result['msg'] = "登录成功";
      } else {
        $result['status'] = 2;
        $result['msg'] = "<font color='red'>密码错误</font>";
      }
    } else {
      $result['status'] = 1;
      $result['msg'] = "<font color='red'>用户名不存在</font>";
    }
  }

  echo json_encode($result);
}