<?php
	echo "SERVER_NAME:    ".$_SERVER["SERVER_NAME"]."<br>";
	echo "PHP_SELF:       ".$_SERVER["PHP_SELF"]."<br>";
	echo "<br>";
	echo "test: http://".$_SERVER["SERVER_NAME"].dirname($_SERVER["PHP_SELF"])."/blablabla<br>";
	echo "<br>";
	echo "DOCUMENT_ROOT:  ".$_SERVER["DOCUMENT_ROOT"]."<br>";
	echo "REQUEST_URI:    ".$_SERVER["REQUEST_URI"]."<br>";
	echo "PATH_INFO:      ".$_SERVER["PATH_INFO"]."<br>";
	echo "ORIG_PATH_INFO: ".$_SERVER["ORIG_PATH_INFO"]."<br>";

	phpinfo();
?>
