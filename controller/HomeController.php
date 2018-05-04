<?php
include_once 'BaseController.php';
include_once 'model/HomeModel.php';
class HomeController extends BaseController{

    function getHome(){
        $model = new HomeModel();
        $slide = $model->selectSlide();
        $featureProducts = $model->selectFeatureProduct();
        $bestSeller = $model->selectBestSeller();

        $data = [
            'slide' => $slide,
            'featureProducts' => $featureProducts,
            'bestSeller'=>$bestSeller
        ];
        //print_r($featureProducts); die;

        return $this->loadView('home',$data);
    }



}



?>