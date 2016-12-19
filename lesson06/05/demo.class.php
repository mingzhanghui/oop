<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 2:19 PM
 */
header("Content-type: text/html; charset:utf-8");
echo "<title>串行化demo</title>";

class demo {
	public $name;
	public $age;
	public $sex;

	public function __construct($name, $age, $sex) {
		$this->name = $name;
		$this->age = $age;
		$this->sex = $sex;
	}
	//  魔术方法__sleep() 是在串行化对象时被自动调用
	public function __sleep() {
		//    返回一个数组，数组的值就是要串行化的成员属性名
		return array("name", "age", "sex");
	}
	//  魔术方法 __wakeup() 是在反串行化对象被自动调用
	public function __wakeup() {
		//    可以把发生改变的成员属性进行重新赋值操作
		$this->age = $this->age + 1;
	}
}

//$demo = new demo("李四", 20, "男");

// 串行化 可以串行化数组，也可以串行化对象， 串行化对象时只是串行化了成员属性
//$str = serialize($demo);

//$handle = fopen("./data.txt", "w+");
//fwrite($handle, $str);
//fclose($handle);
//var_dump($str);
