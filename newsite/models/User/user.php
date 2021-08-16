<?php

abstract class user
{

	public $id;
	public $username;
	public $email;
	public $password;
	public $isDeleted;

	function __construct(){}
	
	public function setId($id){ $this->id = $id; }
	public function getId(){ return $this->id; }

	public function setUsername($username){ $this->username = $username; }
	public function getUsername(){ return $this->username; }

	public function setEmail($email){ $this->email = $email; }
	public function getEmail(){ return $this->email; }

	public function setPassword($password){ $this->password = $password; }
	public function getPassword(){ return $this->password; }

	public function setIsDeleted($isDeleted){ $this->isDeleted = $isDeleted; }
	public function getIsDeleted(){ return $this->isDeleted; }

}

?>