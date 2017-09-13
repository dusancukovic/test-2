<?php

class Bootstrap {

    function __construct(){
        
        if(isset($_GET['url'])){

            $url = explode('/', $_GET['url']);

            $file = 'controller/'.$url[0].'.php';

            if(file_exists($file)){
                require $file;
            }else{
                throw new Exception('Controller '.$file.' does not exist.');
            }

            $controller = new $url[0];

            if(isset($url[1])){
                $controller->{$url[1]}();
            }

            if(isset($url[2])){
                $controller->{$url[1]}{$url[2]};
            }

        }else{
            $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
            if(isset($_SESSION['id'])){
            
                ob_start();
                header('Location: '.$root.'apptest/home');
                ob_end_flush();
            }else{

                ob_start();
                header('Location: '.$root.'apptest/user/login');
                ob_end_flush();
            }   
        }


    }

}