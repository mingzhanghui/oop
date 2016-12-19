<?php
header("Content-type:text/html; charset:utf-8");
echo "<title>魔术方法__get()</title>";

class person {
	private $name;
	protected $age;

	public function __construct($name, $age) {
		$this->name = $name;
		$this->age = $age;
	}
	public function get($name) {
		return $this->$name;
	}
	/* 魔术方法__get() 是在类的外部直接得到私有的或受保护的成员属性时被自动调用 */
	/* 参数: 要访问的成员属性名 */
	/* 作用: 可以得到私有的或受保护的成员属性 也可以对返回的结果进行控制 */
	public function __get($name) {
		if ($name == 'age') {
			return 18;
		}
		return $this->$name;
	}
}

$person = new person("zhangsan", 20);
// echo $person->get("name") . "<br />";
// echo $person->get("age") . "<br />";

echo $person->name;
echo "<hr />";
echo $person->age;

?>
