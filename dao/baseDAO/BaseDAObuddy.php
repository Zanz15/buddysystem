<?php

/** 
 * @author martijn
 * 
 * 
 */
class BaseDAObuddy {
	
	
	
	function __construct() {
	}

	function delete($authHash){
		//$query = "DELETE from `buddy_buddy` WHERE authHash='".mysql_real_escape_string($authHash)."'";
		
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare("DELETE from buddy_buddy WHERE authHash=:authHash");
                $stm->bindParam(':authHash', $authHash, PDO::PARAM_STR);
                
                $resultInsert=$stm->execute();
                                
                
		//$resultInsert = mysql_query($query,$_SESSION['link']);
		//$_SESSION['session_id'] = mysql_insert_id($_SESSION['link']);
		
		if($resultInsert == TRUE){
//			print "Inserting data was successful";
		}
		else{
			print("database error while inserting buddy");
			//die("database error while inserting buddy: ". mysql_error());
                    
			return "false";
		}	
		
		return "true";		
		
	}	
	 
	/**
	 * @Param $type = buddy or incoming 
	 * @Param $mail = email address
	 * @return true = not in db    false = alreadz in db
	 */
	function checkEmail($type, $email) {
		if($type == 'buddy'){
			$query = "SELECT count(email) AS COUNT from buddy_buddy where email=:email";
		}
		if($type == 'incoming'){
			$query = "SELECT count(email) AS COUNT buddy_incoming where email=:email";
		}		
		
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare($query);
                $stm->bindParam(':email', $email, PDO::PARAM_STR);
                $stm->execute();
                
                //$result = $stm->execute(); -> wenn falsch, dann fehler mit query
                
                $row = $stm->fetch();

                if( $row['count'] == 0 ){
                    return TRUE;
                }
                		
		return FALSE;
	}
	
	function save($buddy) {
		$query = "INSERT INTO buddy_buddy
                    (firstName,
                    lastName,
                    email,
                    idPreferredCountryFirst,
                    idPreferredCountrySecond,
                    idPreferredCountryThird,
                    idStudy,
                    tandem,
                    preferredInfoEvening,
                    buddyBefore,
                    authHash,
                    locked,
                    dateAvailable,
                    mailed
              )VALUES(
                    :firstName,
                    :lastName,
                    :email,
                    :idPreferredCountryFirst,
                    :idPeferredCountrySecond,
                    :idPreferredCountryThird,
                    :idStudy,
                    :tandem,
                    :preferredInfoEvening,
                    :buddyBefore,
                    :authHash,
                    :locked,
                    :dateAvailable,
                    0
		)";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare($query);

                $stm->bindValue( ':firstName', $buddy->getFirstName(), PDO::PARAM_STR );
                $stm->bindValue( ':lastName', $buddy->getLastName(), PDO::PARAM_STR );
                $stm->bindValue( ':email', $buddy->getEmail(), PDO::PARAM_STR );
                $stm->bindValue( ':idPreferredCountryFirst', $buddy->getIdPreferredCountryFirst(), PDO::PARAM_INT );
                $stm->bindValue( ':idPeferredCountrySecond', $buddy->getIdPreferredCountrySecond(), PDO::PARAM_INT );
                $stm->bindValue( ':idPreferredCountryThird', $buddy->getIdPreferredCountryThird(), PDO::PARAM_INT );
                $stm->bindValue( ':idStudy', $buddy->getIdStudy(), PDO::PARAM_INT );
                $stm->bindValue( ':tandem', $buddy->getTandem(), PDO::PARAM_INT );
                $stm->bindValue( ':preferredInfoEvening', $buddy->getPreferredInfoEvening(), PDO::PARAM_INT );
                $stm->bindValue( ':buddyBefore', $buddy->getBuddyBefore(), PDO::PARAM_INT );
                $stm->bindValue( ':authHash', $buddy->getAuthHash(), PDO::PARAM_STR );
                $stm->bindValue( ':locked', $buddy->getBuddyBefore(), PDO::PARAM_INT );
                $stm->bindValue( ':dateAvailable', $buddy->getDateAvailable(), PDO::PARAM_STR );
                //$stm->bindValue( ':now', date( DateTime::RFC2822, time() ), PDO::PARAM_STR );
                
                //print $stm->debugDumpParams();                           
                
                $resultInsert = $stm->execute();
                
                
		//$resultInsert = mysql_query($query,$_SESSION['link']);
		//$_SESSION['session_id'] = mysql_insert_id($_SESSION['link']);
		
		if($resultInsert == TRUE){
//			print "Inserting data was successful";
                    return TRUE;
		}
		else{
			print("database error while inserting buddy");
//			die("database error while inserting buddy: ". mysql_error());
		}	
		
		return false;
	}
	
