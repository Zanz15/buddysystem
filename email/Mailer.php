<?php

/** 
 * @author martijn
 * 
 * 
 */
class Mailer {

	private $serverDir;

	function __construct() {
		$this->caller = "http://".$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI'];
		$this->caller = substr($this->caller, 0, strpos($this->caller, '?'));
		$this->mailFrom = ' My Buddysystem <noreply@example.com>';
	}
	
	function composeConfirmationBuddy($buddy, $smarty, $new)
	{
		$toSmarty['linkChangeData'] = $this->caller."?action=buddyLogin&auth=".$buddy->getAuthHash();
		$toSmarty['firstName'] = $buddy->getFirstName();
		$smarty->assign($toSmarty);

		$message = $smarty->fetch('mail_registered_buddy_'.($new ? 'new' : 'old').'.tpl');
		
		mail($buddy->getEmail(),'Buddysystem registration',$message, $this->getHeader());
	}
	
	function composeConfirmationNewIncoming($incoming, $smarty)
	{
		$toSmarty['linkChangeData'] = $this->caller."?action=incomingLogin&authIncoming=".$incoming->getAuthHash();
		$toSmarty['firstName'] = $incoming->getFirstName();
		$smarty->assign($toSmarty);

		$message = $smarty->fetch('mail_registered_incoming.tpl');

		mail($incoming->getEmail(),'Buddysystem registration',$message, $this->getHeader());
	}	

	function composeConfirmationNewGroup($person, $smarty)
	{
		$toSmarty['linkToChat'] = $this->caller."?action=groupChat&auth=".$person['authHash'];
		$toSmarty['firstName'] = $person['firstName'];
		$smarty->assign($toSmarty);

		$message = $smarty->fetch('mail_matched_'.($person['type']=='incoming' ? 'incoming' : 'buddy').'.tpl');

		mail($person['email'],'Buddysystem group confirmation',$message, $this->getHeader());
	}

	private function getHeader()
	{
		return
			'From: '.$this->mailFrom."\r\n"
			."Content-Type: text/plain; charset=\"UTF-8\"";
	}
	
}

?>
