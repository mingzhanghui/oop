<?php
try {
// 	$dsn 数据库驱动 "mysql:dbname=数据库; host=数据库地址"
	$dsn = "mysql:dbname=classphp; host=127.0.0.1";
// 	$name 数据库用户名
	$name = "root";
// 	$pwd 数据库的密码
	$pwd = "root";
	
// 	实例化PDO对象
// 第一个参数 数据库驱动
// 第二个参数 数据库用户名
// 第三个参数 数据库密码
	$pdo = new PDO($dsn, $name, $pwd);
	
// 	设置错误处理模式 推荐为异常处理模式
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 	设置是否关闭自动提交功能
	$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
//  设置结果集返回的格式
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	
	var_dump($pdo);
}
catch(PDOException $e) {
// 	得到异常的信息
	echo $e->getMessage() . "<br />";
// 	得到异常发生的文件
	echo $e->getFile();
// 	得到异常发生的行
	echo $e->getLine() . "<br />";
// 	得到异常码
	echo $e->getCode();
}
