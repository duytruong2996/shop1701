<?php
include_once 'BaseController.php';
class TypeController extends BaseController{

    function getProductByType(){
        return $this->loadView('type');
    }

}



?>