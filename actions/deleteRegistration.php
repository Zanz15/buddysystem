<?php
	if (! isset ( $_GET ['auth'] ) && ! isset ( $_GET ['action'] )) {
		print ("auth error") ;
		die ();
	} elseif ( $_GET ['action'] == "deleteBuddy" && isset ( $_GET ['auth'] )) {
		$tosmarty = array();
		
		$toSmarty['delete'] = deleteBuddy();
		$toSmarty ['authHash'] = $_GET ['auth'];
	} elseif ( $_GET ['action'] == "deleteIncoming" && isset ( $_GET ['auth'] )) {
		$tosmarty = array();
		
		$toSmarty['delete'] = deleteIncoming();
		$toSmarty ['authHash'] = $_GET ['auth'];
	
	} else {
		die ();
	}
	
	
	if(isset($toSmarty['delete'])){
		$toSmarty['actionTpl'] = 'deleteSuccess.tpl';
		$smarty->assign( $toSmarty );
	}
	
	function deleteBuddy(){
		$status = "false";
		$BaseDAObuddy = new BaseDAObuddy();
		$status = $BaseDAObuddy->delete($_GET ['auth']);	
		return $status;
	}

	function deleteIncoming(){
		$status = "false";
		$BaseDAOincoming = new BaseDAOincoming();
		$status = $BaseDAOincoming->delete($_GET ['auth']);	
		return $status;
	}	
?>
