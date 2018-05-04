<?php
include_once 'BaseController.php';
include_once 'model/TypeModel.php';

class TypeController extends BaseController{

    function getProductByType(){
        $alias = isset($_GET['alias']) ? $_GET['alias'] : header('Location:404.html');

        $model = new TypeModel();

        $type = $model->getNameType($alias);
        if($type->id_parent == NULL)
            $result = $model->selectProductsByTypeLevel1($alias);
        else $result = $model->selectProductsByTypeLevel2($alias);

        //print_r($result); die;

        if(count($result)==0 || $type == ''){
            header('Location:404.html');
            return;
        }
        $data = [
            'result'=>$result,
            'nameType'=>$type
        ];
        //print_r($data); die;

        return $this->loadView('type',$data);
    }

}



?>