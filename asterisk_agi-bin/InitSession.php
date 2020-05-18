<?php
require_once 'Tokens.php';
require_once 'PicisCurl.php';

final class InitSission {
    
    private function __construct(){}

    public static function requestTokenSession(){

        $keys = Tokens::Open('tokens');

        $headers =array(
            'Content-Type: application/json',
            'Authorization: user_token '.$keys['user_token'],
            'App-Token: ' .$keys['app_token'],
            );

        $c = new PicisCurl('http://10.0.3.93/glpi/apirest.php/initSession');
        $c->setHeaders($headers);
        $c->setMethod('GET');
        $response = $c->createCurl();
        return $response['session_token'];
       
    }

}

?>