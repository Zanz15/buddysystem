<?php
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR;

        $pdo = new PDO( 'sqlite:buddysystem.sqlite' );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $GLOBALS['pdo'] = $pdo;
        
        date_default_timezone_set("Europe/Vienna");
        
        
        $mode = getenv('buddysystem_mode');
        if( $mode == "test" ){
            
            
            
        }else{
            
        }


	// db config
	$buddysys_db_location = 'localhost';
	$buddysys_db_name = 'my_buddysystem_db';
	$buddysys_db_user = 'my_mysql_user';
	$buddysys_db_pass = 'my_mysql_pass';
	$buddysys_db_prefix = 'buddy';
	
	// buddysys config
	$GLOBALS['buddysys_header'] = false;
	$GLOBALS['buddysys_use_tandem'] = false;
	// -- buddysys locking --
	// 0 all buddies unlocked
	// 1 all buddies locked
	// 2 unlocked if was buddy before
	$GLOBALS['buddysys_locking'] = 2;
	/*$buddysys_dates = array(
		'Orientation week 1' => '28-8-2011',
		'Orientation week 2' => '02-10-2011',
		'Orientation week 3' => '01-01-2011'
	);*/
	$GLOBALS['buddysys_prefLanguage'] = false;

        $buddysys_baseUrl = "http://localhost:8000/";
        
	//$buddysys_baseUrl = "http://www.example.com/buddysystem/";

	// smarty config
	$smarty_template_dir = 'actions/templates';
	$smarty_config_dir   = 'libs/smarty-configs';
	$smarty_compile_dir  = 'files/smarty-templates_c';
	$smarty_cache_dir    = 'files/smarty-cache';

	//$buddysys_db_buddy       = $buddysys_db_prefix . "_buddy";
	//$buddysys_db_chatMsgs    = $buddysys_db_prefix . "_chatMessages";
	//$buddysys_db_incoming    = $buddysys_db_prefix . "_incoming";
	//$buddysys_db_nationality = $buddysys_db_prefix . "_nationality";
	//$buddysys_db_study       = $buddysys_db_prefix . "_study";
	//$buddysys_db_accounts    = $buddysys_db_prefix . "_accounts";
        
        //path replace to be windows compatible
        $smarty_template_dir = $file . str_replace( "/", DIRECTORY_SEPARATOR, $smarty_template_dir );
        $smarty_config_dir = $file . str_replace( "/", DIRECTORY_SEPARATOR, $smarty_config_dir );
        $smarty_compile_dir = $file . str_replace( "/", DIRECTORY_SEPARATOR, $smarty_compile_dir );
        $smarty_cache_dir = $file . str_replace( "/", DIRECTORY_SEPARATOR, $smarty_cache_dir );
        
?>
