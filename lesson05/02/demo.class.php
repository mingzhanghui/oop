<?php
class demo {
	/* static 如果修饰成员属性。这个成员属性就是静态的成员属性 */
	public static $name = "zhangsan";
	/* 静态的成员属性只能初始化一次。所有示例化的对象访问的都是同一个静态成员属性 */
	public static $num = 0;

	public function __construct() {
		self::$num++;
	}
	/* static如果修饰成员方法 这个方法就是静态的成员方法 */
	public static function say() {
		/* self代表本类  */
		return self::$name;     /* 在类的内部访问静态成员属性 self::成员属性名 */
	}
}

/* 在类的外部访问静态的成员属性。类名::成员属性名 */
echo demo::$name . "<br />";
/* 在类的外部访问静态的成员方法 类名::成员方法名 */
echo demo::say();

$d1 = new demo();
echo "<br />";
echo demo::$num;

$d2 = new demo();
echo "<br />";
echo demo::$num;

?>
