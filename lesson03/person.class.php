<?php
class person {
	public $name = "zhangsan";    /* 公有的 */
	private $age = 18;    /* 私有的 */
	protected $sex = '男';   /* 受保护的 */
	// var $height;    /* 如果不确定使用哪种封装，就先用var来修饰 */

	/* 私有的成员方法 不能在类的外部直接访问 */
	private function getName() {
		return $this->name;
	}
	/* 受保护的成员方法 不能在类的外部直接访问 */
	protected function getAge() {
		return $this->age;
	}
	/* 公有的成员方法 可以在类的外部直接访问 */
	public function getSex() {
		return $this->sex;
	}
	/* 私有的，公有的，受保护的成员方法都可以在类的内部直接访问 */
	public function say() {
		return $this->getName() . $this->getAge() . $this->getSex();
	}
}

header("Content-type:text/html; charset:utf-8");
echo "<title>设置私有成员与私有成员的访问</title>";

$person = new person();
echo $person->name;      /* 公有的是可以在类的外部直接访问 */
/* echo "<hr />";*/
/* echo $person->age;*/    /* 私有的是不能在类的外部直接访问 */
echo "<hr />";
// echo $person->sex;     /* 受保护的也是不能在类的外部直接访问 */
// $person->getName();
// echo $person->getAge();
// echo $person->getSex();
echo $person->say();

?>
