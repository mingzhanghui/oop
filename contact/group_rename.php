<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/16/16
 * Time: 3:05 PM
 */
header("Content-Type: text/plain; charset=utf-8");

if (isset($_POST['id'], $_POST['name'])) {
  require './public/pdo.php';

  $id = intval($_POST['id']);
  $name = $_POST['name'];

  $code = -1;
  $msg = 'failed';

  $sql = "UPDATE grp SET name=:name WHERE id=:id";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
      $code = 0;
      $msg = 'success';
    } else {
      $code = 2;
      $msg = '0 row affected';
    }
  } catch (PDOException $e) {
    $code = 1;
    $msg = $e->getMessage();
  }
  echo json_encode(array('code'=>$code, 'msg'=>$msg));
}