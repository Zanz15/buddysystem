<?php

/** 
 * @author martijn
 * 
 * 
 */
class BaseDAOincoming {
	
	function __construct() {
	
	}

	function delete($authHash){
                $query = "DELETE from `buddy_incoming` WHERE authHash=:authHash";
		$pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare( $query );
                $stm->bindValue( ":authHash", $authHash );
                
		$resultInsert = $stm->execute();
				
		if($resultInsert == TRUE){
//			print "Inserting data was successful";
                    return true;
		}
		else{
			print("database error while deleting buddy");
			return "false";
		}	
		
                return false;
		
	}	
	
	
	/**
	 * @Param $type = buddy or incoming 
	 * @Param $mail = email address
	 * @return true = not in db    false = alreadz in db
	 */
	function checkEmail($type, $email) {
                $pdo = $GLOBALS['pdo'];
                
            
		if($type == 'incoming'){
                        $query = "SELECT count(*) AS count from `buddy_incoming` where email=:email";
                        $stm = $pdo->prepare( $query );
                        $stm->bindValue( ":email", $email );
		}		
		
		$resultSelect = $stm->execute();
		
		if( $stm->fetch()->count > 0 ){
			return FALSE;
		}
		
		return TRUE;
	}	
	
	function save($incoming) {
		$query = "INSERT INTO `buddy_incoming` (firstName,lastName,email,idNationality,idStudy,authHash,locked,dateArrival,dateAdded) 
		VALUES( 
                    :firstName,
                    :lastName,
                    :email,
                    :idNationality,
                    :idStudy,
                    :authHash,
                    :locked,
                    :dateArrival,
                    :dateAdded
                )
                ";
                
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare( $query );
                $stm->bindValue( ":firstName", $incoming->getFirstName() );
                $stm->bindValue( ":lastName", $incoming->getLastName() );
                $stm->bindValue( ":email", $incoming->getEmail() );
                $stm->bindValue( ":idNationality", $incoming->getIdNationality() );
                $stm->bindValue( ":idStudy", $incoming->getIdStudy() );
                $stm->bindValue( ":authHash", $incoming->getAuthHash() );
                $stm->bindValue( ":locked", $incoming->getLocked() );
                $stm->bindValue( ":dateArrival", $incoming->getDateArrival() );
                $date = new DateTime();
                $stm->bindValue( ":dateAdded", $date->getTimestamp() );

		
		$resultInsert = $stm->execute();
		
		if($resultInsert == TRUE){
//			print "Inserting data was successful";
		}
		else{
			print("database error while inserting incoming");

		}	
		
		return true;
	}	

	function update($incoming) {

                $date = new DateTime();
                
		
                $query = "UPDATE `buddy_incoming` SET 
                        firstName=:firstName, 
                        lastName=:lastName,
                        email=:email,
                        preferredLanguage=:preferredLanguage,
                        idStudy=:idStudy,
                        idNationality=:idNationality,
                        dateArrival=:dateArrival,
                        dateLogin=:login 
                       WHERE authHash=:authHash";
		
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare( $query );
                $stm->bindValue( ":firstName", $incoming->getFirstName() );
                $stm->bindValue( ":lastName", $incoming->getLastName() );
                $stm->bindValue( ":email", $incoming->getEmail() );
                $stm->bindValue( ":idNationality", $incoming->getIdNationality() );
                $stm->bindValue( ":preferredLanguage", $incoming->getPreferredLanguage() );
                $stm->bindValue( ":idStudy", $incoming->getIdStudy() );
                $stm->bindValue( ":authHash", $incoming->getAuthHash() );
                $stm->bindValue( ":locked", $incoming->getLocked() );
                $stm->bindValue( ":dateArrival", $incoming->getDateArrival() );
                $stm->bindValue( "login", $date->getTimestamp() );
                
                
		$resultInsert = $stm->execute();

		
		if($resultInsert == TRUE){
//			print "Updating data was successful";
		}
		else{

			print("database error while updating incoming");
			return FALSE;
		}	
		
		return true;
	}		

	function updateGroupById($id,$idGroup){

	

		$query = "UPDATE `buddy_incoming` SET idGroup=:idGroup WHERE id=:id";
		$pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":idGroup", $idGroup );
                $stm->bindValue( ":id", $id );
                
                
                $resultInsert = $stm->execute();
		
