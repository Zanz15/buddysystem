<?php

/** 
 * @author martijn
 * 
 * 
 */
class Incoming {
	
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $idNationality;
	private $preferredLanguage;
	private $dateAdded;
	private $dateArrival;
	private $dateLogin;
	private $idStudy;
	private $authHash;
	private $locked;
	private $idGroup;
	
	function __construct() {
	
	}
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param $id the $id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return the $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param $firstName the $firstName to set
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * @return the $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param $lastName the $lastName to set
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param $email the $email to set
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return the $idNationality
	 */
	public function getIdNationality() {
		return $this->idNationality;
	}

	/**
	 * @param $idNationality the $idNationality to set
	 */
	public function setIdNationality($idNationality) {
		$this->idNationality = $idNationality;
	}

	/**
	 * @return the $preferredLanguage
	 */
	public function getPreferredLanguage() {
		return $this->preferredLanguage;
	}

	/**
	 * @param $preferredLanguage the $preferredLanguage to set
	 */
	public function setPreferredLanguage($preferredLanguage) {
		$this->preferredLanguage = $preferredLanguage;
	}

	/**
	 * @return the $dateAdded
	 */
	public function getDateAdded() {
		return $this->dateAdded;
	}

	/**
	 * @param $dateAdded the $dateAdded to set
	 */
	public function setDateAdded($dateAdded) {
		$this->dateAdded = $dateAdded;
	}

	/**
	 * @return the $dateArrival
	 */
	public function getDateArrival() {
		return $this->dateArrival;
	}

	/**
	 * @param $dateArrival the $dateArrival to set
	 */
	public function setDateArrival($dateArrival) {
		$this->dateArrival = $dateArrival;
	}

	/**
	 * @return the $idStudy
	 */
	public function getIdStudy() {
		return $this->idStudy;
	}

	/**
	 * @param $idStudy the $idStudy to set
	 */
	public function setIdStudy($idStudy) {
		$this->idStudy = $idStudy;
	}
	/**
	 * @return the $authHash
	 */
	function getAuthHash() {
		return $this->authHash;
	}

	/**
	 * @return the $locked
	 */
	function getLocked() {
		return $this->locked;
	}

	/**
	 * @param $authHash the $authHash to set
	 */
	function setAuthHash($authHash) {
		$this->authHash = $authHash;
	}

	/**
	 * @param $locked the $locked to set
	 */
	function setLocked($locked) {
		$this->locked = $locked;
	}
	/**
	 * @return the $dateLogin
	 */
	function getDateLogin() {
		return $this->dateLogin;
	}

	/**
	 * @param $dateLogin the $dateLogin to set
	 */
	function setDateLogin($dateLogin) {
		$this->dateLogin = $dateLogin;
	}
	/**
	 * @return the $idGroup
	 */
	function getIdGroup() {
		return $this->idGroup;
	}

	/**
	 * @param $idGroup the $idGroup to set
	 */
	function setIdGroup($idGroup) {
		$this->idGroup = $idGroup;
	}




}

?>