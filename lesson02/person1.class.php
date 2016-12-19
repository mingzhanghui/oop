<?php
class person {
	public $name;
	public $age;
	public $sex;

	/* *
	 * 构造方法 __construct() 是在实例化对象时被自动调用
	* 用途: 可以用于初始化程序(可以给成员属性赋值，也可以调用成员方法)
	* 语法 [修饰符] function __construct(参数列表...) {初始化流程}
	*/
	public function __construct($n, $a, $s = '男') {
		$this->name = $n;
		$this->age = $a;
		$this->sex = $s;

		$this->say();
	}

	public function say() {
		echo "<p>我的名字是: {$this->name}, 我的年龄是: {$this->age}, 我的性别是: {$this->sex}</p>";
	}
}

header("Content-type: text/html; charset=utf-8");
echo "<title>构造方法示例</title>";

/* 实例化对象时要按构造方法的参数去传对应的值 */
$person1 = new person("张三", 18);
/* echo $person1->name;
 * echo "<br />";
* echo $person1->age;
* echo "<br />";
* echo $person1->sex;
* echo "<br />";*/
$person1->say();
echo "<hr />";

$person2 = new person("李四", 30, "女");
echo $person2->name;
echo "<br />";
echo $person2->age;
echo "<br />";
echo $person2->sex;
echo "<br />";
echo $person2->say();
echo "<hr />";

$person3 = new person("王五", 20, "男");
echo $person3->name . "<br />";
echo $person3->age . "<br />";
echo $person3->sex . "<br />";
echo $person3->say();

?>
