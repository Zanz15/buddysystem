<?php
//	echo "<pre>";

	$toSmarty['usePreferredLanguage'] = $buddysys_prefLanguage;

	if(!isset($_GET['authIncoming']) && !isset($_GET['validate'])){
		print("auth error");
		die;
	}
	elseif(isset($_GET['validate']) && isset($_GET['authIncoming'])){
		$toSmarty = validateForm();
		$toSmarty['authHash'] = $_GET['authIncoming'];
		
	}
	elseif(isset($_GET['authIncoming']) && !isset($_GET['validate'])){
		$incoming = getIncoming();
		if($incoming != false){
			$incomingValues = getIncomingValues($incoming);
			$toSmarty = setIncomingForm($incomingValues);
			
			$toSmarty['authHash'] = $incoming->getAuthHash();  
			$toSmarty['action'] = $caller."?action=incomingLogin&validate=true&authIncoming=".$incoming->getAuthHash();
		}
		else{
			print("Could not find incoming in database");
			die;
		}
		
	}
	else{
		die;
	}

	$preferredLanguage = array(
				0 => "English",
				1 => "Deutsch");
					

	$toSmarty['preferredLanguage'] = $preferredLanguage;
	$toSmarty['preferredLanguageSelected'] = 0;	
	
	$toSmarty['studies'] = getStudies();
	$toSmarty['countries'] = getCountries();	
	
	
	if(isset($toSmarty['update'])){
		if($toSmarty['update'] == "success"){
			$toSmarty['actionTpl'] = 'incomingUpdateSuccess.tpl';
		}
	}
	else{
		$toSmarty['actionTpl'] = 'incomingLogin.tpl';
	}	
	$smarty->assign( $toSmarty );

	/**
	 * functions start
	 */
	
	function validateForm(){
		$values = array();
			
		if(isset($_GET['validate'])){
			if($_GET['validate'] == true){
				$values['studiesSelected'] = $_POST['studySelect'];
				$values['countrySelected'] = $_POST['countrySelected'];	
				$values['preferredLanguageSelected'] = $_POST['preferredLanguageSelected'];
				$values['dateArrivalInput'] = $_POST['dateArrivalInput'];
				$values['firstName'] = $_POST['firstname'];
				$values['lastName'] = $_POST['lastname'];	
				$values['email0'] = $_POST['email'];	
				$values['email1'] = $_POST['emailConfirm'];
				
				$values['error'] = validateInput();
				
				if($values['error'] == ""){
					if(updateIncoming() != TRUE){
						$values['action'] = $caller."?action=incomingLogin&validate=true&authIncoming=".$_GET['auth'];
					}
					else{
						$values['update'] = "success";
					}
				}
			}
		}			
		
		return($values);
	}	

	function validateInput(){
		$error = array();
		if($_POST['firstname'] == ""){
			$error['firstname'] = "Fill in your first name";
		}
		if($_POST['lastname'] == ""){
			$error['lastname'] = "Fill in your last name";
		}
		if($_POST['email'] == ""){
			$error['email'] = "Fill in your email address";
		}
		if($_POST['emailConfirm'] == ""){
			$error['emailConfirm'] = "Fill in your email address twice";
		}
		if($_POST['emailConfirm'] != $_POST['email']){
			$error['emailNotEqual'] = "Please enter the same address twice";
		}
	    $validator = new EmailAddressValidator;
	    if (!$validator->check_email_address($_POST['email'])) {
	         $error['emailValidator'] = "Fill in a valid email address";
	    }
	    
		if($_POST['studySelect'] == 0){
			$error['studySelect'] = "Select a study";
		}
		if(sizeof(explode("-",$_POST['dateArrivalInput'])) != 3){
			$error['dateArrivalInput'] = "Please enter a valid date";
		}
		
		if(sizeof($error) == 0){
			$error = "";
		}
	
		return($error);
	}

	function updateIncoming(){
		$incoming = new incoming();
		$incoming->setFirstName($_POST['firstname']);
		$incoming->setLastName($_POST['lastname']);
		$incoming->setEmail($_POST['email']);
		$incoming->setIdNationality($_POST['countrySelected']);
		$incoming->setIdStudy($_POST['studySelect']);
		$incoming->setPreferredLanguage($_POST['preferredLanguageSelected']);
		$incoming->setAuthHash($_GET['authIncoming']);
		$incoming->setLocked(0);
		$dateArrival = explode("-",$_POST['dateArrivalInput']);
		$phpdate = mktime(0, 0, 0, $dateArrival[1], $dateArrival[0], $dateArrival[2]);
		$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
		$incoming->setDateArrival($mysqldate);
	//	$buddy->set($_POST['']);
	//	var_export($incoming);
	//	die;
		$BaseDAOincoming = new BaseDAOincoming();
		$status = $BaseDAOincoming->update($incoming);
		return($status);
	}		
	
	function setIncomingForm($incomingValues){
		$values = array();
		
		$values['studiesSelected'] = $incomingValues['idStudy'];
		$values['countrySelected'] = $incomingValues['idNationality'];	
		$values['preferredLanguageSelected'] = $incomingValues['preferredLanguageSelected'];
		$temp = explode(" ",$incomingValues['dateArrival']);
		$temp = explode("-",$temp[0]);
		$values['dateArrivalInput'] = $temp[2]."-".$temp[1]."-".$temp[0];
		$values['firstName'] = $incomingValues['firstName'];
		$values['lastName'] = $incomingValues['lastName'];	
		$values['email0'] = $incomingValues['email'];	
		$values['email1'] = $incomingValues['emailConfirm'];
		
		return($values);
	}	
	
	function getIncomingValues($incoming){
		$incomingValues = array();
		
		$incomingValues['id'] = $incoming->getId();
		$incomingValues['firstName'] = $incoming->getFirstName();
		$incomingValues['lastName'] = $incoming->getLastName();
		$incomingValues['email'] = $incoming->getEmail();
		$incomingValues['emailConfirm'] = $incoming->getEmail();
		$incomingValues['idNationality'] = $incoming->getIdNationality();
		$incomingValues['idStudy'] = $incoming->getIdStudy();
		$incomingValues['preferredLanguageSelected'] = $incoming->getPreferredLanguage();
		$incomingValues['dateArrival'] = $incoming->getDateArrival();
		return($incomingValues);
	}	
	
	function getIncoming(){
		$BaseDAOincoming = new BaseDAOincoming();
		$incoming = $BaseDAOincoming->findByAuthHash($_GET['authIncoming']);
		return($incoming);
	}

	function getStudies() {
		$studyDAO = new BaseDAOstudy();
		$studies = $studyDAO->findAll();
	//	var_export ( $studies );
		return($studies);
	}
	
	function getCountries() {
		$nationalityDAO = new BaseDAOnationality();
		$countries = $nationalityDAO->findAll();
	//	var_export ( $studies );
		return($countries);
	}	
	
?>
