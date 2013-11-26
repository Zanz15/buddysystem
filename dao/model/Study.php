<?php

/** 
 * @author martijn
 * 
 * 
 */
class Study {
	
	private $id;
	private $study;
	
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
	 * @return the $study
	 */
	public function getStudy() {
		return $this->study;
	}

	/**
	 * @param $study the $study to set
	 */
	public function setStudy($study) {
		$this->study = $study;
	}

}

?>