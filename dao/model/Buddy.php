<?php

/** 
 * @author martijn
 * 
 * 
 */
class Buddy {
	
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $idNationality;
	private $idPreferredCountryFirst;
	private $idPreferredCountrySecond;
	private $idPreferredCountryThird;
	private $idStudy;
	private $idGroup;
	private $tandem;
	private $preferredInfoEvening;
	private $buddyBefore;
	private $authHash;
	private $locked;
	private $dateAdded;
	private $dateLogin;
	private $dateAvailable;
	
	function __construct() {
	
	}
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @return the $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return the $idNationality
	 */
	public function getIdNationality() {
		return $this->idNationality;
	}

	/**
	 * @return the $idPreferredCountryFirst
	 */
	public function getIdPreferredCountryFirst() {
		return $this->idPreferredCountryFirst;
	}

	/**
	 * @return the $idPreferredCountrySecond
	 */
	public function getIdPreferredCountrySecond() {
		return $this->idPreferredCountrySecond;
	}

	/**
	 * @return the $idPreferredCountryThird
	 */
	public function getIdPreferredCountryThird() {
		return $this->idPreferredCountryThird;
	}

	/**
	 * @return the $idStudy
	 */
	public function getIdStudy() {
		return $this->idStudy;
	}

	/**
	 * @return the $idGroup
	 */
	public function getIdGroup() {
		return $this->idGroup;
	}

	/**
	 * @return the $tandem
	 */
	public function getTandem() {
		return $this->tandem;
	}

	/**
	 * @return the $preferredInfoEvening
	 */
	public function getPreferredInfoEvening() {
		return $this->preferredInfoEvening;
	}

	/**
	 * @return the $buddyBefore
	 */
	public function getBuddyBefore() {
		return $this->buddyBefore;
	}

	/**
	 * @return the $authHash
	 */
	public function getAuthHash() {
		return $this->authHash;
	}

	/**
	 * @return the $locked
	 */
	public function getLocked() {
		return $this->locked;
	}

	/**
	 * @return the $dateAdded
	 */
	public function getDateAdded() {
		return $this->dateAdded;
	}

	/**
	 * @return the $dateLogin
	 */
	public function getDateLogin() {
		return $this->dateLogin;
	}

	/**
	 * @return the $dateAvailable
	 */
	public function getDateAvailable() {
		return $this->dateAvailable;
	}

	/**
	 * @param $id the $id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param $firstName the $firstName to set
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * @param $lastName the $lastName to set
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * @param $email the $email to set
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param $idNationality the $idNationality to set
	 */
	public function setIdNationality($idNationality) {
		$this->idNationality = $idNationality;
	}

	/**
	 * @param $idPreferredCountryFirst the $idPreferredCountryFirst to set
	 */
	public function setIdPreferredCountryFirst($idPreferredCountryFirst) {
		$this->idPreferredCountryFirst = $idPreferredCountryFirst;
	}

	/**
	 * @param $idPreferredCountrySecond the $idPreferredCountrySecond to set
	 */
	public function setIdPreferredCountrySecond($idPreferredCountrySecond) {
		$this->idPreferredCountrySecond = $idPreferredCountrySecond;
	}

	/**
	 * @param $idPreferredCountryThird the $idPreferredCountryThird to set
	 */
	public function setIdPreferredCountryThird($idPreferredCountryThird) {
		$this->idPreferredCountryThird = $idPreferredCountryThird;
	}

	/**
	 * @param $idStudy the $idStudy to set
	 */
	public function setIdStudy($idStudy) {
		$this->idStudy = $idStudy;
	}

	/**
	 * @param $idGroup the $idGroup to set
	 */
	public function setIdGroup($idGroup) {
		$this->idGroup = $idGroup;
	}

	/**
	 * @param $tandem the $tandem to set
	 */
	public function setTandem($tandem) {
		$this->tandem = $tandem;
	}

	/**
	 * @param $preferredInfoEvening the $preferredInfoEvening to set
	 */
	public function setPreferredInfoEvening($preferredInfoEvening) {
		$this->preferredInfoEvening = $preferredInfoEvening;
	}

	/**
	 * @param $buddyBefore the $buddyBefore to set
	 */
	public function setBuddyBefore($buddyBefore) {
		$this->buddyBefore = $buddyBefore;
	}

	/**
	 * @param $authHash the $authHash to set
	 */
	public function setAuthHash($authHash) {
		$this->authHash = $authHash;
	}

	/**
	 * @param $locked the $locked to set
	 */
	public function setLocked($locked) {
		$this->locked = $locked;
	}

	/**
	 * @param $dateAdded the $dateAdded to set
	 */
	public function setDateAdded($dateAdded) {
		$this->dateAdded = $dateAdded;
	}

	/**
	 * @param $dateLogin the $dateLogin to set
	 */
	public function setDateLogin($dateLogin) {
		$this->dateLogin = $dateLogin;
	}

	/**
	 * @param $dateAvailable the $dateAvailable to set
	 */
	public function setDateAvailable($dateAvailable) {
		$this->dateAvailable = $dateAvailable;
	}

	
	
	
	
}

?>