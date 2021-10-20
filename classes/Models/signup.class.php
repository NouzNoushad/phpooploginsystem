<?php

namespace Models;
class Signup extends \Config\Dbh {

	// check email or user already exists
	protected function signupUser(string $name, string $email): bool{

		$sql = "SELECT email FROM users WHERE name=? OR email=?;";
		$stmt = $this->connect()->prepare($sql);
		if(!$stmt->execute([$name, $email])){
			$stmt = null;
			header("Location: ../notFound.php");
			exit();
		}
		if($stmt->rowCount() > 0){
			$result =  false;
		}
		else{
			$result = true;
		}
		return $result;
	}

	// insert user signup data into database
	protected function setSignup(string $name, string $email, string $password){

		$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?);";
		$stmt = $this->connect()->prepare($sql);
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
		if(!$stmt->execute([$name, $email, $hashPassword])){
			$stmt = null;
			header("Location: ../notFound.php");
			exit();
		}
		$stmt = null;
	}
}