	function update($buddy) {
//		$val = array();
//		$val[0] = mysql_real_escape_string($buddy->getFirstName());
//		$val[1] = mysql_real_escape_string($buddy->getLastName());
//		$val[2] = mysql_real_escape_string($buddy->getEmail());
//		$val[3] = mysql_real_escape_string($buddy->getIdPreferredCountryFirst());
//		$val[4] = mysql_real_escape_string($buddy->getIdPreferredCountrySecond());
//		$val[5] = mysql_real_escape_string($buddy->getIdPreferredCountryThird());
//		$val[6] = mysql_real_escape_string($buddy->getIdStudy());
//		$val[7] = mysql_real_escape_string($buddy->getTandem());
//		$val[8] = mysql_real_escape_string($buddy->getPreferredInfoEvening());
//		$val[9] = mysql_real_escape_string($buddy->getBuddyBefore());
//		$val[10] = mysql_real_escape_string($buddy->getDateAvailable());
		
		//$query = "UPDATE `buddy_buddy` SET firstName='".$val[0]."',lastName='".$val[1]."',email='".$val[2]."',idPreferredCountryFirst='".$val[3]."',idPreferredCountrySecond='".$val[4]."',idPreferredCountryThird='".$val[5]."',idStudy='".$val[6]."',tandem='".$val[7]."',preferredInfoEvening='".$val[8]."',buddyBefore='".$val[9]."',dateAvailable='".$val[10]."',dateLogin=now() WHERE authHash='".mysql_real_escape_string($buddy->getAuthHash())."'";
                $query = "UPDATE buddy_buddy 
                    SET firstName=:firstName, 
                        lastName=:lastName, 
                        email=:email, 
                        idPreferredCountryFirst=:idPreferredCountryFirst, 
                        idPreferredCountrySecond=:idPreferredCountrySecond, 
                        idPreferredCountryThird=:idPreferredCountryThird, 
                        idStudy=:idStudy, 
                        preferredInfoEvening=:preferredInfoEvening, 
                        buddyBefore=:buddyBefore, 
                        dateAvailable=:dateAvailable, 

                    WHERE authHash=:authHash";
                
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare($query);
              
                
                $stm->bindValue( ':firstName', $buddy->getFirstName(), PDO::PARAM_STR );
                $stm->bindValue( ':lastName', $buddy->getLastName(), PDO::PARAM_STR );
                $stm->bindValue( ':email', $buddy->getEmail(), PDO::PARAM_STR );
                $stm->bindValue( ':idPreferredCountryFirst', $buddy->getIdPreferredCountryFirst(), PDO::PARAM_INT );
                $stm->bindValue( ':idPeferredCountrySecond', $buddy->getIdPreferredCountrySecond(), PDO::PARAM_INT );
                $stm->bindValue( ':idPreferredCountryThird', $buddy->getIdPreferredCountryThird(), PDO::PARAM_INT );
                $stm->bindValue( ':idStudy', $buddy->getIdStudy(), PDO::PARAM_INT );              
                $stm->bindValue( ':preferredInfoEvening', $buddy->getPreferredInfoEvening(), PDO::PARAM_INT );
                $stm->bindValue( ':buddyBefore', $buddy->getBuddyBefore(), PDO::PARAM_INT );
                $stm->bindValue( ':authHash', $buddy->getAuthHash(), PDO::PARAM_STR );
                $stm->bindValue( ':dateAvailable', $buddy->getDateAvailable(), PDO::PARAM_STR );
                //$stm->bindValue( 'dateLogin', date( DateTime::RFC2822, time() ), PDO::PARAM_STR );
                
		
                $resultInsert = $stm->execute();
                
                if($resultInsert == TRUE){
//			print "Inserting data was successful";
                    return TRUE;
		}
		else{
			print("database error while updating buddy");
//			die("database error while inserting buddy: ". mysql_error());
		}	
		
		return false;
                
//		$resultInsert = mysql_query($query,$_SESSION['link']);
//		$_SESSION['session_id'] = mysql_insert_id($_SESSION['link']);
//		
//		if($resultInsert == TRUE){
//			//print "Updating data was successful";
//		}
//		else{
//			//print("database error while updating group: ". mysql_error());
//			print("database error while updating group");
//			return FALSE;
//		}	
//		
//		return true;
	}

