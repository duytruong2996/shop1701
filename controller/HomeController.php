<?php
include_once 'BaseController.php';
class HomeController extends BaseController{

    function getHome(){
        return $this->loadView('home');
    }

}



?>