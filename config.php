<?php

try {
	
		$db = new PDO('mysql:host=localhost;dbname=siteweb','root','',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
	
} catch(PDOException $e) {
	
	echo 'fail';
	exit();
	
}


?>
