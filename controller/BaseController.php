<?php
include_once 'model/BaseModel.php';

class BaseController {

    function loadView($view="home", $data=[]){ 

        $model = new BaseModel;
        $categories = $model->selectCategories();
       // print_r($categories);
       // die;
        include_once 'view/layout.view.php';
    }

    function loadHtmlSortPrice($view,$data=[]){
        include_once "view/ajax/$view.view.php";
    }

}


?>