<?php
    require_once 'InitSession.php';
    require_once 'Tokens.php';
    require_once 'PicisCurl.php';

    class SearchUser {
        
        private $_cpfcnpj;
        private $_session_token;
        private $_tokens;
        private $_headers;

        public function __construct($cpfcnpj)
        {
            $this->_cpfcnpj        = $cpfcnpj;
            $this->_session_token  = InitSission::requestTokenSession();
	        $this->_tokens         = Tokens::Open('tokens');
	        $this->_headers        = array(
                                        'Content-Type: application/json',
                                        'App-Token: ' .$this->_tokens['app_token'],
                                        'Session-Token: '.$this->_session_token
                                    );

        }

        public function  getUser(){
            
            $c = new PicisCurl('http://10.0.3.93/glpi/apirest.php/User/');
	        $c->setHeaders($this->_headers);
	        $c->setMethod('GET');
	        $responseUser = $c->createCurl();
            $i = array_search($this->_cpfcnpj, array_column($responseUser, 'name'));
            
            return $responseUser[$i];
        }
        
        public function getLocation($responseUser){
            
            $linkLocantion = $responseUser['links'][0]['href'];

            $c1 = new PicisCurl($linkLocantion);
	        $c1->setHeaders($this->_headers);
	        $c1->setMethod('GET');
            $responseLocation = $c1->createCurl();
            
            return $responseLocation;

        }
            

    }
        
?>