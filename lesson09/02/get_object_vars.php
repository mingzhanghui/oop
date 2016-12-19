<?php
class demo {
	public $a = "aa";
	private $b = "bb";
	protected $c = "cc";
}

$demo = new demo();
// get_object_vars()
// 返回一个由成员属性组成的关联数组 数组的下标为成员属性名数组的值为成员属性值
// 参数：对象
// 只能得到公有的成员属性，私有的和受保护的成员属性不能得到
var_dump(get_object_vars($demo));
