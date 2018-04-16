<?php
include_once 'BaseController.php';
class DetailController extends BaseController{

    function getDetail(){
        return $this->loadView('detail');
    }

}



?>