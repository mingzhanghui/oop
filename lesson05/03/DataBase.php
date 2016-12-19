<?php
class DataBase {
	private static $mysqli;

	final private function __construct() {
	}

	public static function getInstance() {
		if (!is_object(self::$mysqli)) {
			self::$mysqli = new mysqli('localhost', 'root', 'root', 'jkxy');
		}
		return self::$mysqli;
	}

	private function __destruct() {
		if (self::$mysqli) {
			self::$mysqli->close();
		}
	}
	private function __clone() {
	}
}

$link1 = DataBase::getInstance();
$link2 = DataBase::getInstance();
echo $link1 === $link2;
/* echo "<pre>";
 * var_dump($mysqli);*/

?>
