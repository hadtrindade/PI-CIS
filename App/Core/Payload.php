<?php
    class Payload {
        private $data;

        public function __set($prop, $value){
            $this->data[$prop] = $value;

        }
        public function Input(){
            $input['input'] = $this->data;

            return json_encode($input,true);
        }

    }
?>