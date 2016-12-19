<?php
include_once("./usb.interface.php");

class store implements USB {
	public function run() {
		$this->init();
	}

	public function init() {
		echo "store running...";
	}
}