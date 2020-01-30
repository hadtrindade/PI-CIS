#!/usr/bin/php
<?php
require_once 'phpagi.php';
$agi= new AGI();

$cpfcnpj=$argv[1];
$con=mysqli_connect("localhost","usuario","senha","glpi") or die(mysqli_error($con));
$sql=mysqli_query($con,"SELECT glpi_users.id, glpi_users.firstname, glpi_users.realname, glpi_locations.latitude, glpi_locations.longitude FROM glpi_users, glpi_locations WHERE glpi_locations.id = glpi_users.locations_id and glpi_users.name='$cpfcnpj'");
if (mysqli_num_rows($sql) == 0){

	$agi->set_variable("CINVALIDO", mysqli_num_rows($sql));

}else{

	$agi->set_variable("CINVALIDO", 1);
	$ln=mysqli_fetch_all($sql);
	$agi->set_variable("IDCLIENTE", $ln[0][0]);
	$agi->set_variable("NCLIENTE", $ln[0][1]);
	$agi->set_variable("SNCLIENTE", $ln[0][2]);
	$agi->set_variable("CLATITUDE", $ln[0][3]);
	$agi->set_variable("CLONGITUDE", $ln[0][4]);
};

?>
