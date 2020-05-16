#!/usr/bin/php
<?php

//require_once 'phpagi.php';
//$agi= new AGI();

$idcliente='teste';
$idcategoria='$argv[2]';
$idurgencia='$argv[3]';
$idtipo='$argv[4]';

$input='{"input": {"name": "'.utf8_encode($titulo).'","content": "ABERTO PELA CENTRAL INTELIGENTE DE SUPORTE '.utf8_encode($titulo).'","itilcategories_id": "'.$idcategoria.'","_users_id_requester":"'.$idcliente.'","type": "'.$idtipo.'","urgency":"'.$idurgencia.'","status": "1","requesttypes_id":"3"}}';
$t = json_decode($input, true);

print_r($t);
/*

$api_url="http://10.0.3.93/glpi/apirest.php";
$user_token="R6puBroSNSImfYTfEjbauPDCxImY9uMmaPqovg1Q";
$app_token="pYnpJoGANAlQ7C5RayyCUS16AhP7sP3dnWuX06HF";

$ch = curl_init();
$url=$api_url . "/initSession?Content-Type=%20application/json&app_token=".$app_token ."&user_token=".$user_token;
$response = json_decode(file_get_contents($url),true);
print_r($response);
/*curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
curl_close ($ch);
$obj = json_decode($json,true);

#$sess_token = $obj['session_token'];
$headers =array(
    'Content-Type: application/json',
    'App-Token: ' .$app_token,
    'Session-Token: '.$sess_token
);
#print_r($json);

/*
$con=mysqli_connect("localhost","usuário","senha","glpi") or die(mysqli_error($con));
$sql=mysqli_query($con,'SELECT glpi_itilcategories.completename FROM glpi_itilcategories WHERE glpi_itilcategories.id = '.$idcategoria.'');
$lncat=mysqli_fetch_all($sql);
$titulo=$lncat[0][0];

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

$obj = json_decode($json,true);

$agi->set_variable("IDTICKET", $obj['id']);
$agi->set_variable("NCLIENTE", $ln[0][1]);
$agi->set_variable("SNCLIENTE", $ln[0][2]);
$agi->set_variable("CLATITUDE", $ln[0][3]);
$agi->set_variable("CLONGITUDE", $ln[0][4]);
*/
?>
