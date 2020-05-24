<?php
    require_once 'PicisCurl.php';
    require_once 'Tokens.php';

    class DistanceMetrics {
        private $_clienteLatitude;
        private $_clienteLongitude;
        private $_tecnicoLatitude;
        private $_tecnicoLongitude;
        private $_tokens;

        public function __construct($clienteLatitude, $clienteLongitude, $tecnicoLatitude, $tecnicoLongitude)
        {
            $this->_clienteLatitude  = $clienteLatitude;
            $this->_clienteLongitude = $clienteLongitude;
            $this->_tecnicoLatitude  = $tecnicoLatitude;
            $this->_tecnicoLongitude = $tecnicoLongitude;
            $this->_tokens           = Tokens::Open('tokens');

        }

        public function getDistance(){
            
            $c1 = new PicisCurl('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$this->_clienteLatitude.',\
            '.$this->_clienteLongitude.'&destinations='.$this->_tecnicoLatitude.','.$this->_tecnicoLongitude.'\
            &mode=driving&language=pt-BR&key='.$this->_tokens['google_token']);
            $c1->setMethod('GET');
            $responseDistance = $c1->createCurl();
            
            return $responseDistance;
        }

    }

?>