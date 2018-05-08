<?php
include_once 'BaseController.php';
include_once 'model/TypeModel.php';
include_once 'helper/Pager.php';

class TypeController extends BaseController{

    function getProductByType(){
        $alias = isset($_GET['alias']) ? $_GET['alias'] : header('Location:404.html');
        $page = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] !=0) ?  
                abs($_GET['page']) : 1;
        //echo abs($_GET['page']);
        //echo $page; die;
        $model = new TypeModel();

        $qty = 9;
        $position = ($page-1)*$qty;
        $result = $model->selectProductsByTypeLevel1($alias);
        if(count($result) == 0)
            $result = $model->selectProductsByTypeLevel2($alias);
        
        $pager = new Pager(count($result),$page,$qty,5);
        $showPagination = $pager->showPagination();
        
        $type = $model->getNameType($alias);
        $result = $model->selectProductsByTypeLevel1($alias,$position,$qty);

        if(count($result) == 0)
            $result = $model->selectProductsByTypeLevel2($alias,$position,$qty);
        //echo count($result); die;
        if(count($result)==0 || $type == ''){
            header('Location:404.html');
            return;
        }
        $data = [
            'result'=>$result,
            'nameType'=>$type,
            'showPagination'=>$showPagination
        ];
        //print_r($data); die;

        return $this->loadView('type',$data);
    }

}



?>