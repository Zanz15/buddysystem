<?php
//echo "<pre>";

	$preferredLanguage = array(
					0 => "English",
					1 => "Deutsch");
				
	$toSmarty['usePreferredLanguage'] = $buddysys_prefLanguage;
	$toSmarty['preferredLanguage'] = $preferredLanguage;
	$toSmarty['preferredLanguageSelected'] = 0;	

	$toSmarty['dateArrivalInput'] = date("d-m-Y");"01-01-2001";
	
	$toSmarty['studies'] = getStudies();
	$toSmarty['studiesSelected'] = 0;
	
	$toSmarty['countries'] = getCountries();
	$toSmarty['countrySelected'] = 0;
	
	$toSmarty['firstName'] = "";
	$toSmarty['lastName'] = "";	
	$toSmarty['email0'] = "";	
	$toSmarty['email1'] = "";		
	$toSmarty['action'] = "";
	
	if(isset($_GET['validate'])){
		if($_GET['validate'] == "true"){
			$toSmarty['studiesSelected'] = $_POST['studySelect'];
			$toSmarty['countrySelected'] = $_POST['countrySelected'];	
			$toSmarty['dateArrivalInput'] = $_POST['dateArrivalInput'];
			$toSmarty['preferredLanguageSelected'] =
				isset($_POST['preferredLanguageSelected'])
				? $_POST['preferredLanguageSelected']
				: 0;
			$toSmarty['firstName'] = $_POST['firstname'];
			$toSmarty['lastName'] = $_POST['lastname'];	
			$toSmarty['email0'] = $_POST['email'];	
			$toSmarty['email1'] = $_POST['emailConfirm'];

			$toSmarty['error'] = validateInput();
			
			if($toSmarty['error'] == ""){
				$buddy = saveIncoming();
				$mailer = new Mailer();
				$mailer->composeConfirmationNewIncoming($buddy, $smarty);
				$toSmarty['action'] = "success";
	
			}
		}
	}	

function saveIncoming(){
	$incoming = new incoming();
	$incoming->setFirstName($_POST['firstname']);
	$incoming->setLastName($_POST['lastname']);
	$incoming->setEmail($_POST['email']);
	$incoming->setIdNationality($_POST['countrySelected']);
	$incoming->setIdStudy($_POST['studySelect']);
	$incoming->setPreferredLanguage(
		isset($_POST['preferredLanguageSelected'])
		? $_POST['preferredLanguageSelected']
		: 0);
	$incoming->setAuthHash(sha1(md5(rand()).md5($_POST['email'])));
	$incoming->setLocked(0);
	$dateArrival = explode("-",$_POST['dateArrivalInput']);
	$phpdate = mktime(0, 0, 0, $dateArrival[1], $dateArrival[0], $dateArrival[2]);
	$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
	$incoming->setDateArrival($mysqldate);
//	$buddy->set($_POST['']);
//	var_export($incoming);
//	die;
	$BaseDAOincoming = new BaseDAOincoming();
	$error = $BaseDAOincoming->save($incoming);
	return($incoming);
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
		
	    $BaseDAOincoming = new BaseDAOincoming();
		if(!$BaseDAOincoming->checkEmail("incoming", $_POST['email'])){
			$error['emailExists'] = "Your email address is already in use!!";
		}
	    
		if($_POST['studySelect'] == 0){
			$error['studySelect'] = "Select a study";
		}
		//if(sizeof(explode("-",$_POST['dateArrivalInput'])) != 3)
		//	$error['dateArrivalInput'] = "Please enter a valid date";

		$date2 = str_replace(array('.', '-'), '/', $_POST['dateArrivalInput']);
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
	
	if($toSmarty['action'] == "success"){
		$toSmarty['actionTpl'] = 'savedIncoming.tpl';
	}
	else{
		$toSmarty['actionTpl'] = 'newIncoming.tpl';
	}	
	$smarty->assign( $toSmarty );
	
	
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
