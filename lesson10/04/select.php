<?php
include ("pdo.php");

try {
	// $sql = "SELECT * FROM user WHERE id>:id";
  // $stmt->execute( array('id'=>$_GET['id']) );

	$sql = "SELECT * FROM user WHERE id>?";
	$stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $_GET['id']);
  $stmt->execute();

// 	fetch　提取一条数据时使用的方法
// 	$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 	fetchAll提取多条数据时使用的方法
//	 $users = $stmt->fetchAll(PDO::FETCH_NUM);   // FETCH_NUM索引数组
//	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);  // FETCH_ASSOC关联数组

// 	可以得到查询时结果集的数量或增删改时影响行数
	echo $stmt->rowCount() . " rows <br />";

// 	把查询的结果集字段绑定到一个变量上
	$stmt->bindColumn(1, $id);
	$stmt->bindColumn(2, $username);
	$stmt->bindColumn('pwd', $pwd);
	$stmt->bindColumn('email', $email);
	
	while ($stmt->fetch(PDO::FETCH_ASSOC)) {
		echo "{$id}-{$username}-{$pwd}-{$email}<br />";
	}
	
} catch (PDOException $e) {
	echo $e->getMessage();
}