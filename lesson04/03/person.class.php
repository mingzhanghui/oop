<?php
header("Content-type:text/html; charset:utf-8");
echo "<title>子类中重载父类方法</title>";

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
		echo "我的名字是: {$this->name}, 我的年龄是: {$this->age}, 我的性别是: {$this->sex}";
	}
}

class teacher extends person {
	public $teach;

	public function __construct($name, $age, $sex, $teach) {
		parent::__construct($name, $age, $sex);
		$this->teach = $teach;
	}

	/* 重写: 就是声明一个与父类中同名的方法 */
	public function say() {
		parent::say();
		/* 重载: parent::父类中的方法名 */
		echo ", 我教的学科是: {$this->teach}";
	}
}

class student extends person {
	public $school;

	public function __construct($name, $age, $sex, $school) {
		parent::__construct($name, $age, $sex);
		$this->school = $school;
	}
	public function say() {
		parent::say();
		echo ", 我所在的学校是: {$this->school}";
	}
}

$teacher = new teacher("张三", 30, '男', '数学');
$teacher->say();

echo "<hr />";
$student = new student("李四", 18, '女', '北大');
$student->say();

?>
