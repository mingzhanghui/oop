<?php
class girlfriend {
	private $id;
	private $name;
	private $age;
	private $price;

	public function __construct($id, $price = '20.00') {
		$this->id = $id;
		$this->name = $this->generateRandomName();
		$this->age = rand(15, 25);
		$this->price = number_format(floatval($price), 2, '.', '');
	}

	public function date() {
		return "我们约会吧, 约会一次￥{$this->price}";
	}

	public function __toString() {
		$str = "<tr>
		<td title='id'>{$this->id}</td>
		<td title='name'>我叫{$this->name}</td>
		<td title='age'>今年{$this->age}</td>
		<td title='date'>{$this->date()}</td>
		</tr>";
		return $str;
	}

	// @length　随机名字的字符长度
	private function generateRandomName($length = 6) {
		// 除首字母以外的可能字符
		$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
		$charsLength = strlen($chars);
		// 第一个字母大写
		$firstchars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$randStr = '' . $firstchars[rand(0, strlen($firstchars)-1)];
		// 连接后面的字符
		for ($i = 1; $i < $length; $i++) {
			$randStr .= $chars[rand(0, $charsLength-1)];
		}
		return $randStr;
	}
}

class table {
	private $gfarr = array();

	public function __construct(&$arr) {
		$this->gfarr = $arr;
	}

	private function table_head() {
		echo "<table border=1px>";
		echo "<thead><th>编号</th><th>姓名</th><th>年龄</th><th>价格</th></thead>";
		echo "<tbody>";
	}
	private function table_tail() {
		echo "</tbody></table>";
	}
	private function table_row($start, $limit) {
		while ($limit--) {
			echo $this->gfarr[$start++];
		}
	}

	public function table_write($start, $limit) {
		$this->table_head();
		$this->table_row($start, $limit);
		$this->table_tail();
	}
}



