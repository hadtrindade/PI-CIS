#!/usr/bin/php
<?php

	require_once 'App/PhpAgi/phpagi.php';
	require_once 'InitSession.php';
	require_once 'Tokens.php';
	require_once 'Payload.php';
	require_once 'PicisCurl.php';

	//Buscar usuário

	$cpfcnpj=$argv[1];

	$c = new PicisCurl('http://10.0.3.93/glpi/apirest.php/User/');
	$c->setHeaders($headers);
	$c->setMethod('GET');
	$response = $c->createCurl();
	$i = array_search($cpfcnpj, array_column($response, 'name'));

	$linkLocantion = $response[$i]['links'][0]['href'];

	$c1 = new PicisCurl($linkLocantion);
	$c1->setHeaders($headers);
	$c1->setMethod('GET');
	$responseLocation = $c1->createCurl();

	$agi= new AGI();
	$agi->set_variable("CINVALIDO", 1);
	$agi->set_variable("IDCLIENTE", $response[$i]['id']);
	$agi->set_variable("NCLIENTE", $response[$i]['firstname']);
	$agi->set_variable("SNCLIENTE", $response[$i]['realname']);
	$agi->set_variable("CLATITUDE", $responseLocation['latitude']);
	$agi->set_variable("CLONGITUDE", $responseLocation['longitude']);

?>
