<?php
class parentClass {
	
}

class demo extends parentClass {
	
}

// get_parent_class() 得到类或对象的父类名
// 参数：可以是类名也可以是对象
// var_dump(get_parent_class("demo"));
$demo = new demo();
var_dump(get_parent_class($demo));
