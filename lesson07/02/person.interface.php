<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 7:24 PM
 */
header("content-type: text/html; charset:utf-8");
echo "<title>接口技术</title>";

// 接口 声明关键字 interface
// 接口中可以声明常量也可以是声明抽象方法
// 接口中的方法都是抽象方法不需要使用abstract
// 接口不能实例化， 需要用一个类去实现它 (implements)
// 一个类可以实现多个接口 (解决了PHP单继承的问题)
interface learn {
	public function study();
}

interface person {
	const NAME = "lisi";

	public function say();
	public function run();
	public function eat();
}

class student implements person,learn {
	public function say() {
		echo "say...";
	}
	public function run() {
		echo "run...";
	}
	public function eat() {
		echo "eat...";
	}
	public function study() {
		echo "study...";
	}
}

$student = new student();
$student->say();
echo '<hr />';
echo student::NAME;
echo '<hr />';
$student->study();
