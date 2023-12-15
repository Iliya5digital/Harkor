<?php
	
	$DB_NAME = 'DBNAME'; // BDD NAME
	$DB_USER = 'DBUSER'; // MySQL USER
	$DB_PASSWORD = 'PASS'; // MySQL PASSWORD
	$DB_HOST = 'HOST'; // MySQL HOST
	$DB_CHARSET= 'utf8'; // CHARSET
	
	
	// TRY CONNEXION to BDD
	try{
		$bdd = new PDO('mysql:host='.$DB_HOST.';dbname='.$DB_NAME.'', $DB_USER, $DB_PASSWORD);
	}
	
	catch(Exception $e){
	    die('Erreur : '.$e->getMessage());
	}

?>