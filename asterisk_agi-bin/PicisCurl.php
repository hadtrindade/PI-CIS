<?php
    
    class PicisCurl {
        protected $_useragent          = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1';
        protected $_url;
        protected $_followlocation;
        protected $_timeout;
        protected $_maxRedirects;
        protected $_cookieFileLocation = './cookie.txt';
        protected $_method;
        protected $_session;
        protected $_webpage;
        protected $_postfield;
        protected $_status;
        protected $_headers;
         

        public function __construct($url,$followlocation = true,$timeOut = 30,$maxRedirecs = 4){
            $this->_url = $url;
            $this->_followlocation = $followlocation;
            $this->_timeout = $timeOut;
            $this->_maxRedirects = $maxRedirecs;
            $this->_cookieFileLocation = dirname(__FILE__).'/cookie.txt';
        }
    
         public function setCookiFileLocation($path){
            $this->_cookieFileLocation = $path;
        }
        
        public function setHeaders($headers){
            $this->_headers = $headers;
        }

        public function setPostField($postfield){
            $this->_postfield = $postfield;
        }

        public function setMethod ($method){
            $this->_method = $method;    

        }     
             
        public function setUserAgent($userAgent){
            $this->_useragent = $userAgent;
        }
    
        public function createCurl($url = 'nul'){
            
            if($url != 'nul'){
                $this->_url = $url;
            }
    
            $s = curl_init();
            curl_setopt($s,CURLOPT_URL,           $this->_url);
            curl_setopt($s,CURLOPT_HTTPHEADER,    $this->_headers);
            //curl_setopt($s,CURLOPT_HEADER,        true);
            curl_setopt($s,CURLOPT_TIMEOUT,       $this->_timeout);
            curl_setopt($s,CURLOPT_MAXREDIRS,     $this->_maxRedirects);
            curl_setopt($s,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($s,CURLOPT_FOLLOWLOCATION,$this->_followlocation);
            curl_setopt($s,CURLOPT_COOKIEJAR,     $this->_cookieFileLocation);
            curl_setopt($s,CURLOPT_COOKIEFILE,    $this->_cookieFileLocation);
            
    
            switch ($this->_method){

                case 'POST':
                    curl_setopt($s,CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($s, CURLOPT_POSTFIELDS, $this->_postfield);
                    break;

                case 'GET':
                    curl_setopt($s,CURLOPT_CUSTOMREQUEST, 'GET');
                break;

                case 'PUT':
                    curl_setopt($s,CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($s, CURLOPT_POSTFIELDS, $this->_postfield);
                break;

                default:
                    curl_setopt($s,CURLOPT_CUSTOMREQUEST, 'GET');
            }

            curl_setopt($s,CURLOPT_USERAGENT,$this->_useragent);
    
            $this->_webpage = curl_exec($s);
            $this->_status  = curl_getinfo($s,CURLINFO_HTTP_CODE);
            curl_close($s);

            return json_decode($this->_webpage,true);
            
    
         }
    
        public function getHttpStatus(){

           return $this->_status;
       }
    
    }
    
?>