		if($resultInsert == TRUE){
//			print "Updating data was successful";
		}
		else{

			print("database error while updating incoming");
			return FALSE;
		}	
		return true;	
	}

	function findById($id){
		$query = "select id,firstName,lastName,email,idNationality,idStudy,preferredLanguage,dateArrival,authHash,idGroup from buddy_incoming WHERE id=:id";
		$pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare( $query );
                $stm->bindValue( ":id", $id );
		
                $resultSelect = $stm->execute();
                $incomingRow = $stm->fetch();
                
		if($resultSelect == TRUE && $incomingRow != NULL ){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching users database error: ");
		}		

		$incoming = $this->setIncoming( $incomingRow );
		
		if(empty($incomingRow['firstName']) && empty($incomingRow['lastName'])){
			return false;
		}
		
		return($incoming);
	}	
	
        private function setIncoming( $incomingRow ){
            	$incoming = new Incoming();
		$incoming->setId($incomingRow['id']);
		$incoming->setFirstName($incomingRow['firstName']);
		$incoming->setLastName($incomingRow['lastName']);
		$incoming->setEmail($incomingRow['email']);
		$incoming->setIdNationality($incomingRow['idNationality']);
		$incoming->setIdStudy($incomingRow['idStudy']);
		$incoming->setPreferredLanguage($incomingRow['preferredLanguage']);
		$incoming->setAuthHash($incomingRow['authHash']);
		$incoming->setDateArrival($incomingRow['dateArrival']);
		$incoming->setDateLogin(date("Y-m-d H:i:s", time()));
		$incoming->setIdGroup($incomingRow['idGroup']);
                return $incoming;
        }
        
	function findByAuthHash($authHash){
		$query = "select id,firstName,lastName,email,idNationality,idStudy,preferredLanguage,dateArrival,authHash,idGroup from buddy_incoming WHERE authHash=:authHash";
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue(":authHash", $authHash );
		
		$resultSelect = $stm->execute();
                $incomingRow = $stm->fetch();

		if($resultSelect == TRUE && $incomingRow != NULL ){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching users database error: ");
		}		

		$incoming = $this->setIncoming( $incomingRow );

		
		if(empty($incomingRow['firstName']) && empty($incomingRow['lastName'])){
			return false;
		}
		
		return($incoming);
	}
		
	function findByIdGroup($idGroup,$emailNot){
		if($emailNot == NULL){
			$emailNot = 29347982374892374832;
		}
		$emailNot=0;
		$query = "select id,firstName,lastName,email,idNationality,idStudy,preferredLanguage,dateArrival,authHash,idGroup from buddy_incoming WHERE idGroup=:idGroup and email != :email ";
		
                $pdo = $GLOBAL['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue(":idGroup", $idGroup );
                $stm->bindValue(":email", $emailNot );
                
		$resultSelect = $stm->execute();

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching users database error: ");
		}		

		$nationalityDAO = new BaseDAOnationality();
		$studyDAO = new BaseDAOstudy();
//		$country = $nationalityDAO->findById($idNationality);
		
		while ($incomingRow =  $stm->fetch() ) {
			$incoming = array();
			$incoming['id'] = $incomingRow[0];
			$incoming['firstName'] = $incomingRow[1];
			$incoming['lastName'] = $incomingRow[2];
			$incoming['email'] = $incomingRow[3];
			$temp = $nationalityDAO->findById($incomingRow[4]);
			$incoming['country'] = $temp['country'];
			$temp = $studyDAO->findById($incomingRow[5]);
			$incoming['study'] = $temp['study'];			
			$incomings[] = $incoming;
		}
			
		if(empty($incomings[0]['firstName']) && empty($incomings[0]['lastName'])){
			return false;
		}

//		var_export($incomings);
		return $incomings;
	}
	
	function updateMailedById($id) {		
		$query = "UPDATE `buddy_incoming` SET mailed='1' WHERE id=:id";
		
                $pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":id", $id );
                
                
		$resultInsert = $stm->execute();
		
		if($resultInsert == TRUE){
			//print "Updating data was successful";
		}
		else{
			print("database error while updating group");
			return FALSE;
		}	
		
		return true;
	}	
	
	function findByDateArrival($dateArrival){
		$query = "select id,firstName,lastName,email,idNationality,idStudy,preferredLanguage,dateArrival,authHash,idGroup from buddy_incoming WHERE dateArrival<=:dateArrival and locked=0 and idGroup=0 and mailed=0";
		
		$pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                $stm->bindValue( ":dateArrival", $dateArrival );
                
                $resultSelect = $stm->execute();
                
		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching users database error: ");
		}		

		$nationalityDAO = new BaseDAOnationality();
		$studyDAO = new BaseDAOstudy();
//		$country = $nationalityDAO->findById($idNationality);
		
		while ($incomingRow = $stm->fetch() ) {
			$incoming = array();
			$incoming['id'] = (integer) $incomingRow[0];
			$incoming['firstName'] = $incomingRow[1];
			$incoming['lastName'] = $incomingRow[2];
			$incoming['email'] = $incomingRow[3];
			$incoming['country'] = (integer) $incomingRow[4];
			$incoming['idStudy'] = (integer) $incomingRow[5];
			$incoming['preferredLanguage'] = (integer) $incomingRow[6];
			$incoming['dateArrival'] = $incomingRow[7];
			$incoming['authHash'] = $incomingRow[8];
			$incoming['idGroup'] = (integer)$incomingRow[9];
			$incoming['type'] = "incoming";		
			$incomings[] = $incoming;
		}

		if(isset($incomings)){
			return $incomings;
		}
		else{
			$incomings = array();
		}
		//var_export($incomings);
		return $incomings;
	}

	function getAll(){
		$query = "select id,firstName,lastName,email,idNationality,idStudy,preferredLanguage,dateArrival,authHash,idGroup from buddy_incoming";
		
		$pdo = $GLOBALS['pdo'];
                $stm = $pdo->prepare( $query );
                
                $resultSelect = $stm->execute();

		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching users database error: ");
		}		

		$nationalityDAO = new BaseDAOnationality();
		$studyDAO = new BaseDAOstudy();
//		$country = $nationalityDAO->findById($idNationality);
		
		while ($incomingRow = $stm->fetch() ) {
			$incoming = array();
			$incoming['id'] = (integer) $incomingRow[0];
			$incoming['firstName'] = $incomingRow[1];
			$incoming['lastName'] = $incomingRow[2];
			$incoming['email'] = $incomingRow[3];

			$temp = $nationalityDAO->findById($incomingRow[4]);
			$incoming['country'] = $temp['country']; // (integer) $incomingRow[4];
			$temp = $studyDAO->findById($incomingRow[5]);
			$incoming['idStudy'] = $temp['study']; //(integer) $incomingRow[5];

			$incoming['preferredLanguage'] = (integer) $incomingRow[6];
			$incoming['dateArrival'] = $incomingRow[7];
			$incoming['authHash'] = $incomingRow[8];
			$incoming['idGroup'] = (integer)$incomingRow[9];
			$incoming['type'] = "incoming";

			$incomings[] = $incoming;
		}

		return isset($incomings) ? $incomings : array();
	}
		
}

?>
