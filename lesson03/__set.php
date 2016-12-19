<?php
class person {
	private $name;
	protected $age;

	public function set($name, $value) {
		$this->$name = $value;
	}
	/* 魔术方法__set() 是在给私有的或受保护的成员属性在类的外部直接赋值时被自动调用 */
	/* 第1个参数: 要赋值的成员属性名 */
	/* 第2个参数: 要赋的值 */
	/* 作用: 可以更好的对程序进行控制 */
	public function __set($name, $value) {
		if ($name == 'age' && $value > 30) {
			$this->$name = $value - 5;
		} else {
			$this->$name = $value;
		}
	}
}

header("Content-type: text/html; charset: utf-8");
echo "<title>魔术方法__set()</title>";

$person = new person();
/* $person->set("name", "zhangsan");
 * $person->set("age", 18);*/
$person->name = "lisi";
$person->age = 31;
echo "<pre>";
var_dump($person);

?>
