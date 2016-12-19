<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 9:50 AM
 */
header("Content-type: text/html; charset: utf-8");
echo "<title>克隆对象</title>";

class demo {
	public $name;
	public $age;

	public function __construct($name, $age) {
		$this->name = $name;
		$this->age = $age;
	}
	public function say() {
		echo "<p>say {$this->name}</p>";
	}
	//  __clone() 魔术方法 是在克隆对象时被自动调用
	// 作用: 可以对新对象的成员属性进行赋值
	public function __clone() {
		$this->name = "lisi";
		$this->age = 20;
	}
}

$demo = new demo("zhangsan", 18);
$demo->say();

$demo1 = clone $demo;
echo "<hr />";
$demo1->say();
var_dump($demo1);
