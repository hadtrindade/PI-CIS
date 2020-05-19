#!/usr/bin/php
<?php
require_once 'App/PhpAgi/phpagi.php';
require_once 'InitSession.php';
require_once 'Tokens.php';
require_once 'Payload.php';
require_once 'PicisCurl.php';

//Argumentos vindo da URA


$idcliente=$argv[1];
$idcategoria=$argv[2];
$idurgencia=$argv[3];
$idtipo=$argv[4];


$post_field = new Payload();
$post_field->name                ='teste de classes';
$post_field->content             ='gerado pelo objeto';
$post_field->itilcategories_id   = $idcategoria;
$post_field->_users_id_requester = $idcliente;
$post_field->type                = $idtipo;
$post_field->urgency             = $idurgencia;
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

$agi= new AGI();
$agi->set_variable("IDTICKET", $response['id']);
