<?php
namespace Frameworkphp3wa\Database;

use PDO;

class ConnectSql{
    private static $db = null;

    private function __construct() {}

    public static function getDB($db){
        $config = include dirname(dirname(dirname(__DIR__))).'/app/config.php';
        if($db == "mysql"){
            self::$db = new PDO(
                'mysql:host='.$config["host"].';dbname='.$config["dbname"],
                $config["username"],
                $config["password"],
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                )
            );
        }elseif($db == "redis"){
            $client = new \Predis\Client();
            self::$db = $client;
        }elseif($db == "mongodb"){  
            $client = new \MongoDB\Client('mongodb://localhost:27017/?readPreference=primary&appname=MongoDB%20Compass%20Community&ssl=false');
            self::$db = $client->twitter;
        }
            
    
        return self::$db;
    }
}
 