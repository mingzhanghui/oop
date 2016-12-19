<?php
class person {
	
}

function __autoload($className) {
	$fileName = "./class/{$className}.class.php";
	if (file_exists($fileName)) {
		include($fileName);
	} else {
		die("你使用的类{$className}.class.php不存在");
	}
	echo $className . "<br />";
}

// bool class_exists ( string $class_name [, bool $autoload = true ] )
// class_exists()函数 判断类是否存在
// 第一个参数：要判断类的名
// 第二个参数：(可选)如果设置为true则会去调用__autoload()方法进行类的自动加载
var_dump(class_exists("student", false));
