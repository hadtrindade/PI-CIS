#!/usr/bin/php
<?php
require_once 'phpagi.php';
$agi= new AGI();

$filaplt=$argv[1];
$clatitude=$argv[2];
$clongitude=$argv[3];

$con=mysqli_connect("localhost","cis","1frn@ul@","glpi") or die(mysqli_error($con));

$agentes=str_replace('"','',$filaplt);
$agentes1=str_replace('SIP/','',$agentes);
$lagentes=explode(',',$agentes1);
$cagentes=array();
$tempos=array();
$rua=array();

for ($i=0; $i < count($lagentes); $i++) {
    $consulta="SELECT  glpi_users.id, glpi_users.name, glpi_locations.latitude, glpi_locations.longitude FROM glpi_users, glpi_locations WHERE glpi_locations.id = glpi_users.locations_id and glpi_users.name='$lagentes[$i]'";
    $sql = mysqli_query($con, $consulta);
    $ln=mysqli_fetch_all($sql);
    $json_loc = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$clatitude.','.$clongitude.'&destinations='.$ln[0][2].','.$ln[0][3].'&key=chave');
    $array_loc = json_decode($json_loc, true);
    $ln1=$array_loc['rows'][0]['elements'][0]['duration']['text'];
    $tempo=explode(' ',$ln1);
    $trua=$array_loc['destination_addresses'][0];
    $arua=explode(',',$trua);
    $ruaagt=$arua[0].', '.$arua[1].', '.$arua[2];
    array_push($rua, $ruaagt);
    array_push($cagentes,$ln[0][1]);
    array_push($tempos,$tempo[0]);
};

$key=array_search(min($tempos), $tempos);
$agenteplt=$cagentes[$key];
$ruaagenteplt=$rua[$key];
$agi->set_variable("AGENTEPLT", $agenteplt);
$agi->set_variable("RUAAGENTEPLT", $ruaagenteplt);
$agi->set_variable("TEMPOAGENTEPLT", min($tempos));

?>
