<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/14/16
 * Time: 8:43 AM
 */
header("Content-Type: text/html; charset=utf-8");

if (isset($_POST['id'], $_POST['name'], $_POST['email'], $_POST['tel'])) {
  require ('./public/pdo.php');

  $contact = array_filter($_POST);
  $id = intval($contact['id']);
  unset($contact['id']);

  $str = '';     // set xxx=xxx, xxx=xxx...
  foreach ($contact as $key=>$value) {
    $value = addslashes($value);
    $str .= sprintf("%s='%s',", $key, $value);
  }
  $str = rtrim($str, ",");

  $sql = "UPDATE `contact` SET ".$str." WHERE id=?";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
  } catch (PDOException $e) {
    $msg = "Error[" . $e->getCode() . "] @edit_do.php(" . $e->getLine() . ") sql:" . $sql .
    ", message: " . $e->getMessage() . var_dump($contact);
    die(json_encode(array('code'=>1, 'msg'=>$msg)));
  }
  echo json_encode(array('code'=>0, 'msg'=>'success'));

  unset($contact);
}