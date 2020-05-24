#!/usr/bin/php
<?php
    require_once 'PhpAgi/phpagi.php';
    require_once 'Services/GlpiRest.php';

    //Argumentos vindo da URA

    $idcliente=$argv[1];
    $idcategoria=$argv[2];
    $idurgencia=$argv[3];
    $idtipo=$argv[4];

    //Payload 
    $post_field = new Payload();
    $post_field->name                ='picis';
    $post_field->content             ='Chamado aberto pela Central Inteligente de suporte';
    $post_field->itilcategories_id   = $idcategoria;
    $post_field->_users_id_requester = $idcliente;
    $post_field->type                = $idtipo;
    $post_field->urgency             = $idurgencia;
    $post_field->status              = 1;
    $post_field->requesttypes_id     = 1;
    $payload                         = $post_field->Input();

    $c = new PicisCurl('http://10.0.3.93/glpi/apirest.php/Ticket/');
    $c->setHeaders($headers);
    $c->setMethod('POST');
    $c->setPostField($payload);
    $response = $c->createCurl();

    $agi= new AGI();
    $agi->set_variable("IDTICKET", $response['id']);
?>