<?php
require_once 'Tokens.php';

final class InitSission {
    
    private function __construct(){}

    public static function requestTokenSession(){

        $keys = Tokens::Open('tokens');

        $uri = "http://10.0.3.93/glpi/apirest.php/initSession?Content-Type=%20application/json&app_token=".$keys['app_token'] ."&user_token=".$keys['user_token'];
        $response = json_decode(file_get_contents($uri), true);
        
        return $response['session_token'];
    }

}

?>