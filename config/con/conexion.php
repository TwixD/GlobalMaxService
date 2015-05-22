<?php

class Conexion {

    private static $server = CON_HOST;
    private static $user = CON_USER;
    private static $password = CON_PASS;
    private static $database = CON_DB;
    private $mysqli = null;
    

    function __construct() {
        $this->mysqli = new mysqli(self::$server, self::$user, self::$password, self::$database);
        if ($this->mysqli->connect_errno) {
            printf("Connect failed: %s", $this->mysqli->connect_error);
            exit();
        }
    }


    public function getTreeMenu($query) {
        $gbd = new PDO('mysql:host='.CON_HOST.';dbname='.CON_DB, self::$user, self::$password);
        $gsent = $gbd->prepare($query);
        $gsent->execute();
        return json_encode($gsent->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC));
    }
}

?>
