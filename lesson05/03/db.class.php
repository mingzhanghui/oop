<?php
class DB {
	/* 声明一个变量的成员属性。主要用静态成员属性只能初始化一次的特性。把它作为标识 */
	private static $obj = null;

	/* 用于连接数据库 */
	private function __construct() {
		echo "mysql linked...";
	}

	/* 静态的成员方法可以不需要对象就可以直接访问。这个方法用于得到对象 */
	static function getObj() {
		/* 判断静态成员属性是否是初始值 */
		/* 如果是初始值 就示例化对象 */
		if (is_null(self::$obj)) {
			/* 把对象赋值给静态的成员属性 */
			self::$obj = new self();
		}
		/* 把静态成员属性中的对象返回 */
		return self::$obj;
	}

	public function select() {
		echo "select data...";
	}
}

/* $db = new DB();*/
var_dump(DB::getObj());
var_dump(DB::getObj());

?>
