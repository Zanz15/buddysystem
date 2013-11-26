<?php

include 'dao/Buddymatching.php';

$admin = new Admin();
$admin->getPage($smarty);

class Admin {
	public $toSmarty;

	const stateNull	= 0;
	const stateLogout= 1;
	const stateLogin	= 2;
	const stateError	= 3;
	const stateUnlockBuddyOverview = 4;
	const stateUnlockBuddy = 5;
	const stateMatchingSys = 6;
	const stateMatchingSysOptions = 7;
	const stateMatchingSysSaveGroups = 8;
	const stateMatchingSysMailGroups = 9;
	const stateBuddyList = 10;
	const stateIncomingsList = 11;

	public function getPage($smarty)
	{
		$state = $this->getState();
               
		switch($state) {
			// Login
			case Admin::stateLogin:
				$_SESSION['authenticated'] = TRUE;
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			// List buddies
			case Admin::stateBuddyList:
				$baseDAObuddy = new BaseDAOBuddy();
				$this->toSmarty['buddyArray'] = $baseDAObuddy->getAll();
				$this->toSmarty['tableSelect'] = "listBuddies";
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			// List incomings
			case Admin::stateIncomingsList:
				$baseDAOincoming = new BaseDAOincoming(); 
				$this->toSmarty['incomingArray'] = $baseDAOincoming->getAll();
				$this->toSmarty['tableSelect'] = "listIncomings";
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			// Unlock buddy
			case Admin::stateUnlockBuddyOverview:
				$baseDAObuddy = new BaseDAOBuddy();
				$this->toSmarty['buddyArray'] = $baseDAObuddy->findByLocked(1);
				$this->toSmarty['tableSelect'] = "buddyUnlock";
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			case Admin::stateUnlockBuddy:
				$baseDAObuddy = new BaseDAOBuddy();
				$baseDAObuddy->updateUnlockByAuthhash($_REQUEST['unlockByHash']);
				$this->toSmarty['buddyArray'] = $baseDAObuddy->findByLocked(1);
				$this->toSmarty['tableSelect'] = "buddyUnlock";
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			// Matching system
			case Admin::stateMatchingSys:
				$this->toSmarty['buddySystem']['numberBuddies'] = 2;
				$this->toSmarty['buddySystem']['numberIncomings'] = 3;
				$this->toSmarty['buddySystem']['dateAvailable'] = Date('d-m-Y');
				$this->toSmarty['tableSelect'] = 'matchingSystem';
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			case Admin::stateMatchingSysOptions:
				if( isset($_REQUEST['dateAvailable']) && ($_REQUEST['dateAvailable'] != '')
					&& isset($_REQUEST['numberBuddies']) && isset($_REQUEST['numberIncomings']))
				{
					$buddySystem =	$this->getMatches(
							$_REQUEST['dateAvailable'],
							$_REQUEST['numberBuddies'],
							$_REQUEST['numberIncomings']);
					$this->toSmarty['buddySystem'] = $buddySystem;
					$_SESSION['buddySystem']['groups'] = $buddySystem['groups'];

					$this->toSmarty['buddySystem']['dateAvailable'] = $_REQUEST['dateAvailable'];
					$this->toSmarty['buddySystem']['numberBuddies'] = $_REQUEST['numberBuddies'];
					$this->toSmarty['buddySystem']['numberIncomings'] = $_REQUEST['numberIncomings'];
					
					$_SESSION['buddySystem']['dateAvailable'] = $_REQUEST['dateAvailable'];
					$_SESSION['buddySystem']['numberBuddies'] = $_REQUEST['numberBuddies'];
					$_SESSION['buddySystem']['numberIncomings'] = $_REQUEST['numberIncomings'];

					$baseDAOnations = new BaseDAOnationality();
					$this->toSmarty['nations'] = $baseDAOnations->findAll();
					$this->toSmarty['buddySystem']['buddies'] =
						count($this->toSmarty['buddySystem']['buddyArray']);
					$this->toSmarty['buddySystem']['incomings'] =
						count($this->toSmarty['buddySystem']['incomingArray']);
					$this->toSmarty['stage'] = 'options';
				}

				$this->toSmarty['tableSelect'] = 'matchingSystem';
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			case Admin::stateMatchingSysSaveGroups:
				$this->saveGroups($_SESSION['buddySystem']['groups']);

				$this->toSmarty['buddySystem']['dateAvailable'] =
					$_SESSION['buddySystem']['dateAvailable'];
				$this->toSmarty['buddySystem']['numberBuddies'] =
					$_SESSION['buddySystem']['numberBuddies'];
				$this->toSmarty['buddySystem']['numberIncomings'] =
					$_SESSION['buddySystem']['numberIncomings'];

				$this->toSmarty['tableSelect'] = 'matchingSystem';
				$this->toSmarty['stage'] = 'saveGroups';
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			case Admin::stateMatchingSysMailGroups:
				$this->mailGroups($_SESSION['buddySystem']['groups'], $smarty);

				$this->toSmarty['tableSelect'] = 'matchingSystem';
				$this->toSmarty['stage'] = 'mailGroups';
				$this->toSmarty['actionTpl'] = 'admin.tpl';
				break;
			// Logout
			case Admin::stateLogout:
				$_SESSION['authenticated'] = FALSE;
				//unset($_SESSION['userdata']);
				$this->toSmarty['actionTpl'] = 'login.tpl';
				break;
			// Error
			case Admin::stateError:
				$this->toSmarty['error']['errorLogin'] =
					"Error logging in... please try again.";
				$this->toSmarty['actionTpl'] = 'login.tpl';
				break;

			default:
				$this->toSmarty['actionTpl'] = 'login.tpl';
				break;
		}

		$smarty->assign($this->toSmarty);
		//return smarty-admin-site;
	}

