<?php
include_once("./usb.interface.php");

class key implements USB {
	public function run() {
		$this->init();
	}
	public function init() {
		echo "key running...";
	}
}