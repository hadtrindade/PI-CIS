#!/usr/bin/php
<?php
    require_once 'App/PhpAgi/phpagi.php';
    require_once 'InitSession.php';
	require_once 'Tokens.php';
	require_once 'Payload.php';
	require_once 'PicisCurl.php';


    $filaPlantao      = $argv[1];
    $clienteLatitude  = $argv[2];
    $clienteLongitude = $argv[3];


    $agentes      = str_replace('"','',$filaPlantao);
    $agentes      = str_replace('SIP/','',$agentes);
    $listaAgentes = explode(',',$agentes);
    $listaPlantao = array();
    $tempos       = array();
    $rua          = array();

    $session_token = InitSission::requestTokenSession();
    $tokens = Tokens::Open('tokens');

    $headers =    array(
        'Content-Type: application/json',
        'App-Token: ' .$tokens['app_token'],
        'Session-Token: '.$session_token
    );



    for ($i=0; $i < count($listaAgentes); $i++) {

        $c = new PicisCurl('http://10.0.3.93/glpi/apirest.php/User/');
        $c->setHeaders($headers);
        $c->setMethod('GET');
        $responseUser = $c->createCurl();
        $i = array_search($listaAgentes[$i], array_column($response, 'name'));
        $nomeTecnico   = $responseUser[$i]['name'];
        $linkLocantion = $response[$i]['links'][0]['href'];

        $c1 = new PicisCurl($linkLocantion);
        $c1->setHeaders($headers);
        $c1->setMethod('GET');
        $responseLocation = $c1->createCurl();
        $latitudeTecnico  = $responseLocation['latitude'];
        $longitudeTecnico = $responseLocation['longitude'];
        
        $c2 = new PicisCurl('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$clienteLatitude.','.$clienteLongitude.'&destinations='.$latitudeTecnico.','.$longitudeTecnico.'&mode=driving&language=pt-BR&key='.$tokens['app_token']);
        $c2->setMethod('GET');
        $responseDistance = $c2->createCurl();
        $distance         = $responseDistance['rows'][0]['elements'][0]['duration']['text'];
        $tempo            = explode(' ',$distance);
        $ruaDestino       = $responseDistance['destination_addresses'][0];
        $arua             = explode(',',$ruaDestino);
        $ruaTecnico       = $arua[0].', '.$arua[1].', '.$arua[2];
        array_push($rua, $ruaTecnico);
        array_push($listaPlantao, $nomeTecnico);
        array_push($tempos, $tempo[0]);

        
    };

    $key               = array_search(min($tempos), $tempos);
    $tecnicoPlatao     = $listaPlantao[$key];
    $ruaTecnicoPlantao = $rua[$key];


    $agi = new AGI();
    $agi->set_variable("AGENTEPLT", $tecnicoPlatao);
    $agi->set_variable("RUAAGENTEPLT", $ruaTecnicoPlantao);
    $agi->set_variable("TEMPOAGENTEPLT", min($tempos));


?>
