<?php

class Validator {

    public function validateEmail($email){

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<h1>Email is not valid!</h1>';
            return false;
        }
        return true;
    }

    public function validateName($name){
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            echo '<h1>Name is not valid!</h1>';
            return false;
        }
        return true;
    }

    public function validatePassword($password){
        //some password validation
        return true;
    }

}