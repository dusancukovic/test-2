<?php

class userModel extends Model {

    public function checkUserEmail($email){
        $conn = new Model();
        $db = $conn->dbAdapter();
        $query  = $db->prepare("SELECT * FROM users WHERE `email` = "."'$email'");
        $query->execute();
        return $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserDetails($email){
        $conn = new Model();
        $db = $conn->dbAdapter();
        $query  = $db->prepare("SELECT id,email,name,password FROM users WHERE `email` = "."'$email'");
        $query->execute();
        return $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertNewUser($data){

        $fields=array_keys($data);
        $values=array_values($data);
        
        $fieldlist=implode(',',$fields); 
        $qs=str_repeat("?,",count($fields)-1);

        $conn = new Model();
        $db = $conn->dbAdapter();
        $query  = $db->prepare("INSERT INTO users("."$fieldlist".") values(${qs}?)");
        $query->execute($values);
        
        return $db->lastInsertId(); 
    }

    public function createPassword($password){

        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function searchUsers($search){
        $conn = new Model();
        $db = $conn->dbAdapter();
        $query  = $db->prepare("SELECT email,name FROM users WHERE CONCAT(email, ' ', name) LIKE "."%'$search'%");
        $query->execute();
        return $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

}