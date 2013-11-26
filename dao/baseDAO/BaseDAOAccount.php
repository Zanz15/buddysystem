<?php

/** 
 * @author martijn
 * 
 * 
 */
class BaseDAOAccount {
	
	function __construct() {
	
	}
	
	function findByUsername($userName){
		$account = new Account();
		
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare("select id,vorname,nachname,email,username,PASSWORD from accounts WHERE username=:username");                
                $stm->bindParam('username', $userName );
                		
                $stm->execute();
                $accountRow = $stm->fetch();
                
                if( ! $accountRow ){
                    //die("ERROR: Fetching users from database...");  //fail silently to avoid exposing information about the existence of a username!
                }
                
                
		//$accountRow = mysql_fetch_array($resultSelect);
		
		$account->setId($accountRow['id']);
		$account->setFirstName($accountRow['vorname']);
		$account->setLastName($accountRow['nachname']);
		$account->setEmail($accountRow['email']);
		$account->setUserName($accountRow['username']);
		$account->setPassword($accountRow['PASSWORD']);
		
		
		return $account;
	}
	
}

?>