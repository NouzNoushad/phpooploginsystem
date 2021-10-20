<?php

namespace Controllers;
class LoginController extends \Models\Login {

	private $email;
	private $password;
	public $errors = [];

	public function __construct(string $email, string $password){
		$this->email = $email;
		$this->password = $password;
	}

	public function loginUserError(){

		if($this->checkAllFields() === false){
			$this->errors['error'] = 'All fields are required';
		}
		if($this->checkEmail() === 'emptyEmail'){
			$this->errors['email'] = 'Email field should not be empty';
		}
		if($this->checkEmail() === false){
			$this->errors['email'] = 'Please provide valid email';
		}
		if($this->checkPassword() === 'emptyPassword'){
			$this->errors['password'] = 'Password field should not be empty';
		}
		if($this->checkPassword() === false){
			$this->errors['password'] = 'Password should be below 5 characters';
		}

		if(empty($this->errors)){
			$errors = $this->loginUser($this->email, $this->password);
			return $errors;
		}

		return $this->errors;
	}

	// validations
	private function checkAllFields(){
		if(empty($this->email) || empty($this->password)){
			return false;
		}
		else{
			return true;
		}
	}

	private function checkEmail(){
		if(empty($this->email)){
			return 'emptyEmail';
		}
		elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			return false;
		}
		else{
			return true;
		}
	}

	private function checkPassword(){
		if(empty($this->password)){
			return 'emptyPassword';
		}
		elseif(!preg_match('/^[a-zA-Z0-9]{0,5}+$/', $this->password)){
			return false;
		}
		else{
			return true;
		}
	}
}