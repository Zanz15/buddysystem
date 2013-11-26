<?php

$actionMapping = array(
	'admin' => 'Admin.php',
	'newBuddy' => 'newBuddy.php',
	'buddyLogin' => 'buddyLogin.php',
	'newIncoming' => 'newIncoming.php',
	'incomingLogin' => 'incomingLogin.php',
	'groupChat' => 'groupChat.php',
	'chat' => 'chat.php',
	'deleteBuddy' => 'deleteRegistration.php',
	'deleteIncoming' => 'deleteRegistration.php'
);

// default page
$page = 'newBuddy.php';

if(!isset($_SESSION)){
	session_start(); 
}

require_once('config.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
	
//require SMARTY
require('libs/smarty/Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = $smarty_template_dir;
$smarty->compile_dir = $smarty_compile_dir;
$smarty->cache_dir = $smarty_cache_dir;
$smarty->config_dir = $smarty_config_dir;

$smarty->assign('buddysys_baseUrl', $buddysys_baseUrl);

require_once('dao/mysql.php');

require_once('dao/model/Account.php');
require_once('dao/model/Buddy.php');
require_once('dao/model/Group.php');
require_once('dao/model/Incoming.php');
require_once('dao/model/Nationality.php');
require_once('dao/model/Study.php');
require_once('dao/model/ChatMessage.php');
	
require_once('dao/baseDAO/BaseDAOAccount.php');
require_once('dao/baseDAO/BaseDAObuddy.php');
require_once('dao/baseDAO/BaseDAOgroup.php');
require_once('dao/baseDAO/BaseDAOincoming.php');
require_once('dao/baseDAO/BaseDAOnationality.php');
require_once('dao/baseDAO/BaseDAOstudy.php');
require_once('dao/baseDAO/BaseDAOChatMessage.php');
	
include('email/EmailAddressValidator.php');
include('email/Mailer.php');

// open the right action
$caller = basename($_SERVER['REQUEST_URI']);
$caller = substr($caller, 0, strpos($caller, '?'));
$smarty->assign('caller', $caller);

if(isset($_GET['action'])) {
	$action = $_GET['action'];

	if(array_key_exists($action, $actionMapping))
		$page = $actionMapping[$action];
}

include('actions/'.$page);
$smarty->assign('buddysys_header', $buddysys_header);
$smarty->display('index.tpl');

?>
