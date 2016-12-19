<?php
include_once ("./usb.interface.php");

class mouse implements usb {
	public function run() {
		$this->init();
	}

	public function init() {
		echo "mouse running...";
	}
}

$mouse = new mouse();