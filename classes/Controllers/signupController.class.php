<?php

namespace Controllers;
class SignupController extends \Models\Signup {

	private $name;
	private $email;
	private $password;
	private $repeatPassword;
	public $errors = [];

	public function __construct(string $name, string $email, string $password, string $repeatPassword){

		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->repeatPassword = $repeatPassword;
	}

	public function signupUserError(){

		if($this->checkAllFields() === false){
			$this->errors['error'] = 'All fields are required';
		}
		if($this->checkName() === 'emptyName'){
			$this->errors['name'] = 'Name field should not be empty';
		}
		if($this->checkName() === false){
			$this->errors['name'] = 'Please provide a valid name. no special characters allowed';
		}
		if($this->checkEmail() === 'emptyEmail'){
			$this->errors['email'] = 'Email field should not be empty';
		}
		if($this->checkEmail() === false){
			$this->errors['email'] = 'Please provide a valid email';
		}
		if($this->checkPassword() === 'emptyPassword'){
			$this->errors['password'] = 'Password field should not be empty';
		}
		if($this->checkPassword() === false){
			$this->errors['password'] = 'Password should be below 5 characters';
		}
		if($this->checkRepeatPassword() === 'emptyRepeatPassword'){
			$this->errors['repeatPassword'] = 'Repeat password field should not be empty';
		}
		if($this->checkRepeatPassword() === false){
			$this->errors['repeatPassword'] = 'Password do not match. please try again';
		}
		if($this->checkUserExists() === false){
			$this->errors['error'] = 'Username or email already taken';
		}

		if(empty($this->errors)){
			$this->setSignup($this->name, $this->email, $this->password);
		}
		return $this->errors;
	}

	//validations
	private function checkAllFields(){

		if(empty($this->name) || empty($this->email) || empty($this->password) || empty($this->repeatPassword)){
			return false;
		}
		else{
			return true;
		}
	}

	private function checkName(){

		if(empty($this->name)){
			return 'emptyName';
		}
		elseif(!preg_match('/^[a-zA-Z0-9\s]*$/', $this->name)){
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

	private function checkRepeatPassword(){

		if(empty($this->repeatPassword)){
			return 'emptyRepeatPassword';
		}
		elseif($this->repeatPassword !== $this->password){
			return false;
		}
		else{
			return true;
		}
	}

	private function checkUserExists(){

		if(!$this->signupUser($this->name, $this->email)){
			return false;
		}
		else{
			return true;
		}
	}
}