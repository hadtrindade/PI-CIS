#!/usr/bin/php
<?php
    require_once 'phpagi.php';
    $agi= new AGI();
    $agi->answer();
    $pronto=$argv[1];
    $telearg=$argv[2];
    $area=$argv[3];
    $chamador=$argv[4];
    date_default_timezone_set('America/Recife');
    $data = date("d:m:Y");
    $hora = date("H:i");
    $con=mysqli_connect("localhost","usuário","senha","planochamada") or die(mysqli_error($con));
    $sql=mysqli_query($con,"SELECT nome FROM militares WHERE telefone='".$telearg."'");
    $nome=mysqli_fetch_all($sql);
    $sql1=mysqli_query($con,"INSERT INTO relatorio ( dia,militar,chamador,area, horaatendimento, pronto) VALUE ('".$data."','".$nome[0][0]."','".$chamador."','".$area."','".$hora."','".$pronto."')");

?>
