<?php
include_once 'BaseController.php';
include_once 'model/TypeModel.php';

class TypeController extends BaseController{

    function getProductByType(){
        $alias = isset($_GET['alias']) ? $_GET['alias'] : header('Location:404.html');

        $model = new TypeModel();
        $result = $model->selectProductsByTypeLevel2($alias);
        $nameType = $model->getNameType($alias);

        if(count($result)==0 || count($nameType)==0){
            header('Location:404.html');
            return;
        }
        $data = [
            'result'=>$result,
            'nameType'=>$nameType
        ];
        //print_r($data); die;

        return $this->loadView('type',$data);
    }

}



?>