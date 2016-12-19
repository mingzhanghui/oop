<?php
header("Content-type:text/html; charset:utf-8");
echo "<title>魔术方法__unset</title>";

class person {
	private $name;
	protected $age;

	public function __construct($name, $age) {
		$this->name = $name;
		$this->age = $age;
	}

	public function un_set($name) {
		unset($this->$name);
	}
	/* 魔术方法__unset() 是在类的外部用函数unset()释放私有的或受保护的成员属性时被自动调用 */
	/* 参数: 要释放的成员属性名 */
	/* 作用: 可以按需求控制成员属性的释放操作 */
	public function __unset($name) {
		if ($name == 'name') {
			return;
		}
		unset($this->$name);
	}
}

$person = new person("zhangsan", 20);
unset($person->name);
unset($person->age);
// $person->un_set("name");
// $person->un_set("age");

var_dump($person);

?>
