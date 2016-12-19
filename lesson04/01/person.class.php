<?php
header("Content-type:text/html; charset:utf-8");
echo "<title>类继承的应用 public person</title>";

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
		echo "say...";
	}
	public function eat() {
		echo "eat...";
	}
	public function run() {
		echo "run...";
	}
}

class teacher extends person {
	public function teach() {
		echo "teach...";
	}
}

class student extends person {
	public function learn() {
		echo "learn...";
	}
}

$teacher = new teacher("zhangsan", 30, '男');
// $teacher->say();
$teacher->teach();
$teacher->learn();
echo "<hr />";

$student = new student("lisi", 18, '女');
// $student->run();
$student->learn();

?>
