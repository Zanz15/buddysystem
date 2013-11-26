<?php
//	echo "<pre>";
	
	if(!isset($_GET['auth']) && !isset($_GET['validate'])){
		print("auth error");
		die;
	}
	elseif(isset($_GET['validate']) && isset($_GET['auth'])){
		$toSmarty = validateForm();
		$toSmarty['authHash'] = $_GET['auth'];
		
	}
	elseif(isset($_GET['auth']) && !isset($_GET['validate'])){
		
		$buddy = getBuddy();
		
//		var_export($buddy);
		if($buddy == false){
			print("Could not find buddy in database");
			die;
		}
		
		if($buddy->getId()  != NULL){
			
			
			$buddyValues = getBuddyValues($buddy);
			$toSmarty = setBuddyForm($buddyValues);
			//var_export($buddy);
			
			$toSmarty['authHash'] = $buddy->getAuthHash();  
			$toSmarty['action'] = $caller."?action=buddyLogin&validate=true&auth=".$buddy->getAuthHash();
//			$toSmarty['update'] ="";

			$toSmarty['use_tandem'] = $buddysys_use_tandem;

		}
		else{
			print("Could not find buddy in database");
			die;
		}
		
	}
	else{
		die;
	}
	
	if(isset($buddysys_dates))
		$toSmarty['infoEvenings'] = $buddysys_dates;
	else $toSmarty['infoEvenings'] = array();

	$toSmarty['studies'] = getStudies();
	$toSmarty['countries'] = getCountries();	
	
	
	if(isset($toSmarty['update'])){
		if($toSmarty['update'] == "success"){
			$toSmarty['actionTpl'] = 'buddyUpdateSuccess.tpl';
		}
	}
	else{
		$toSmarty['actionTpl'] = 'buddyLogin.tpl';
	}
	
	$smarty->assign( $toSmarty );
	
	function updateBuddy(){
		global $buddysys_use_tandem;

		$buddy = new buddy();
		$buddy->setFirstName($_POST['firstname']);
		$buddy->setLastName($_POST['lastname']);
		$buddy->setEmail($_POST['email']);
		$buddy->setIdPreferredCountryFirst($_POST['preferredCountry1']);
		$buddy->setIdPreferredCountrySecond($_POST['preferredCountry2']);
		$buddy->setIdPreferredCountryThird($_POST['preferredCountry3']);
		$buddy->setIdStudy($_POST['studySelect']);
		$buddy->setTandem($buddysys_use_tandem ? $_POST['tandem'] : 0);
		$buddy->setPreferredInfoEvening(0);
		$buddy->setBuddyBefore($_POST['buddyBefore']);
		$buddy->setAuthHash($_GET['auth']);
		$buddy->setLocked(0);
		$buddy->setIdNationality(0);
		$available = explode("-",$_POST['availableFromInput']);
		$phpdate = mktime(0, 0, 0, $available[1], $available[0], $available[2]);
		$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
		$buddy->setDateAvailable($mysqldate);
	//	$buddy->set($_POST['']);
	//	var_export($buddy);
	
		$BaseDAObuddy = new BaseDAObuddy();
		$status = $BaseDAObuddy->update($buddy);
		return($status);
	}		
	
	function setBuddyForm($buddyValues){
		$values = array();
		
		$values['studiesSelected'] = $buddyValues['idStudy'];
		$values['countriesSelected1'] = $buddyValues['idPreferredCountryFirst'];	
		$values['countriesSelected2'] = $buddyValues['idPreferredCountrySecond'];
		$values['countriesSelected3'] = $buddyValues['idPreferredCountryThird'];
		$values['infoEveningsSelected'] = $buddyValues['preferredInfoEvening'];
		$temp = explode(" ",$buddyValues['dateAvailable']);
		$temp = explode("-",$temp[0]);
		$values['availableFromInput'] = $temp[2]."-".$temp[1]."-".$temp[0];
		$values['firstName'] = $buddyValues['firstName'];
		$values['lastName'] = $buddyValues['lastName'];	
		$values['email0'] = $buddyValues['email'];	
		$values['email1'] = $buddyValues['emailConfirm'];
		
		if(isset($buddyValues['tandem'])){
			if($buddyValues['tandem'] == 0){
				$values['tandem']['checkedTandem0'] = "checked";
				$values['tandem']['checkedTandem1'] = "";
			}
			if($buddyValues['tandem'] == 1){
				$values['tandem']['checkedTandem0'] = "";
				$values['tandem']['checkedTandem1'] = "checked";
			}
		}
		
		if(isset($buddyValues['buddyBefore'])){
			if($buddyValues['buddyBefore'] == 0){
				$values['buddyBefore']['checkedBuddy0'] = "checked";
				$values['buddyBefore']['checkedBuddy1'] = "";
			}
			if($buddyValues['buddyBefore'] == 1){
				$values['buddyBefore']['checkedBuddy0'] = "";
				$values['buddyBefore']['checkedBuddy1'] = "checked";
			}
		}
		
		return($values);
	}
	
	function getBuddyValues($buddy){
		$buddyValues = array();
		
		$buddyValues['id'] = $buddy->getId();
		$buddyValues['firstName'] = $buddy->getFirstName();
		$buddyValues['lastName'] = $buddy->getLastName();
		$buddyValues['email'] = $buddy->getEmail();
		$buddyValues['emailConfirm'] = $buddy->getEmail();
		$buddyValues['idPreferredCountryFirst'] = $buddy->getIdPreferredCountryFirst();
		$buddyValues['idPreferredCountrySecond'] = $buddy->getIdPreferredCountrySecond();
		$buddyValues['idPreferredCountryThird'] = $buddy->getIdPreferredCountryThird();
		$buddyValues['idStudy'] = $buddy->getIdStudy();
		$buddyValues['tandem'] = $buddy->getTandem();
		$buddyValues['preferredInfoEvening'] = $buddy->getPreferredInfoEvening();
		$buddyValues['buddyBefore'] = $buddy->getBuddyBefore();
		$buddyValues['dateAvailable'] = $buddy->getDateAvailable();
		return($buddyValues);
	}
	
	function validateForm(){
		$values = array();
			
		if(isset($_GET['validate'])){
			if($_GET['validate'] == "true"){
				$values['studiesSelected'] = $_POST['studySelect'];
				$values['countriesSelected1'] = $_POST['preferredCountry1'];	
				$values['countriesSelected2'] = $_POST['preferredCountry2'];
				$values['countriesSelected3'] = $_POST['preferredCountry3'];
				//$values['infoEveningsSelected'] = $_POST['infoEvenings'];
				$values['availableFromInput'] = $_POST['availableFromInput'];
				$values['firstName'] = $_POST['firstname'];
				$values['lastName'] = $_POST['lastname'];	
				$values['email0'] = $_POST['email'];	
				$values['email1'] = $_POST['emailConfirm'];
				
				if(isset($_POST['tandem'])){
					if($_POST['tandem'] == 0){
						$values['tandem']['checkedTandem0'] = "checked";
						$values['tandem']['checkedTandem1'] = "";
					}
					if($_POST['tandem'] == 1){
						$values['tandem']['checkedTandem0'] = "";
						$values['tandem']['checkedTandem1'] = "checked";
					}
				}
				
				if(isset($_POST['buddyBefore'])){
					if($_POST['buddyBefore'] == 0){
						$values['buddyBefore']['checkedBuddy0'] = "checked";
						$values['buddyBefore']['checkedBuddy1'] = "";
					}
					if($_POST['buddyBefore'] == 1){
						$values['buddyBefore']['checkedBuddy0'] = "";
						$values['buddyBefore']['checkedBuddy1'] = "checked";
					}
				}
	
				$values['error'] = validateInput();
				
				if($values['error'] == ""){
					if(updateBuddy() != TRUE){
						$values['action'] = $caller."?action=buddyLogin&validate=true&auth=".$_GET['auth'];
					}
					else{
						$values['update'] = "success";
					}
					
				
					//$mailer->composeConfirmationNewBuddy($buddy);
				}
			}
		}			
		
		return($values);
	}
	
	function getBuddy(){
		$BaseDAObuddy = new BaseDAObuddy();
		$buddy = $BaseDAObuddy->findByAuthHash($_GET['auth']);
		return($buddy);
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
			$error['studySelect'] = "Choose a study";
		}
		if(sizeof(explode("-",$_POST['availableFromInput'])) != 3){
			$error['availableFromInput'] = "Please enter a valid date";
		}
		
		if(sizeof($error) == 0){
			$error = "";
		}
	
		return($error);
	}
?>
