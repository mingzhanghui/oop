<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 3:38 PM
 */

header("Content-type: text/html; charset: utf-8");
echo "<title>抽象方法和抽象类</title>";

// 含有抽象方法的类一定是抽象类
// 抽象类不一定含有抽象方法
// 抽象类中可以有普通方法
// 抽象类不能直接实例化， 必须由一个子类去继承它。并把所有父类中的抽象方法都实现(重写)
abstract class person {
	//  定义抽象方法: 修饰词 abstract 方法是没有方法体的
	public abstract function say($name);
	public abstract function run();

	public function eat() {
		echo "eat";
	}
}

class student extends person {
	public function say($name) {
		echo "student {$name} say...";
	}
	public function run() {
		echo "student run..";
	}
}

$student = new student();
$student->say("lisi");
echo "<hr />";
$student->eat();
