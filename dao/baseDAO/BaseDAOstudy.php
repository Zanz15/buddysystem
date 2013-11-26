<?php

class BaseDAOstudy {

                
	function __construct() {

            
	}
	
	function findAll(){
		$pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare("select id,study from buddy_study order by study");
                $stm->execute();
                //$result = $stmt->execute();
                               

//		if($res == TRUE){
//			//print "Fetching data was successful";
//		}
//		else{
//			//die("Fetching groups database error: ". mysql_error());
//		}		

		$studies[0] = "select...";
		
		while( $row = $stm->fetch( PDO::FETCH_OBJ ) ){

		    $studies[$row->id] = $row->study;
		}
		return($studies);		
	}
	
	function findById($id){
		$query = "select id,study from buddy_study WHERE id=:id";
                
                $pdo = $GLOBALS['pdo'];
                $stm=$pdo->prepare($query);
                $stm->bindValue(":id", $id );
		$resultSelect = $stm->execute();
		if($resultSelect == TRUE){
			//print "Fetching data was successful";
		}
		else{
			die("Fetching nationality error");
		}		

		$incomingRow = $stm->fetch();
		//var_export($incomingRow);
		$study = array();
		$study['id'] = $incomingRow['id'];
		$study['study'] = $incomingRow['study'];
		
		return($study);		
	}		
	
}

?>