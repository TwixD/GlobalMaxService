<?php

class Conexion {

    private static $server = "localhost";
    private static $user = "root";
    private static $password = "twix";
    private $mysqli = null;
    private static $database = "globalmx";


    function __construct() {
        $this->mysqli = new mysqli(self::$server, self::$user, self::$password, self::$database);

        if ($this->mysqli->connect_errno) {
            printf("Connect failed: %s", $this->mysqli->connect_error);

            exit();
        }
    }


    public function getTreeMenu($query) {
        $gbd = new PDO('mysql:host=localhost;dbname=globalmx', self::$user, self::$password);

        $gsent = $gbd->prepare($query);
        $gsent->execute();

        /* Agrupar valores seg�n la primera columna */

        return json_encode($gsent->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC));
    }

   
}

?>
