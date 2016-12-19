<?php

class person {
	public $name;
	public $age;
	public $sex;

	public function __construct($name, $age, $sex) {
		$this->name = $name;
		$this->age = $age;
		$this->sex = $sex;
	}

	public function say() {
		echo "<p>say</p>";
	}

	/* 析构方法 __destruct() 是在对象被销毁时自动调用 */
	/* 用途: 可以进行资源释放操作或文件的关闭操作或者信息保存操作 */
	/* 注意: 栈内存的先进后出 */
	public function __destruct() {
		echo "88{$this->name}<br />";
	}
}

header("Content-type:text/html; charset=utf-8");
echo "<title>析构方法实例</title>";

$person = new person("张三",18,'女');
$person->say();
echo "<hr />";
$person1 = new person("李四", 20, "男");
$person1->say();

?>
