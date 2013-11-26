<?php

/** 
 * @author martijn
 * 
 * 
 */
class ChatMessage {
	
	function __construct() {
	
	}
	
	private $id;
	private $idGroup;
	private $message;
	private $idBuddy;
	private $idIncoming;
	private $dateSend;
	
	/**
	 * @return the $id
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * @param $id the $id to set
	 */
	function setId($id) {
		$this->id = $id;
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

	/**
	 * @return the $message
	 */
	function getMessage() {
		return $this->message;
	}

	/**
	 * @param $message the $message to set
	 */
	function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * @return the $idBuddy
	 */
	function getIdBuddy() {
		return $this->idBuddy;
	}

	/**
	 * @param $idBuddy the $idBuddy to set
	 */
	function setIdBuddy($idBuddy) {
		$this->idBuddy = $idBuddy;
	}

	/**
	 * @return the $dateSend
	 */
	function getDateSend() {
		return $this->dateSend;
	}

	/**
	 * @param $dateSend the $dateSend to set
	 */
	function setDateSend($dateSend) {
		$this->dateSend = $dateSend;
	}
	/**
	 * @return the $idIncoming
	 */
	function getIdIncoming() {
		return $this->idIncoming;
	}

	/**
	 * @param $idIncoming the $idIncoming to set
	 */
	function setIdIncoming($idIncoming) {
		$this->idIncoming = $idIncoming;
	}


	
}

?>