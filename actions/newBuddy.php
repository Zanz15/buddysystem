<?php
	if(isset($buddysys_dates))
		$toSmarty['infoEvenings'] = $buddysys_dates;
	else $toSmarty['infoEvenings'] = array();
	$toSmarty['infoEveningsSelected'] = 0;	

	$toSmarty['availableFromInput'] = date("d-m-Y");
	
	$toSmarty['studies'] = getStudies();
	$toSmarty['studiesSelected'] = 0;
	
	$toSmarty['countries'] = getCountries();
	$toSmarty['countriesSelected1'] = 0;	
	$toSmarty['countriesSelected2'] = 0;
	$toSmarty['countriesSelected3'] = 0;
	
	$toSmarty['tandem']['checkedTandem0'] = "checked";
	$toSmarty['tandem']['checkedTandem1'] = "";
	
	$toSmarty['buddyBefore']['checkedBuddy0'] = "checked";
	$toSmarty['buddyBefore']['checkedBuddy1'] = "";
	
	$toSmarty['firstName'] = "";
	$toSmarty['lastName'] = "";
	$toSmarty['email0'] = "";
	$toSmarty['email1'] = "";
	$toSmarty['action'] = "";

	$toSmarty['use_tandem'] = $buddysys_use_tandem;
	$toSmarty['use_ask_past'] = $buddysys_locking == 2 ? true : false;
	
	if(isset($_GET['validate'])){
		if($_GET['validate'] == "true"){
			$toSmarty['studiesSelected'] = $_POST['studySelect'];
			$toSmarty['countriesSelected1'] = $_POST['preferredCountry1'];	
			$toSmarty['countriesSelected2'] = $_POST['preferredCountry2'];
			$toSmarty['countriesSelected3'] = $_POST['preferredCountry3'];
			$toSmarty['infoEveningsSelected'] = 0;
			$toSmarty['availableFromInput'] = $_POST['availableFromInput'];
			$toSmarty['firstName'] = $_POST['firstname'];
			$toSmarty['lastName'] = $_POST['lastname'];	
			$toSmarty['email0'] = $_POST['email'];	
			$toSmarty['email1'] = $_POST['emailConfirm'];
			
			if(isset($_POST['tandem'])){
				if($_POST['tandem'] == 0){
					$toSmarty['tandem']['checkedTandem0'] = "checked";
				}
				if($_POST['tandem'] == 1){
					$toSmarty['tandem']['checkedTandem1'] = "checked";
					$toSmarty['tandem']['checkedTandem0'] = "";
				}
			}
			
			if(isset($_POST['buddyBefore'])){
				if($_POST['buddyBefore'] == 0){
					$toSmarty['buddyBefore']['checkedBuddy0'] = "checked";
				}
				if($_POST['buddyBefore'] == 1){
					$toSmarty['buddyBefore']['checkedBuddy1'] = "checked";
					$toSmarty['buddyBefore']['checkedBuddy0'] = "";
				}
			}

			$toSmarty['error'] = validateInput();
			
			if($toSmarty['error'] == ""){
				$buddy = saveBuddy();
				$mailer = new Mailer();
				$mailer->composeConfirmationBuddy($buddy, $smarty, ! $_POST['buddyBefore']);
				$toSmarty['action'] = "success";
			}
		}
	}
	
	if($toSmarty['action'] == "success"){
		$toSmarty['actionTpl'] = 'savedBuddy.tpl';
	}
	else{
		$toSmarty['actionTpl'] = 'newBuddy.tpl';
	}
	
	$smarty->assign( $toSmarty );
	
function saveBuddy(){
	global $buddysys_use_tandem;
	global $buddysys_locking;

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
	$buddy->setAuthHash(md5(rand()).md5($_POST['email']));
	switch ($buddysys_locking) {
		case 0:
			$buddy->setLocked(0);
			break;
		case 1:
			$buddy->setLocked(1);
			break;
		default:
			$buddy->setLocked($_POST['buddyBefore'] == 0 ? 1 : 0);
	}

	$buddy->setIdNationality(0);
	$available = explode("-",$_POST['availableFromInput']);
	$phpdate = mktime(0, 0, 0, $available[1], $available[0], $available[2]);
	$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
	$buddy->setDateAvailable($mysqldate);
//	$buddy->set($_POST['']);
//	var_export($buddy);

	$BaseDAObuddy = new BaseDAObuddy();
	$error = $BaseDAObuddy->save($buddy);
	return($buddy);
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
	
    $BaseDAObuddy = new BaseDAObuddy();
	if(!$BaseDAObuddy->checkEmail("buddy", $_POST['email'])){
		$error['emailExists'] = "Your email address is already in use!!";
	}
    
	if($_POST['studySelect'] == 0){
		$error['studySelect'] = "Choose a study";
	}

	$date2 = str_replace(array('.', '-'), '/', $_POST['availableFromInput']);
	$date = explode('/',$date2);

	if( (sizeof($date) != 3)
		|| !preg_match('/^[0-9]+$/', $date[0])
		|| !preg_match('/^[0-9]+$/', $date[1])
		|| !preg_match('/^[0-9]+$/', $date[2])
		|| !checkdate($date[1], $date[0], $date[2]))
		$error['availableFromInput'] = "Please enter a valid date";
	
	if(sizeof($error) == 0)
		$error = "";

	return($error);
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
