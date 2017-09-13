<?php

class Model {

    public static function dbAdapter(){
        $params = require 'config/db_params.php';
        return $db = new PDO('mysql:host='.$params['host'].';dbname='.$params['db_name'], $params['username'], $params['password']);
    }

}