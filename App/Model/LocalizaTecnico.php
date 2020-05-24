#!/usr/bin/php
<?php
    require_once 'PhpAgi/phpagi.php';
    require_once 'Services/GlpiRest.php';
    require_once 'Services/DistanceMatrics.php';


    $filaPlantao      = $argv[1];
    $clienteLatitude  = $argv[2];
    $clienteLongitude = $argv[3];


    $agentes      = str_replace('"','',$filaPlantao);
    $agentes      = str_replace('SIP/','',$agentes);
    $listaAgentes = explode(',',$agentes);
    $listaPlantao = array();
    $tempos       = array();
    $rua          = array();

    for ($i=0; $i < count($listaAgentes); $i++) {

        $su               = new GlpiRest();
        $responseUser     = $su->getUser($listaAgentes[$i]);
        $nomeTecnico      = $responseUser['name'];
        $responseLocation = $su->getLocation($responseUser);

        $latitudeTecnico  = $responseLocation['latitude'];
        $longitudeTecnico = $responseLocation['longitude'];
        
        $sd               = new DistanceMetrics($clienteLatitude, $clienteLongitude, $latitudeTecnico, $longitudeTecnico);
        $responseDistance = $sd->getDistance();

        $distance         = $responseDistance['rows'][0]['elements'][0]['duration']['text'];
        $tempo            = explode(' ',$distance);
        $ruaDestino       = $responseDistance['destination_addresses'][0];
        $arua             = explode(',',$ruaDestino);
        $ruaTecnico       = $arua[0].', '.$arua[1].', '.$arua[2];
        
        array_push($rua,          $ruaTecnico);
        array_push($listaPlantao, $nomeTecnico);
        array_push($tempos,       $tempo[0]);

        
    };

    $key               = array_search(min($tempos), $tempos);
    $tecnicoPlatao     = $listaPlantao[$key];
    $ruaTecnicoPlantao = $rua[$key];

    $agi = new AGI();
    $agi->set_variable("AGENTEPLT",      $tecnicoPlatao);
    $agi->set_variable("RUAAGENTEPLT",   $ruaTecnicoPlantao);
    $agi->set_variable("TEMPOAGENTEPLT", min($tempos));


?>
