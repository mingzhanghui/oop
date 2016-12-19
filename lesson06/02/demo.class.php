<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 9:58 AM
 */
echo "<title>类中调用方法 __toString</title>";

class demo {
	public $name;

	public function __construct($name) {
		$this->name = $name;
	}
	// 魔术方法__toString() 是直接echo或print对象时被自动调用
	// 作用: 可以直接返回字符串或用于调用流程处理
	public function __toString() {
		$this->d();
		$this->e();
		return '';
	}
	private function d() {
		echo "d...";
	}
	private function e() {
		echo "e...";
	}
}

$demo = new demo("zhangsan");
echo $demo;
