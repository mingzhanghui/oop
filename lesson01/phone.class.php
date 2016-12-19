<?php

class Phone {
	public $width;
	public $height;
	public $size;

	public function call($name) {
		echo "<p>正在给{$name}打电话</p>";
	}

	public function message($name) {
		echo "<p>正在给{$name}发短信</p>";
	}

	public function play() {
		echo "<p>正在玩游戏</p>";
	}

	public function info() {
		$this->play();
		return "<p>手机的宽度: {$this->width}, 手机的高度: {$this->height}</p>";
	}
}

header("Content-type: text/html; charset=utf-8");
echo "<title>通过类实例化对象</title>";

echo "<pre>";

$phone = new Phone();
$phone->width = "5cm";
$phone->height = "10cm";

/* $phone->width = "5cm";
 * echo $phone->width . "<br />";
*
* $phone1 = new Phone();
* $phone1->height = "10cm";
* echo "<p>" . $phone1->height . "</p>";
* $height = $phone1->height;
* echo "<p>" . $height . "</p>";*/

/* $phone1->aaaa = "AAAA";*/

$phone->call("list");
$phone->call("tom");
$phone->play();
echo $phone->info();

?>
