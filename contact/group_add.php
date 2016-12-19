<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/15/16
 * Time: 4:19 PM
 */
header("Content-Type: text/html; charset:utf-8");

if (isset($_POST['name'], $_POST['uid'])) {
  require 'public/pdo.php';

  if (!get_magic_quotes_gpc()) {
    $name = addslashes($_POST['name']);
    $uid = addslashes($_POST['uid']);
  }
  // 返回json
  $data = array();
  // 插入数据库成功， 获取自增ID为$id
  $id = 0;

  $sql = "INSERT INTO grp(name, uid) VALUES(?, ?)";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $uid);
    $stmt->execute();
    $id = $pdo->lastInsertId();
  } catch (PDOException $e) {
    $data['code'] = 1;
    $data['msg'] = $e->getMessage();
  }

  if (0 != $id) {
    $data['code'] = 0;
    $data['msg'] = "success";
    $data['id'] = $id;
    echo json_encode($data);
  }
  $stmt->closeCursor();
}