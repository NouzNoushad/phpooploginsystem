<?php
namespace Config;
class Dbh {

	private $user = 'root';
	private $pwd = '';

	protected function connect(){

		$dsn = "mysql:host=localhost;dbname=ooploginsystem";
		$pdo = new \PDO($dsn, $this->user, $this->pwd);
		$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		return $pdo;
	}
}