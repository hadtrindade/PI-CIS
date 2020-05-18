#!/usr/bin/php
<?php

	require_once 'InitSession.php';
	require_once 'Tokens.php';
	require_once 'Payload.php';
	require_once 'PicisCurl.php';

    $idTecnico=$argv[1];
    $idTicket=$argv[2];

    $post_field = new Payload();
    $post_field->id              = $idTicket;
    $post_field->users_id_assign = $idTecnico;
    $payload = $post_field->Input();


    
    $session_token = InitSission::requestTokenSession();
    $keys = Tokens::Open('tokens');
    $headers =array(
        'Content-Type: application/json',
        'App-Token: ' .$keys['app_token'],
        'Session-Token: '.$session_token
    );

    $c = new PicisCurl('http://10.0.3.93/glpi/apirest.php/Ticket/'.$idTicket);
    $c->setHeaders($headers);
    $c->setMethod('PUT');
    $c->setPostField($payload);
    $response = $c->createCurl();
    print_r($response);

?>
