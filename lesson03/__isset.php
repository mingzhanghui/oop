<?php
header("Content-type:text/html; charset=utf-8");
echo "<title>魔术方法__isset</title>";

class person {
	private $name;
	protected $age;

	public function __construct($name, $age) {
		$this->name = $name;
		$this->age = $age;
	}
	public function is_set($name) {
		return isset($this->$name);
	}
	/* 魔术方法 __isset() 是在类的外部用函数isset()判断私有的或受保护的成员属性时自动调用 */
	/* 参数: 判断的成员属性名 */
	/* 作用: 可以按需求去返回false或true */
	public function __isset($name) {
		if ($name == 'age') {
			return false;
		}
		return isset($this->$name);
	}
}

$person = new person("zhangsan", 20);
var_dump(isset($person->name));
var_dump(isset($person->age));

// var_dump($person->is_set("name"));
// var_dump($person->is_set("age"));

?>
