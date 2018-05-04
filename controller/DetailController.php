<?php
include_once 'BaseController.php';
include_once 'model/DetailModel.php';

class DetailController extends BaseController{

    function getDetail(){
        $alias = isset($_GET['alias']) ? $_GET['alias'] : '';
        $id =  isset($_GET['id']) ? $_GET['id'] : 0;

        $model = new DetailModel();
        $product = $model->selectDetailProduct($alias,$id);

        if($alias =='' || $id == 0 || $product == ''){
            header('Location:404.html');
            return;
        }
        $data = [
            'product'=>$product
        ];
        print_r($product); die;
        return $this->loadView('detail', $data);
    }

}



?>