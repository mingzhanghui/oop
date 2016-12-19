<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 10:09 AM
 */
echo "<title>__call方法的应用</title>";

class db {
	private $sql = array("table"=>'',
			"field"=>'*',
			"where"=>'',
			"order"=>'',
			"limit"=>'');
	// 魔术方法 __call() 是在调用 一个不存在的方法时被自动调用
	// 第一个参数: 调用的方法名
	// 第二个参数: 调用方法时传的参数列表 (数组)
	//  public function __call($methodName, $args) {
	//    echo "你所调用的方法{$methodName}()";
	//    print_r($args);
	//    echo "不存在!";
	//  }
	public function __call($methodName, $args) {
		//    判断调用的方法名是否是成员属性数组下标
		if (array_key_exists($methodName, $this->sql)) {
			//      如果是就进行赋值操作
			$this->sql[$methodName] = $args[0];
		} else {
			//      如果不是就给出提示信息
			die("你所调用的方法{$methodName}不存在");
		}
		//    返回本对象,为了实现连贯操作
		return $this;
	}
	public function select() {
		$where = $order = $limit = '';
		if ($this->sql['where']) {
			$where = "WHERE {$this->sql['where']}";
		}
		if ($this->sql['order']) {
			$order = "ORDER BY {$this->sql['order']}";
		}
		if ($this->sql['limit']) {
			$limit = "LIMIT {$this->sql['limit']}";
		}
		echo $sql = "SELECT {$this->sql['field']} FROM {$this->sql['table']} {$where} {$order} {$limit}";
	}
}

$db = new db();
// $db->select("a","b","c");
// $db->table("user")->field("id,username,pwd")->limit("0,10")->order("id desc")->where("id>5")->select();
$db->table("user")->field("id,username,pwd")->limit("0,10")->where("id<100")->select();
echo "<pre>";
var_dump($db);
