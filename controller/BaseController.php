<?php

class BaseController {

    function loadView($view="home", $data=[]){ 
        include_once 'view/layout.view.php';
    }

}


?>