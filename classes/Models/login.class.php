<?php

namespace Models;
class Login extends \Config\Dbh{

	protected $errors = [];

	protected function loginUser($email, $password){

		// select the password from database by using email
		$sql = "SELECT password FROM users WHERE email=?;";
		$stmt = $this->connect()->prepare($sql);
		if(!$stmt->execute([$email])){
			$stmt = null;
			header("Location: ../notFound.php");
			exit();
		}
		// check user exists
		if($stmt->rowCount() === 0){
			$stmt = null;
			$this->errors = 'User not found';
			return $this->errors;
		}
		$fetchPassword = $stmt->fetchAll();
		$hashPassword = $fetchPassword[0]['password'];
		// compare hash password
		$password = password_verify($password, $hashPassword);
		if($password === false){
			$stmt = null;
			$this->errors = 'Invalid password';
			return $this->errors;
		}
		elseif($password === true){
			
			$sql = "SELECT * FROM users WHERE email=? AND password=?;";
			$stmt = $this->connect()->prepare($sql);
			if(!$stmt->execute([$email, $hashPassword])){
				$stmt = null;
				header("Location: ../notFound.php");
				exit();
			}
			if($stmt->rowCount() === 0){
				$stmt = null;
				$this->errors = 'User not found';
				return $this->errors;
			}
			$user = $stmt->fetchAll();
			// start a session and save data
			session_start();
			$_SESSION['id'] = $user[0]['id'];
			$_SESSION['name'] = $user[0]['name'];
			print_r($_SESSION);
			$stmt = null;
		}
	}
}