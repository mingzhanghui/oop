<?php
include ("pdo.php");

try {
	$sql = "INSERT INTO user(username, pwd, email) VALUE(:username,:pwd,:email)";
	$stmt = $pdo->prepare($sql);
	
	/*
	$stmt->bindParam(":username", $username);
	$stmt->bindParam(":pwd", $pwd);
	$stmt->bindParam(":email", $email);
	
	$username = "user6";
	$pwd = md5(123456);
	$email = "user6@admin.com";
	
	$stmt->execute();
	*/
	$pwd = md5(123456);
	$arr = array('username'=>'user7', 'pwd'=>$pwd, 'email'=>'user7@admin.com');
	$stmt->execute($arr);
	
} catch (PDOException $e) {
	echo $e->getMessage();
}