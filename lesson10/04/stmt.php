<?php
include ("pdo.php");

try {
// 	?是占位符
	$sql = "INSERT INTO user(username, pwd, email) VALUE(?,?,?)";
// 	prepare等待语句
	$stmt = $pdo->prepare($sql);

// 	bindParam绑定参数
// 第一个参数:第几个占位符
// 第二个参数：要绑定的变量
// 第三个参数:变量的数据类型(一般不用写)
	/*
	$stmt->bindParam(1, $username);
	$stmt->bindParam(2, $pwd);
	$stmt->bindParam(3, $email);
	
	$username = "user3";
	$pwd = md5(123456);
	$email = "user3@admin.com";
	
	$return = $stmt->execute();
	
	$username = "user4";
	$pwd = md5(123456);
	$email = "user4@admin.com";
	
	$stmt->execute();
	*/
	$pwd = md5(123456);
	// 执行预处理语句 execute()可以用这个方法直接传参不需要使用绑定参数方法
	$stmt->execute(array("user5", $pwd, "user5@admin.com"));
}
catch (PDOException $e) {
	echo $e->getMessage();
}