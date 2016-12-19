<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 9:31 AM
 */
header("Content-type: text/html; charset:utf-8");
echo "<title>const关键字</title>";

class demo {
	// 常量定义时就要赋初始值
	// 常量一旦定义就不能修改
	// 如果是多个单词组成的常量名要用下划线分隔
	const HOST = '127.0.0.1';
	const DB_NAME = 'jike';

	public function getConst() {
		//    在类的内部访问常量 self::常量名
		return self::DB_NAME;
	}
}

// 在类的外部访问常量 类名::常量名
echo demo::HOST;
echo "<hr />";
$demo = new demo();
echo $demo->getConst();

