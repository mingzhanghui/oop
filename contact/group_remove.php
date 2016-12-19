<?php
/**
 * 删除一个分组
 */
header("Content-Type: text/plain; charset=utf-8");

if (isset($_POST['id'])) {
  require './public/pdo.php';

  $id = intval($_POST['id']);

  $code = -1;
  $msg = 'failed';
// 先把contact表要删除分组中的用户的分组ID置为NULL，　即"未分组",
  $sql = "UPDATE contact SET gid=NULL WHERE gid=:id";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
  } catch (PDOException $e) {
    $code = 1;
    $msg = "Executing SQL:" . $sql . "Exception: ". $e->getMessage();
    echo json_encode(array('code'=>$code, 'msg'=>$msg));
    exit;
  }
  // 再删除grp表一条记录, 根据组ID
  $sql = "DELETE FROM grp WHERE id=:id";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
      $code = 0;
      $msg = 'success';
    }
  } catch (PDOException $e) {
    $code = 1;
    $msg = "Executing SQL:" . $sql . "Exception: ". $e->getMessage();
  }
  echo json_encode(array('code'=>$code, 'msg'=>$msg));
}

