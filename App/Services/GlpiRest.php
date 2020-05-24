<?php
    require_once 'InitSession.php';
    require_once 'Tokens.php';
    require_once 'PicisCurl.php';

    class GlpiRest {
        
        private $_session_token;
        private $_tokens;
        private $_headers;

        public function __construct()
        {
            $this->_session_token  = InitSission::requestTokenSession();
	        $this->_tokens         = Tokens::Open('tokens');
	        $this->_headers        = array(
                                        'Content-Type: application/json',
                                        'App-Token: ' .$this->_tokens['app_token'],
                                        'Session-Token: '.$this->_session_token
                                    );

        }

        public function  getUser($cpfcnpj){
            
            $c = new PicisCurl('http://10.0.3.93/glpi/apirest.php/User/');
	        $c->setHeaders($this->_headers);
	        $c->setMethod('GET');
	        $responseUser = $c->createCurl();
            $i = array_search($cpfcnpj, array_column($responseUser, 'name'));
            
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

        public function AtribuirTicket($idTicket,$payload){

            $at = new PicisCurl('http://10.0.3.93/glpi/apirest.php/Ticket/'.$idTicket);
            $at->setHeaders($this->_headers);
            $at->setMethod('PUT');
            $at->setPostField($payload);
            $at->createCurl();

        }
        
        public function OpenTicket($payload){

            $cp = new PicisCurl('http://10.0.3.93/glpi/apirest.php/Ticket/');
            $cp->setHeaders($this->_headers);
            $cp->setMethod('POST');
            $cp->setPostField($payload);
            
            return $cp->createCurl();


        }

    }
        
?>