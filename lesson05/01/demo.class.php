<?php
header("Content-type:text/html; charset:utf-8");
echo "<title>final关键字</title>";

/* final关键字修饰的类 是最终的类不能被继承 */
final class demo {

	/* final关键字修饰的成员方法 是最终版本的方法不能被重写 */
	final public function say() {
		echo "demo say";
	}
}

class demo1 extends demo {
	public function say() {
		echo "demo1 say";
	}
}

$d1 = new demo1();
$d1->say();

?>