	function findById($id){
		$query = "select id,firstName,lastName,email,idPreferredCountryFirst,idPreferredCountrySecond,idPreferredCountryThird,idStudy,tandem,preferredInfoEvening,buddyBefore,dateAvailable,authHash,idGroup from buddy_buddy WHERE id=:id";
		
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare($query);
                
                $stm->bindValue( ':id', $id );
                
		$resultSelect = $stm->execute();

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			print "Fetching users database error";
			die;
//			die("Fetching users database error: ". mysql_error());
		}		

		$buddyRow = $stm->fetch();
		
		$buddy = new Buddy();
		$buddy->setId($buddyRow['id']);
		$buddy->setFirstName($buddyRow['firstName']);
		$buddy->setLastName($buddyRow['lastName']);
		$buddy->setEmail($buddyRow['email']);
		$buddy->setIdPreferredCountryFirst($buddyRow['idPreferredCountryFirst']);
		$buddy->setIdPreferredCountrySecond($buddyRow['idPreferredCountrySecond']);
		$buddy->setIdPreferredCountryThird($buddyRow['idPreferredCountryThird']);
		$buddy->setIdStudy($buddyRow['idStudy']);
		$buddy->setIdGroup($buddyRow['idGroup']);
		$buddy->setTandem($buddyRow['tandem']);
		$buddy->setPreferredInfoEvening($buddyRow['preferredInfoEvening']);
		$buddy->setBuddyBefore($buddyRow['buddyBefore']);
		$buddy->setAuthHash($buddyRow['authHash']);
		$buddy->setDateAvailable($buddyRow['dateAvailable']);
		$buddy->setDateLogin(date("Y-m-d H:i:s", time()));  //TODO: timestring in Konstante auslagern!

		if(empty($buddyRow['firstName']) && empty($buddyRow['lastName'])){
			return false;
		}
				
		return($buddy);
	}	
	
	function findMaxIdGroup(){
		$query = "select max(idGroup) from buddy_buddy";
		
		$resultSelect = mysql_query($query,$_SESSION['link']);

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			print "Fetching users database error";
			die;
//			die("Fetching users database error: ". mysql_error());
		}		
		
		$max = mysql_fetch_array($resultSelect);
		$maxIdGroup = (integer) $max[0];
		
//		var_export($maxIdGroup + 5) ;
//		die;
		return $maxIdGroup;
	}
	
	function findByAuthHash($authHash){
		$query = "select id,firstName,lastName,email,idPreferredCountryFirst,idPreferredCountrySecond,idPreferredCountryThird,idStudy,tandem,preferredInfoEvening,buddyBefore,dateAvailable,authHash,idGroup from buddy_buddy WHERE authHash=:authHash";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":authHash", $authHash );
                
		$resultSelect = $stm->execute();

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			print "Fetching users database error";
			die;
