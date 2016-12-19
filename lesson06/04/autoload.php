<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 2:04 PM
 */
header("Content-type: text/html; charset=utf-8");
echo "<title>自动加载类</title>";

// __autoload() 是在实例化对象时, 如果类不存在就自动调用
// 参数： 实例化的类名
// 作用： 可以用于自动引入类文件
function __autoload($className) {
	//  注意：类文件名要有规律
	//       类文件名要与类名统一的部分
	//       类文件的路径要有规律
	$file = $className . ".public.php";
	$path = "./public/" . $file;

	if (file_exists($path)) {
		include ($path);
	} else {
		die("你调用的{$className}.public.php文件不存在");
	}
}

$demo = new demo();
var_dump($demo);

$demo1 = new demo1();
