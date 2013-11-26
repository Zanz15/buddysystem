<?php
	$toSmarty = array();
	
	//check for required vars
	if(!isset($_GET['auth'])){
		print("auth error");
		die;
	}
	//go straight to chat page without sending
	elseif(isset($_GET['auth'])){
		
		$chatUser = isBuddyOrIncoming();
		$idGroup = $chatUser['user']->getIdGroup();
		$BaseDAOChatMessage = new BaseDAOChatMessage();
		$messages = $BaseDAOChatMessage->findByIdGroup($idGroup);
		
		$toSmarty['messages'] = $messages;
		$toSmarty['authHash'] = $_GET['auth'];
	}
	//SAVE MESSAGE
//	elseif(isset($_GET['auth']) && isset($_POST['message'])){
//		echo "save: ".$_POST['message'];
//		$chatUser = isBuddyOrIncoming();
//
//		$idGroup = $chatUser['user']->getIdGroup();
//		$type = $chatUser['buddyOrIncoming'];
//		$idUser = $chatUser['user']->getId();
//		
//		$BaseDAOChatMessage = new BaseDAOChatMessage();
//		$success = $BaseDAOChatMessage->saveMessage($_POST['message'],$idGroup,$type,$idUser);
//		
//		$messages = $BaseDAOChatMessage->findByIdGroup($idGroup);
//		
//		$toSmarty['messages'] = $messages;
//		$toSmarty['authHash'] = $_GET['auth'];
//		var_export($toSmarty);		
//	}		
	else{
		die;
	}

//	var_export($chatUser);
	$toSmarty['authHash'] = $_REQUEST['auth'];
	$toSmarty['actionTpl'] = 'chat.tpl';
	$smarty->assign( $toSmarty );

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
?>