	private function getState()
	{
		$state = Admin::stateNull;

		if( isset($_REQUEST['logout']) && $_REQUEST['logout'] )
		{ $state = Admin::stateLogout; }
		elseif( isset($_REQUEST['username']) ) {
			// check password
			$baseDAOAccount = new BaseDAOAccount();
			$account = $baseDAOAccount->findByUsername($_REQUEST['username']);
			
			$state =
				( isset($_REQUEST['password']) && $_REQUEST['password'] == $account->getPassword() )
				? Admin::stateLogin : Admin::stateError;
		}
		elseif( isset($_SESSION['authenticated']) && $_SESSION['authenticated'])
		{
			if( isset($_REQUEST['actionAdmin']) ) {
				switch($_REQUEST['actionAdmin'])
				{
					case 'buddyList':
						$state = Admin::stateBuddyList;
						break;
					case 'incomingList':
						$state = Admin::stateIncomingsList;
						break;
					case 'buddyUnlock':
						$state = (isset($_REQUEST['unlockByHash']))
							? Admin::stateUnlockBuddy : Admin::stateUnlockBuddyOverview;
						break;
					case 'matchingSystem':
						$state = Admin::stateMatchingSys;
						if( isset($_REQUEST['stage']) )
						{
							if($_REQUEST['stage'] == 'options')
								$state = Admin::stateMatchingSysOptions;
							if($_REQUEST['stage'] == 'saveGroups')
								$state = Admin::stateMatchingSysSaveGroups;
							elseif($_REQUEST['stage'] == 'mailGroups')
								$state = Admin::stateMatchingSysMailGroups;
						}
						break;
				}
			}
		}
		return $state;
	}

/*	private function unlockBuddy($unlockHash)
	{
		$baseDAObuddy = new BaseDAOBuddy();
		$baseDAObuddy->updateUnlockByAuthhash($unlockHash);
	}

	private function overviewBuddyToUnlock()
	{
		$baseDAObuddy = new BaseDAOBuddy();
		return $baseDAObuddy->findByLocked(1);
	}
*/
	private function getMatches($date, $numBuddies, $numIncomings)
	{
		$dateTemp = explode("-", $date);
		$dateAvailable = $dateTemp[2].$dateTemp[1].$dateTemp[0];

		// get all buddies and incomings
		$baseDAObuddy = new BaseDAOBuddy(); 
		$buddyArray = $baseDAObuddy->findByDateAvailable($dateAvailable);
		$baseDAOincoming = new BaseDAOincoming(); 
		$incomingArray = $baseDAOincoming->findByDateArrival($dateAvailable);		
		
		// match ppl
		$matchingSystem = new Buddymatching($buddyArray, $incomingArray);
		$matchIds = $matchingSystem->match($numBuddies, $numIncomings);
		$matches = $matchingSystem->idsToObjects($matchIds['incomings'], $matchIds['buddies']);
	
		return array(
			'groups' => $matches['groups'],
			'buddiesMatched' => count($matchIds['buddies']['matches']),
			'incomingsMatched' => count($matchIds['incomings']['matches']),
			'buddyArray' => $buddyArray,
			'incomingArray' => $incomingArray,
			'statistics' => array(
				'incomings' => $matchIds['incomings']['statistics'],
				'buddies' => $matchIds['buddies']['statistics'])
		);
	}

	private function saveGroups($groups)
	{
		$baseDAObuddy = new BaseDAOBuddy();
		$baseDAOincoming = new BaseDAOincoming();
		$maxGroupId = 1 + $baseDAObuddy->findMaxIdGroup();

		if(is_null($groups)) return;

		foreach( $groups as $mainGroup )
		{
			foreach( $mainGroup as $person )
			{
				if($person['type'] == "buddy"){
					$baseDAObuddy->updateGroupById($person['id'], $person['idGroup'] + $maxGroupId);
				}
				elseif($person['type'] == "incoming"){
					$baseDAOincoming->updateGroupById($person['id'], $person['idGroup'] + $maxGroupId);
				}
			}
		}
	}

	private function mailGroups($groups, $smarty)
	{
		$baseDAObuddy = new BaseDAOBuddy();
		$baseDAOincoming = new BaseDAOincoming();
		$mailer = new Mailer();
		
		foreach( $groups as $mainGroup ) {
			foreach( $mainGroup as $person )
			{
				$mailer->composeConfirmationNewGroup($person, $smarty);
				if($person['type'] == "buddy"){
					$baseDAObuddy->updateMailedById($person['id']);
				}
				elseif($person['type'] == "incoming"){
					$baseDAOincoming->updateMailedById($person['id']);
				}	
				usleep(300000);
				echo "<pre>";	
				print "\n mailed to: ".$person['id']." email: ".$person['email'];
			}
		}
	}


}

?>
