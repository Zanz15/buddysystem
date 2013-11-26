<?php
	include('config.php');
	
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        
	echo "Setting up..</br></br>";
	echo __FILE__ . "</br>";
        echo $file . "</br>";
        echo $file . $smarty_config_dir  . "</br>";
        echo realpath( $file ) . "</br>";
        
        
        
        
	checkDir( $smarty_config_dir  );
	checkDir( $smarty_template_dir  );
	
	checkAndCreateDir( realpath( $smarty_cache_dir) );
	checkAndCreateDir( realpath( $smarty_compile_dir) );

//	$con = checkDB(
//		$buddysys_db_location,
//		$buddysys_db_name,
//		$buddysys_db_user,
//		$buddysys_db_pass);
        
        $con = $_SESSION['pdo'];

	if($con)
	{
		checkTable($buddysys_db_buddy);
		checkTable($buddysys_db_chatMsgs);
		checkTable($buddysys_db_incoming);
		checkTable($buddysys_db_nationality);
		checkTable($buddysys_db_study);
		checkTable($buddysys_db_accounts);
	}
	mysql_close($con);


	// ------ helper functions ------

	function checkDir($dirName)
	{
		echo "checking $dirName ";
		if (file_exists($dirName))
			echo 'ok';
		else echo 'MISSING';
		echo '</br>';
	}
	function checkAndCreateDir($dirName)
	{
		echo "checking $dirName ";
		if (file_exists($dirName))
		{
			if (is_writable($dirName))
				echo 'ok';
			else echo 'NOT WRITABLE!!';
		}
		else
		{
			mkdir($dirName);
			echo 'created!!';
		}
		echo '</br>';
	}

	function checkDB($location, $db, $user, $pass)
	{
		echo '</br>connect to db: ';
		echo "$user @ $db @ $location ";

		$connection = mysql_connect($location, $user, $pass);

		if (!$connection)
			echo "COULDN'T CONNECT TO SERVER: " . mysql_error();
		else
		{
			if(!mysql_selectdb($db))
				echo "COULDN'T CONNECT TO DB: " . mysql_error();
			else echo 'ok</br>';
		}
		return $connection;
	}

	function checkTable($dbName)
	{
		echo "checking $dbName ";
                $pdo = $_SESSION['pdo'];
		if( $pdo->query("SELECT * FROM " . $dbName ) )
		{
			echo "ok</br>";
		} else echo "OH NO!</br>";
		
	}
?>
