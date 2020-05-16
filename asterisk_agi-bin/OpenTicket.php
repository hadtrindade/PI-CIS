<?php
class OpenTicket {
    private $data;

    public function __set($prop, $value){
        $this->data[$prop] = $value;

    }
    public function Input(){
        $input['input'] = $this->data;

        return $input;
    }

    

}
?>