<?php

/* 类的声明: 关键字 public 类名{} */
class person {
	/* 成员属性 修饰符 $成员属性名 是可以给默认值 */
	public $name;
	public $age;
	public $sex = '男';

	/* [修饰符] function 成员方法名(参数列表) { 方法体 } */
	public funciton say($n) {
		echo "{$n}正在说话";
	}
	public function run() {
		echo "正在走路";
	}
	public function eat() {
		echo "正在吃饭";
	}
}

?>
