<?php
include("./mouse.class.php");
include("./store.class.php");
include("./key.class.php");

class computer {
	public function useUSB($obj) {
		$obj->run();
	}
}

$computer = new computer();
$computer->useUSB(new mouse());
echo "<hr>";

$computer->useUSB(new store());
echo "<hr />";

$computer->useUSB(new key());


