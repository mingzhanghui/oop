<?php
include ("./pdo.php");

try {
// 	第一步：关闭自动提交
	$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
// 	第二步：开启事务
	$pdo->beginTransaction();
	
// 	第三步:执行子流程
// 如果子流程有失败则整个事务都失败
// 如果所有的子流程都成功则事务成功
	$sql = "UPDATE cash SET money = money - 50 WHERE username='zhangsan'";
	$affectedRow = $pdo->exec($sql);
	if (!$affectedRow) {
		throw new PDOException("转出失败!");
	}
	$sql = "UPDATE cash set money = money + 50 where username = 'lisi'";
	$affectedRow = $pdo->exec($sql);
	if (!$affectedRow) {
		throw new PDOException("转入失败");
	}
// 	事务成功:提交事务
	$pdo->commit();
	echo "汇款成功";
} catch (PDOException $e) {
	echo $e->getMessage();
// 	事务失败: 回滚事务
	$pdo->rollback();
}

// 开启自动提交
$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
