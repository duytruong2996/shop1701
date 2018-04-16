<?php

class BaseController {

    function loadView($view, $data=[]){
        
        include_once 'layout.view.php';
    }

}


?>