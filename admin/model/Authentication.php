<?php

include_once __DIR__. '/../vendor/database.php';

class Authentication {

    public function getAdminInfo(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM admin";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addAdmin($name,$email,$password){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO admin(name,email,password) VALUES(:name,:email,:password)";
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

    public function getAdminList($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM admin WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement-> bindParam(':id',$id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updatePassword($password,$id){
        $conn = Database::connect();
        $sql = "UPDATE admin SET password = :password WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':password',$password);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            return true;
        } else {
            return false;
        }
    }

    public function isEmailExists($email){
        $conn = Database::connect();
        $sql = "SELECT COUNT(*) as count FROM admin WHERE email = :email";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':email',$email);
        $statement->execute();
        $count = $statement->fetchColumn();
        return $count > 0;
    }

    public function editPassword($password,$email){
        $conn = Database::connect();
        $sql = 'update admin set password = :password where email = :email';
        $statement = $conn->prepare($sql);
        $statement->bindParam(':password',$password);
        $statement->bindParam(':email',$email);

        if ($statement->execute())
        {
            return true;
        }     
    }
}

?>