//	
		}		

		$buddyRow = $stm->fetch();
                        
		$buddy = new Buddy();
		$buddy->setId($buddyRow['id']);
		$buddy->setFirstName($buddyRow['firstName']);
		$buddy->setLastName($buddyRow['lastName']);
		$buddy->setEmail($buddyRow['email']);
		$buddy->setIdPreferredCountryFirst($buddyRow['idPreferredCountryFirst']);
		$buddy->setIdPreferredCountrySecond($buddyRow['idPreferredCountrySecond']);
		$buddy->setIdPreferredCountryThird($buddyRow['idPreferredCountryThird']);
		$buddy->setIdStudy($buddyRow['idStudy']);
		$buddy->setIdGroup($buddyRow['idGroup']);
		$buddy->setTandem($buddyRow['tandem']);
		$buddy->setPreferredInfoEvening($buddyRow['preferredInfoEvening']);
		$buddy->setBuddyBefore($buddyRow['buddyBefore']);
		$buddy->setAuthHash($buddyRow['authHash']);
		$buddy->setDateAvailable($buddyRow['dateAvailable']);
		$buddy->setDateLogin(date("Y-m-d H:i:s", time()));

		if(empty($buddyRow['firstName']) && empty($buddyRow['lastName'])){
			return false;
		}
				
		return($buddy);
	}
	
	function findByDateAvailable($dateAvailable){
		$query = "select id,firstName,lastName,email,idPreferredCountryFirst,idPreferredCountrySecond,idPreferredCountryThird,idStudy,tandem,preferredInfoEvening,buddyBefore,dateAvailable,authHash,idGroup from buddy_buddy WHERE locked='0' AND idGroup is NULL AND dateAvailable<=:dateAvailable";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":dateAvailable", $dateAvailable );
                
                
		$resultSelect = $stm->execute();

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			print "Fetching users database error";
			die;
		}		

		
		while ( $buddyRow = $stm->fetch() ) {
			$buddy = array();
			$buddy['id'] = (integer) $buddyRow[0];
			$buddy['firstName'] = $buddyRow[1];
			$buddy['lastName'] = $buddyRow[2];
			$buddy['email'] = $buddyRow[3];
			$buddy['idPreferredCountryFirst'] = (integer) $buddyRow[4];
			$buddy['idPreferredCountrySecond'] = (integer) $buddyRow[5];
			$buddy['idPreferredCountryThird'] = (integer) $buddyRow[6];
			$buddy['idStudy'] = (integer) $buddyRow[7];
			$buddy['dateAvailable'] = $buddyRow[11];
			$buddy['authHash'] = $buddyRow[12];
			$buddy['idGroup'] = (integer) $buddyRow[13];
			$buddy['type'] = "buddy";
//			$temp = $nationalityDAO->findById(14);
//			$buddy['country'] = $temp['country'];
//			unset($temp);
//			$temp = $studyDAO->findById($buddyRow[4]);
//			$buddy['study'] = $temp['study'];			
			
			$buddies[] = $buddy;
		}

		//var_export($buddies);
		if(!isset($buddies)){
			$buddies = array();
		}
		
		return($buddies);
	}	

	function updateGroupById($id,$idGroup){

		$query = "UPDATE `buddy_buddy` SET idGroup=:idGroup WHERE id=:id";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepeare( $query );
                $stm->bindValue( ":idGroup", $idGroup );
                $stm->bindValue( ":id", $id );
                
                $resultInsert = $stm->execute();
		
		if($resultInsert == TRUE){
//			print "Updating data was successful";
		}
		else{
			//print("database error while updating group: ". mysql_error());
			print("database error while updating incoming");
			return FALSE;
		}	
		return true;	
	}	
	
	function findByLocked($locked){
		$query = "select id,firstName,lastName,email,idPreferredCountryFirst,idPreferredCountrySecond,idPreferredCountryThird,idStudy,tandem,preferredInfoEvening,buddyBefore,dateAvailable,authHash,locked from buddy_buddy WHERE locked=:locked order by lastName asc";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue(":locked", $locked );
                
                $resultSelect = $stm->execute();
                
		//$resultSelect = mysql_query($query,$_SESSION['link']);

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			print "Fetching users database error";
			die;
//			die("Fetching users database error: ". mysql_error());
		}		

		while ( $row = $stm->fetch() ) {
                    $buddyTable = array();

		    $buddyTable['id'] = $row->id;
		    $buddyTable['hash'] = $row->authHash;
		    $buddyTable['firstName'] = $row->firstName;
		    $buddyTable['lastName'] = $row->lastName;
		    $buddyTable['email'] = $row->email;

			 $buddyRow['table'][] = $buddyTable;
		}
		if(!isset($buddyRow))
		{
			$buddyRow['table'] = '';
		}
		return($buddyRow);
	}
	
	function updateMailedById($id) {		
		
                $query = "UPDATE `buddy_buddy` SET mailed='1' WHERE id=:id";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue(":id", $id );
                
                
		$resultInsert = $stm->execute();
		//$_SESSION['session_id'] = mysql_insert_id($_SESSION['link']);
		
		if($resultInsert == TRUE){
			//print "Updating data was successful";
		}
		else{
			//print("database error while updating group: ". mysql_error());
			print("database error while updating group");
			return FALSE;
		}	
		
		return true;
	}		
	
	function updateUnlockByAuthhash($authHash) {		
		$query = "UPDATE `buddy_buddy` SET locked='0',buddyBefore='1' WHERE authHash=:authHash";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":authHash", $authHash );
                
                
                
		$resultInsert = $stm->execute();
		
		
		if($resultInsert == TRUE){
			//print "Updating data was successful";
		}
		else{
			//print("database error while updating group: ". mysql_error());
			print("database error while updating group");
			return FALSE;
		}	
		
		return true;
	}		
	
	function findByIdGroup($idGroup,$emailNot){
		if($emailNot == NULL){
			$emailNot = 29347982374892374832;
		}
		$emailNot=0;
		$query = "select id,firstName,lastName,email,idStudy,authHash,idGroup from buddy_buddy WHERE idGroup = :idGroup and email != :email ";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":idGroup", $idGroup );
                $stm->bindValue( ":email", $emailNot );
                
                
                
		$resultSelect = $stm->execute(); 
                
		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching users database error: " );
		}		

		$nationalityDAO = new BaseDAOnationality();
		$studyDAO = new BaseDAOstudy();
