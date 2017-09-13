<?php

class Home extends Controller {

    function __construct(){
        if(isset($_SESSION['id'])){
            View::render('home');
        }else{
            View::render('login');
        }
    }

}