<?php

class Database {
    private static $hostName = 'localhost';
    private static $dbName = 'cms';
    private static $username = 'root';
    private static $password = '';
    private static $conn;

    public static function connect() {
        if(self::$conn == null){
            try {
                self::$conn = new PDO ("mysql:host=".self::$hostName.";dbname=".self::$dbName,self::$username,self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);                
            }
            catch(Exception $e) 
            {
                die($e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function disConnect() {
        self::$conn = null;
    }
}

