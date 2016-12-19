<?php
class person {
	
}

class student extends person {
	
}

$person = new person();
$student = new student();
// is_a() 判读对象是否由一个类或这个类的子类实例化来的
// 第一个参数：要判断的对象
// 第二个参数：要判断的类名
// 返回值：boolean
var_dump(is_a($person, "person"));
var_dump(is_a($student, "person"));
var_dump(is_a($person, "student"));
var_dump(is_a($student, "student"));
