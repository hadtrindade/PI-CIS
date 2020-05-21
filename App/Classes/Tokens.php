<?php
    final class Tokens {
        
        private function __construct(){}

        public static function Open($name) {
        
            //Verificação se o arquivo existe.
            if (file_exists("App/Config/{$name}.ini")){
                $keys = parse_ini_file("App/Config/{$name}.ini");
                #print_r($keys);
            }
            else {
                throw new Exception("Arquivo {$name} não encontrado");
            }
            $tokens['user_token']    = isset($keys['user_token'])    ? $keys['user_token']    : NULL;
            $tokens["app_token"]     = isset($keys['app_token'])     ? $keys['app_token']     : NULL;
            $tokens["google_token"]  = isset($keys['google_token'])  ? $keys['google_token']  : NULL;
            
            return $tokens;

        }
    

    }
  

    
?>