#!/usr/bin/php
<?php

	require_once 'PhpAgi/phpagi.php';
	require_once 'Services/GlpiRest.php';

	//Buscar usuário

	$cpfcnpj=$argv[1];

	$s = new GlpiRest();
	$responseUser 	  = $s->getUser($cpfcnpj);
	$responseLocation = $s->getLocation($responseUser);

	$agi= new AGI();
	$agi->set_variable("CINVALIDO", 1);
	$agi->set_variable("IDCLIENTE", $responseUser['id']);
	$agi->set_variable("NCLIENTE", $responseUser['firstname']);
	$agi->set_variable("SNCLIENTE", $responseUser['realname']);
	$agi->set_variable("CLATITUDE", $responseLocation['latitude']);
	$agi->set_variable("CLONGITUDE", $responseLocation['longitude']);

?>
