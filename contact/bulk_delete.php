<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/14/16
 * Time: 4:20 PM
 */
if (!isset($_POST['ids'])) {
  die('批量删除联系人ID没有设置');
}
header('Content-Type: application/json');
require './public/pdo.php';

// 要删除ID的数组
$ids = json_decode($_POST['ids']);

//$str = array_values($ids);
//$str = "'" . implode("','", $str) . "'";
//echo $sql = sprintf("DELETE FROM `contact` WHERE id in (%s)", $str);

// 拼接'?'sql语句
$str = "";
$n = count($ids);
for ($i = 0; $i < $n; $i++) {
  $str .= "?,";
  $ids[$i] = intval($ids[$i]);
}
$str = rtrim($str, ",");
$sql = sprintf("DELETE FROM `contact` WHERE id in (%s)", $str);

try {
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array_values($ids));
} catch (PDOException $e) {
  $msg = sprintf("Error: @%s(%d)--%s", $e->getFile(), $e->getLine(), $e->getMessage());
  echo json_encode(array('code'=>1, 'msg'=>$msg));
  exit;
}
echo json_encode(array('code'=>0, 'msg'=>'delete success'));