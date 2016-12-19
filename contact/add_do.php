<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/13/16
 * Time: 1:56 PM
 */
header('Content-Type: application/json');

if (isset($_POST['uid'], $_POST['name'], $_POST['email'], $_POST['tel'])) {
  require ('./public/pdo.php');

  $contact = array_filter($_POST);

  $fields = $values = '';
  foreach ($contact as $key=>$value) {
    $fields .= $key . ',';
    $value = addslashes($value);
    $values .= '?,';
  }

  $fields = rtrim($fields, ',');
  $values = rtrim($values, ',');
  $sql = sprintf("INSERT INTO `contact`(%s) VALUES(%s)", $fields, $values);

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_values($contact));
    $code = 0;
    $msg = "success";
  } catch (PDOException $e) {
    $code = 1;
    $msg = "添加联系人错误[" . $e->getCode() . "] 发生错误文件" . $e->getFile() .
      "(" . $e->getLine() . ") sql:" . $sql . "\n" . $e->getMessage() . var_dump($contact);
  }
  echo json_encode(array('code'=>$code, 'msg'=>$msg));
}