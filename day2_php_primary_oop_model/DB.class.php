<?php
class DB {
	private $_db;
	//静态是通过类::字段直接访问的,private表示外部不能访问
	static private $_instance;
	//访问这个实例的公共静态方法
	static public function getInstance() {
		//如果对象没有创建，就创建它，如果创建了，就直接返回
		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	//单一职责问题，私有化克隆
	private function __clone() {
	    echo '不能可能';
	}
	//私有化构造方法，
	private function __construct() {
		try {
			$this->_db = new PDO('mysql:host=localhost;dbname=wepiao','root','root');
		} catch (PDOException  $e) {
			exit($e->getMessage());
		}
	}
	public function query($_sql) {
		return $this->_db->query($_sql);
	}
}
?>