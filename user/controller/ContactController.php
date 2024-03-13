<?php

include_once __DIR__. '/../model/Contact.php';

class ContactController extends Contact {

    public function submitForm($name,$email,$subject,$message){
        return $this->sendForm($name,$email,$subject,$message);
    }
}

?>