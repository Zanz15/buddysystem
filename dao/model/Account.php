<?php

/** 
 * @author martijn
 * 
 * 
 */
class Account {
	
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $userName;
	private $password;	
	
	function __construct() {
	
	}
	
	/**
	 * @return the $id
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * @return the $firstName
	 */
	function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @return the $lastName
	 */
	function getLastName() {
		return $this->lastName;
	}

	/**
	 * @return the $email
	 */
	function getEmail() {
		return $this->email;
	}

	/**
	 * @return the $userName
	 */
	function getUserName() {
		return $this->userName;
	}

	/**
	 * @return the $password
	 */
	function getPassword() {
		return $this->password;
	}

	/**
	 * @param $id the $id to set
	 */
	function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param $firstName the $firstName to set
	 */
	function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * @param $lastName the $lastName to set
	 */
	function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * @param $email the $email to set
	 */
	function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param $userName the $userName to set
	 */
	function setUserName($userName) {
		$this->userName = $userName;
	}

	/**
	 * @param $password the $password to set
	 */
	function setPassword($password) {
		$this->password = $password;
	}

}

?>