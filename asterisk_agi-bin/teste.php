#!/usr/bin/php
<?php
require_once 'Tokens.php';
require_once 'InitSession.php';
require_once 'OpenTicket.php';

$tokens = Tokens::Open('tokens');

$session_token = InitSission::requestTokenSession();

$i1 = new OpenTicket();
$i1->teste='teste1';
$i1->teste2='teste2';
$i1->teste3='teste3';
print_r(json_encode($i1->input(),true));
/*
$input='{"input": {"name": "'.utf8_encode($titulo).'","content": "ABERTO PELA CENTRAL INTELIGENTE DE SUPORTE '.utf8_encode($titulo).'","itilcategories_id": "'.$idcategoria.'","_users_id_requester":"'.$idcliente.'","type": "'.$idtipo.'","urgency":"'.$idurgencia.'","status": "1","requesttypes_id":"3"}}';

$url=$api_url . "/Ticket/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $input);
$json = curl_exec($ch);
curl_close ($ch);
*/
?>