<?php
try {
	$dsn = "mysql:dbname=classphp; host=127.0.0.1";
	$name = "root";
	$pwd = "root";
	$pdo = new PDO($dsn, $name, $pwd);
	
// setAttribute()	设置PDO的行为属性
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 	getAttribute() 得到PDO行为属性的值
	// echo $pdo->getAttribute(PDO::ATTR_ERRMODE);
	
	$username = "user1";
	$pwd = md5(123456);
	$email = 'user1@admin.com';
	
	// $sql = "INSERT INTO user(username, pwd, email) VALUE('{$username}', '{$pwd}', '{$email}')";
	// $affected = $pdo->exec($sql);
	// var_dump($affected);
	
// 执行有影响行数的语句
// 有影响行数的语句一般来说多是增删改 就是对表的解构或内容有修改的语句
// 返回影响行数
  // $pdo->exec();
  
	$sql = "SELECT * FROM user";
// query() 执行有结果集的语句
// 多用于执行查询
 	$stmt = $pdo->query($sql);
 	var_dump($stmt);
 	
 	echo "<table>";
 	foreach ($stmt as $v) {
 		echo "<tr>";
 		echo "<td>{$v['id']}</td><td>{$v['username']}</td><td>{$v['pwd']}</td><td>{$v['email']}</td>";
 		echo "</tr>";
 	}
 	echo "</table>";
}
catch (PDOException $e) {
	echo $e->getMessage();
}
