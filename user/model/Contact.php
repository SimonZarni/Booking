<?php

include_once __DIR__. '/../vendor/database.php';

class Contact {

    public function sendForm($name,$email,$subject,$message){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "insert into review(name,email,subject,message) values(:name,:email,:subject,:message)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':subject',$subject);
        $statement->bindParam(':message',$message);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }
}

?>