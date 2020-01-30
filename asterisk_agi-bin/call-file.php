#!/usr/bin/php
<?php
require_once 'phpagi.php';
$agi= new AGI();
$agi->answer();

//$cont=$argv[1];
$con=mysqli_connect("192.168.0.14","usuário","senha","planochamada") or die(mysqli_error($con));
$sql=mysqli_query($con,"SELECT * FROM militares");
while ($ln=mysqli_fetch_array($sql)){
	$telefone=$ln['telefone'];
	$agi->exec_dial('SIP/'.$telefone,'','','gG(todas,0002,bye)');
};
?>
