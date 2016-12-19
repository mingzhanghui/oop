<?php
class person {
	public function say() {
	}
	private function run() {
	}
	private function eat() {
	}
}

// var_dump(get_class_methods("person"));
$p = new person();
// get_class_methods() 得到了类或对象中的成员方法组成数组
// 如果是私有的或受保护的成员方法就不会被得到
// 参数可以传类名也可以传对象
var_dump(get_class_methods($p));