//		$country = $nationalityDAO->findById($idNationality);
		
		while ($buddyRow = $stm->fetch() ) {
			$buddy = array();
			$buddy['id'] = $buddyRow[0];
			$buddy['firstName'] = $buddyRow[1];
			$buddy['lastName'] = $buddyRow[2];
			$buddy['email'] = $buddyRow[3];
			$temp = $nationalityDAO->findById(14);
			$buddy['country'] = $temp['country'];
			unset($temp);
			$temp = $studyDAO->findById($buddyRow[4]);
			$buddy['study'] = $temp['study'];			
			$buddies[] = $buddy;
		}
			
		if(empty($buddies[0]['firstName']) && empty($buddies[0]['lastName'])){
			return false;
		}

//		var_export($buddies);
		return $buddies;
	}	
	
	function getAll() {
		$query = "select id,firstName,lastName,email,idStudy,dateAvailable,authHash,idGroup,locked from buddy_buddy";
		
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare($query);
                
		$resultSelect = $stm->execute();

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching users database error: ");
		}		

//		$nationalityDAO = new BaseDAOnationality();
		$studyDAO = new BaseDAOstudy();
//		$country = $nationalityDAO->findById($idNationality);
		
		while ( $buddyRow = $stm->fetch() ) {
			$buddy = array();
			$buddy['id'] = $buddyRow[0];
			$buddy['firstName'] = $buddyRow[1];
			$buddy['lastName'] = $buddyRow[2];
			$buddy['email'] = $buddyRow[3];
			$temp = $studyDAO->findById($buddyRow[4]);
			$buddy['study'] = $temp['study'];
			$buddy['dateAvailable'] = $buddyRow[5];
			$buddy['authHash'] = $buddyRow[6];
			$buddy['idGroup'] = $buddyRow[7];
			$buddy['locked'] = $buddyRow[8];

			$buddies[] = $buddy;
		}

		if(empty($buddies[0]['firstName']) && empty($buddies[0]['lastName'])){
			return false;
		}
		else return $buddies;
	}	
	
}

?>
