<?php
include_once 'BaseController.php';
include_once 'model/HomeModel.php';
class HomeController extends BaseController{

    function getHome(){
        $model = new HomeModel();
        $slide = $model->selectSlide();
        $featureProducts = $model->selectFeatureProduct();

        $data = [
            'slide' => $slide,
            'featureProducts' => $featureProducts
        ];

        return $this->loadView('home',$data);
    }



}



?>