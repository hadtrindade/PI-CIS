#!/usr/bin/php
<?php

require_once 'phpagi.php';
$agi= new AGI();

$nometecnico=$argv[1];
$idticket=$argv[2];


$con=mysqli_connect("localhost","user","senha","glpi") or die(mysqli_error($con));
$sql=mysqli_query($con,"SELECT glpi_users.id FROM glpi_users WHERE  glpi_users.name='$nometecnico'");
$lnnome=mysqli_fetch_all($sql);
$idtecnico=$lnnome[0][0];

mysqli_query($con,"UPDATE glpi_tickets_users SET glpi_tickets_users.users_id ='$idtecnico' WHERE glpi_tickets_users.tickets_id ='$idticket' AND glpi_tickets_users.users_id ='20'");

?>
