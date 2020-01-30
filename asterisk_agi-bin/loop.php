#!/usr/bin/php7.0
<?php
require_once 'phpagi.php';
$agi= new AGI();
$agi->answer();
$cont=$argv[1];
$con=mysqli_connect("localhost","usuário","senha","planochamada") or die(mysqli_error($con));
$sql=mysqli_query($con,"SELECT * FROM militares ORDER BY chamador DESC, op DESC");
$ln=mysqli_fetch_all($sql);
if ($cont <= count($ln)) {
	$agi->set_variable("TELEFONE", $ln[$cont][2]);
	$agi->set_variable("CHAMADOR", $ln[$cont][6]);
	$agi->set_variable("AREA", $ln[$cont][3]);
	$contador=$cont+=1;
	$agi->set_variable("CONTADOR",$contador);
	$agi->set_variable("TOTAL",count($ln));
//	$agi->set_var("TESTE",$contador)
};
?>
