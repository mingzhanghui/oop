<?php
try {
	$dsn = "mysql:host=127.0.0.1; dbname=classphp";
	$name = "root";
	$pwd = "root";
	$pdo = new PDO($dsn, $name, $pwd);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}