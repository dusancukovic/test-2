<?php

require 'model/userModel.php';
require 'libs/Validator.php';

class User extends Controller {

    function __construct(){
        
        if(isset($_SESSION['id'])){
            View::render('home');
        }else{
            View::render('login');
        }   
    }

    public function login(){

        if(isset($_POST['email'])){

            if(isset($_POST['email']) && Validator::validateEmail($_POST['email'])){
                $email = $_POST['email'];
            }
            if(isset($_POST['password']) && Validator::validatePassword($_POST['password'])){
                $password = $_POST['password'];
            }

            $mdl = new userModel();
            $user = $mdl->getUserDetails($email);

            if(count($user) != 0){
                if(password_verify($password, $user[0]['password'])){

                    session_start();
                    $_SESSION['id'] = $user[0]['id'];
                    $_SESSION['name'] = $user[0]['name'];
                    
                    View::render('home');
                }else{
                    echo '<h1>Password is incorrect!</h1>';
                }
            }else{
                echo '<h1>User does not exist!</h1>';
            }
        }
    }

    public function searchUser(){

        $mdl = new userModel();
        $users = $mdl->searchUsers($search);

        //return response
    }

    public function logout(){
        if(isset($_SESSION['id'])){
            session_destroy();
        }
        View::render('login');
    }

}