<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 9:43 AM
 */

header("Content-type: text/html; charset: utf-8");
echo "<title>instanceof关键字</title>";

class demo {}

class demo1 extends demo {}

$demo = new demo();
$demo1 = new demo1();

// instanceof可以用于判断一个对象是否是由一个类或这个子类实例化来的
var_dump($demo instanceof demo);
var_dump($demo1 instanceof demo1);
var_dump($demo instanceof demo1);
var_dump($demo1 instanceof demo);
