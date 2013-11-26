<?php

/** 
 * @author martijn
 * 
 * 
 */
class Group {
	
	private $id;
	private $groupName;
	
	function __construct() {
	
	}
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $groupName
	 */
	public function getGroupName() {
		return $this->groupName;
	}

	/**
	 * @param $id the $id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param $groupName the $groupName to set
	 */
	public function setGroupName($groupName) {
		$this->groupName = $groupName;
	}

}

?>