#!/usr/bin/php
<?php

	require_once 'Services/GlpiRest.php';
	

    $idTecnico=$argv[1];
    $idTicket=$argv[2];

    $post_field                  = new Payload();
    $post_field->id              = $idTicket;
    $post_field->users_id_assign = $idTecnico;
    $payload                     = $post_field->Input();

    $atribuirTicket = new GlpiRest();
    $atribuirTicket->AtribuirTicket($idTicket,$payload);

?>
