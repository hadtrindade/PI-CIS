#!/usr/bin/php7.0
<?php
require_once 'phpagi.php';
$agi= new AGI();
$agi->answer();
$cont=$argv[1];
$cont2=$argv[1];
$con=mysqli_connect("localhost","usuário","senha","planochamada") or die(mysqli_error($con));
$sql=mysqli_query($con,"SELECT * FROM militares WHERE chamador='1' ORDER BY op DESC");
$ln=mysqli_fetch_all($sql);
if ($cont <= count($ln)) {
	    $nomes='';
	    $agi->set_variable("TELEFONE", $ln[$cont][2]);
	    $contador=$cont+=1;
	    $agi->set_variable("CONTADOR",$contador);
	    $agi->set_variable("TOTAL",count($ln));

	    $sql1=mysqli_query($con,"SELECT * FROM relatorio WHERE pronto='2' AND area='".$ln[$cont2][3]."'");
	    if (mysqli_num_rows($sql1) != 0 ) {
	        while ($ln1 = mysqli_fetch_array($sql1)) {
	      		$nome = $ln1['militar'];
	        	$nome = $nome . ' ';
	        	$nomes .= $nome;
	        };
	        $agi->set_variable("NOMEC", $nomes);
	        }else {
	        $agi->set_variable("NOMEC", '0');
	        };
	    };

?>


