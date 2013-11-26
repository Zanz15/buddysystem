<?php
//	echo "<pre>";
	$toSmarty = array();
	
	//check for required vars
	if(!isset($_GET['auth']) && !isset($_GET['validate'])){
		print("auth error");
		die;
	}
	//check if vars are there. if messageSent is there, then save
	elseif(isset($_POST['message']) && isset($_GET['auth'])){
		
		$toSmarty['user'] = generateChatContent();
		
		$toSmarty['error'] = validateMessage();
		$toSmarty['authHash'] = $_GET['auth'];
		
//		echo "save: ".$_POST['message'];
		$chatUser = isBuddyOrIncoming();

		$idGroup = $chatUser['user']->getIdGroup();
		$type = $chatUser['buddyOrIncoming'];
		$idUser = $chatUser['user']->getId();
		
		$BaseDAOChatMessage = new BaseDAOChatMessage();
		$success = $BaseDAOChatMessage->saveMessage($_POST['message'],$idGroup,$type,$idUser);		
		
	}
	//go straight to chat page without sending
	elseif(isset($_GET['auth'])){
		
		$toSmarty['user'] = generateChatContent();
		$toSmarty['authHash'] = $_GET['auth'];
//		var_export($toSmarty);		
	}
	else{
		die;
	}

	$toSmarty['chat'] = "messageSent";
	
	
	if(isset($toSmarty['chat'])){
//		if($toSmarty['update'] == "success"){
			$toSmarty['actionTpl'] = 'groupChat.tpl';
//		}
	}
	$smarty->assign( $toSmarty );
	
	function validateMessage(){
//		echo "validate";
		return "";
	}
	
	function generateChatContent(){
		$toSmarty = array();
		
		$chatUser = isBuddyOrIncoming();
		
		if($chatUser != null){
			$toSmarty['buddyOrIncoming'] = $chatUser['buddyOrIncoming'];
//			var_export($chatUser);
		}
		else{
			echo "could not get user information";
			die;
		}
		
		$idNationality = $chatUser['user']->getIdNationality(); 
		$nationalityDAO = new BaseDAOnationality();
		$country = $nationalityDAO->findById($idNationality);

		$idStudy = $chatUser['user']->getIdStudy();  
		$studyDAO = new BaseDAOstudy();
		$study = $studyDAO->findById($idStudy);		
		
		$toSmarty['country'] = $country['country'];
		$toSmarty['study'] = $study['study'];
		$toSmarty['firstName'] = $chatUser['user']->getFirstName();
		$toSmarty['lastName'] = $chatUser['user']->getLastName(); 
		$toSmarty['email'] = $chatUser['user']->getEmail();
		
		$temp = getOthersOfGroup($chatUser['user']->getIdGroup(),$chatUser['user']->getEmail());

		$toSmarty['incomings'] = $temp['incomings'];
		$toSmarty['buddies'] = $temp['buddies'];
		
		return($toSmarty);
	}
	
	function saveMessage(){
//		echo "save: ".$_POST['message'];
		$chatUser = isBuddyOrIncoming();

		$idGroup = $chatUser['user']->getIdGroup();
		$type = $chatUser['buddyOrIncoming'];
		$idUser = $chatUser['user']->getId();
		
		$BaseDAOChatMessage = new BaseDAOChatMessage();
		$success = $BaseDAOChatMessage->saveMessage($_POST['message'],$idGroup,$type,$idUser);
		
		$messages = $BaseDAOChatMessage->findByIdGroup($idGroup);
		
		$toSmarty['messages'] = $messages;
		$toSmarty['authHash'] = $_GET['auth'];		
	}
	
	function isBuddyOrIncoming(){
		$chatUser['user'] = array();
		$chatUser['user'] = getIncoming();
		
		if($chatUser['user'] == false){
			$chatUser['user'] = array();
			$chatUser['user'] = getBuddy();
		}
		else{
			$chatUser['buddyOrIncoming'] = "incoming";
			return $chatUser;
		}
		if($chatUser['user'] == false){
			return null;
		}
		else{
			$chatUser['buddyOrIncoming'] = "buddy";
			return $chatUser;
		}		
	}
	
	function getOthersOfGroup($idGroup,$emailNot){
		$BaseDAOincoming = new BaseDAOincoming();
		$incomings = $BaseDAOincoming->findByIdGroup($idGroup,$emailNot);
		
		$BaseDAObuddy = new BaseDAObuddy();
		$buddies = $BaseDAObuddy->findByIdGroup($idGroup,$emailNot);
		
		$toSmarty['incomings'] = $incomings;
		$toSmarty['buddies'] = $buddies;
		
		return $toSmarty;
	}
	
	function getIncoming(){
		$BaseDAOincoming = new BaseDAOincoming();
		$incoming = $BaseDAOincoming->findByAuthHash($_GET['auth']);
		return($incoming);
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
	

	
?>
