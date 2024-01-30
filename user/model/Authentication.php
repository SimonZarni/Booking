<?php

include_once __DIR__. '/../vendor/database.php';

class Authentication {

    public function getUserInfo(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM user";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addUser($name,$email,$password){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO user(name,email,password) VALUES(:name,:email,:password)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':password',$password);
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getUserList($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM user WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement-> bindParam(':id',$id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function userByEmail($email){
        $conn=Database::connect();
        $sql='SELECT id from user where email = :email';
        $statement = $conn->prepare($sql);
        $statement->bindParam(':email',$email);
        if ($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}

?>