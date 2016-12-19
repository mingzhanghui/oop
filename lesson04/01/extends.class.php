<?php
header("Content-type:text/html; charset:utf-8");
echo "<title>类继承的应用</title>";

/* PHP是单继承 一个类只能有一个父类 */
/* 一个类可以有多个子类 */
/* 支持多层继承 */
class A {
	public $name = "zhangsan";
	public $age = 20;
	public function say() {
		return $this->name;
	}
}

class B extends A {
}

class C extends B {
}

echo "<pre>";
$b = new B();
var_dump($b);
echo $b->say();
echo "<hr />";

$c = new C();
var_dump($c);
echo $c->say();
echo "</pre>";

?>
