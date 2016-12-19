<?php
if (isset($_POST['uids'], $_POST['gid'])) {
  require './public/pdo.php';

  $uids = $_POST['uids'];
  $gid = intval($_POST['gid']);

  $n = count($uids);
  $str = "";
  for ($i = 0; $i < $n; $i++) {
    $str .= "?,";
    $uids[$i] = intval($uids[$i]);
  }
  $str = rtrim($str, ",");

  $sql = sprintf("UPDATE `contact` SET gid=? WHERE id IN (%s)", $str);
  $stmt = null;
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $gid);
    for ($i = 0; $i < $n; $i++) {
      $stmt->bindParam($i+2, $uids[$i]);
    }
    $stmt->execute();
    $code = 0;
    $msg = 'success';
  } catch (PDOException $e) {
    $code = 1;
    $msg = sprintf("Error executing '%s', %s", $sql, $e->getMessage());
  }
  @$stmt->closeCursor();
  echo json_encode(array('code'=>$code, 'msg'=>$msg));
}

?>