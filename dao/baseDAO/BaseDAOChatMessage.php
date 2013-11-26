<?php

/** 
 * @author martijn
 * 
 * 
 */
class BaseDAOChatMessage {
	
	function __construct() {
	
	}
	
	function saveMessage($message,$idGroup,$type,$idUser){

		
//		var_export($val);
		
		if($type == "buddy"){
			//$query = "INSERT INTO `buddy_chatMessages` (idGroup,message,idBuddy,dateSend,idIncoming) VALUES('".$val[1]."','".$val[0]."','".$val[3]."',now(),'0')";
                        $query = "INSERT INTO `buddy_chatMessages` (idGroup,message,idBuddy,dateSend,idIncoming) VALUES( :idGroup, :message, :idUser, :dateSend, '0')";
		}
		elseif($type == "incoming"){
			//$query = "INSERT INTO `buddy_chatMessages` (idGroup,message,idIncoming,dateSend,idBuddy) VALUES('".$val[1]."','".$val[0]."','".$val[3]."',now(),'0')";
                        $query = "INSERT INTO `buddy_chatMessages` (idGroup,message,idIncoming,dateSend,idBuddy) VALUES( :idGroup, :message, :idUser, :dateSend, '0')";
		}
		else{
			print "no buddy or incoming error. I die.";
			die;
		}
                
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":idGroup", $idGroup );
                $stm->bindValue( ":message", $message );
                $stm->bindValue( ":idUser", $idUser );
                $date = new DateTime();
                $stm->bindValue( ":dateSend", $date->getTimestamp() );
		
                $resultInsert = $stm->execute();
                
		//$resultInsert = mysql_query($query,$_SESSION['link']);
		//$_SESSION['session_id'] = mysql_insert_id($_SESSION['link']);
		
		if($resultInsert == TRUE){
//			print "Inserting data was successful";
                    return true;
		}
		else{
			print("database error while inserting buddy");
//			die("database error while inserting buddy: ". mysql_error());
		}	
		
		return false;		
	}
	
	function findByIdGroup($idGroup){
		//$query = "select idBuddy,idIncoming,message,dateSend from buddy_chatMessages WHERE idGroup='".mysql_real_escape_string($idGroup)."' ORDER BY id DESC";
                $query = "select idBuddy,idIncoming,message,dateSend from buddy_chatMessages WHERE idGroup=:idGroup ORDER BY id DESC";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":idGroup", $idGroup );
                
		$resultSelect = $stm->execute();

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching users database error: ". mysql_error());
		}		
		
		$buddyDAO = new BaseDAObuddy();
		$incomingDAO = new BaseDAOincoming();
		
		while ( $messageRow = $stm->fetch() ) {
			$message = array();
			$message['message'] = $messageRow["message"];
			if($messageRow[0] == 0){
				$temp = $incomingDAO->findById($messageRow["idIncoming"]);
			}
			elseif($messageRow[1] == 0){
				$temp = $buddyDAO->findById($messageRow["idBuddy"]);
			}
			else{
				print "messages corrupt, mail web-master";
				die;
			}
			
			if($temp != false){
				$name = $temp->getFirstName()." ".$temp->getLastName();
			}
			else{
				$name="";
			}
			$message['sender'] = $name;
                        $date = new DateTime();
			$message['date'] = $date->setTimestamp( $messageRow["dateSend"] );
			
			$messages[] = $message;
		}		
		
		if(!isset($messages)){
			$messages = array();
		}
		
		return $messages;
	}
	
}

?>
