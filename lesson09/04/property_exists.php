<?php
class person {
	public $name;
	private $age;
	protected $sex;
}

$person = new person();
// property_exits()　用于判断成员属性是否在一个类或对象中
// 第一个参数：类名或对象
// 第二个参数：要判断的成员属性名
// 返回值：true或false
var_dump(property_exists($person, "sex"));
