#!/usr/bin/php
<?php
//require_once 'App/PhpAgi/phpagi.php';
require_once 'InitSession.php';
require_once 'Tokens.php';
require_once 'Payload.php';
require_once 'PicisCurl.php';
//Argumentos vindo da URA



$post_field = new Payload();
$post_field->name                ='teste de classes';
$post_field->content             ='gerado pelo objeto';
$post_field->itilcategories_id   = 1;
$post_field->_users_id_requester = 2;
$post_field->users_id_assign     = 8;
$post_field->type                = 1;
$post_field->urgency             = 1;
$post_field->status              = 1;
$post_field->requesttypes_id     = 1;

$payload = $post_field->Input();


$session_token = InitSission::requestTokenSession();
$keys = Tokens::Open('tokens');
$headers =array(
    'Content-Type: application/json',
    'App-Token: ' .$keys['app_token'],
    'Session-Token: '.$session_token
);

$c = new PicisCurl('http://10.0.3.93/glpi/apirest.php/Ticket/');
$c->setHeaders($headers);
$c->setMethod('POST');
$c->setPostField($payload);
$response = $c->createCurl();

print_r($response['id']);






?>