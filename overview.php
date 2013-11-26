<?php

$actionMapping = array(
	'admin' => 'admin',
	'newBuddy' => 'newBuddy',
	'newIncoming' => 'newIncoming',
);

echo '<h1>Overview</h1>';

foreach ($actionMapping as $key => $value)
	echo '<a href="index.php?action='.$key.'">'.$value.'</a></br>';

?>
