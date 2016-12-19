<?php
header("Content-type:text/html; charset:utf-8");
echo "<title>访问类型的控制</title>";

class person {
	public $name;
	private $age;
	protected $sex;

	public function __construct($name, $age, $sex) {
		$this->name = $name;
		$this->age = $age;
		$this->sex = $sex;
	}
	public function p1() {
		echo "p1";
	}
	private function p2() {
		echo "p2";
	}
	protected function p3() {
		echo "p3";
	}
	public function test1() {
		// echo $this->name;     /* 公有的成员属性在类的内部可以访问 */
		// echo $this->age;      /* 私有的成员属性在类的内部可以访问 */
		// echo $this->sex;      /* 受保护的成员属性在类的内部可以访问 */
		// $this->p1();          /* 公有的成员方法在类的内部可以访问 */
		// $this->p2();          /* 私有的成员方法在类的内部可以访问 */
		// $this->p3();          /* 受保护的成员方法在类的内部可以访问 */
	}
}

class student extends person {
	public function test() {
		// echo $this->name;      /* 公有的成员属性在子类中可以访问 */
		// echo $this->age;       /* 私有的成员属性在子类中不可以访问 */
		// echo $this->sex;       /* 受保护的成员属性在子类中可以访问  */
		// echo $this->p1();      /* 公有的成员方法在子类中可以访问 */
		// echo $this->p2();      /* 私有的成员方法在子类中不可以访问 */
		// echo $this->p3();      /* 受保护的成员方法在子类中可以访问 */
	}
}

$person = new person("zhangsan", 18, "男");
// echo $person->name;    /* 公有的成员属性在类的外部可以访问 */
// echo $person->age;     /* 私有的成员属性在类的外部不可以直接访问 */
// echo $person->sex;     /* 受保护的成员属性在类的外部不可以直接访问 */
// $person->p1();         /* 公有的成员方法在类的外部可以访问 */
// $person->p2();         /* 私有的成员方法在类的外部不可以直接访问  */
// $person->p3();         /* 受保护的成员方法在类的外部不可以直接访问 */

// $student = new student("lisi", 20, "女");
// $student->test();

$person->test1();

?>
