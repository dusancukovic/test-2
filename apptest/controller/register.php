<?php

require 'model/userModel.php';
require 'libs/Validator.php';

class Register extends Controller {

    function __construct(){
        
        if(isset($_SESSION['id'])){
            View::render('home');
        }else{
            View::render('register');
        }   
    }

    public function registerNewUser(){

        if(isset($_POST['email'])){

            if(isset($_POST['name']) && Validator::validateName($_POST['name'])){
                $name = $_POST['name'];
            }
            if(isset($_POST['email']) && Validator::validateEmail($_POST['email'])){
                $email = $_POST['email'];
            }
            if(isset($_POST['password']) && Validator::validatePassword($_POST['password'])){
                $password = $_POST['password'];
            }
            if(isset($_POST['password_confirm']) && Validator::validatePassword($_POST['password_confirm'])){
                $password_confirm = $_POST['password_confirm'];
            }

            if($password == $password_confirm){

                $mdl = new userModel();
                $user = $mdl->checkUserEmail($email);

                if(count($user) == 0){
                    
                    $data = [
                        'email'=> $email,
                        'name' => $name,
                        'password' => $mdl->createPassword($password)
                    ];
                    $id = $mdl->insertNewUser($data);

                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['name'] = $name;

                    ob_start();
                    header('Location: '.$root.'/apptest/home');
                    ob_end_flush();
                }else{
                    echo '<h1>User already exist!</h1>';
                }
            }
        }
    }
}