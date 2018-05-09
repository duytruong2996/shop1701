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
        
        $pager = new Pager(count($result),$page,$qty,3);
        $showPagination = $pager->showPagination();
        
        $type = $model->getNameType($alias);
        $result = $model->selectProductsByTypeLevel1($alias,$position,$qty);
        
        $price1 = $model->countProductsByTypeLevel1($alias,200000,1000000);
        $price2 = $model->countProductsByTypeLevel1($alias,1000000,5000000);
        $price3 = $model->countProductsByTypeLevel1($alias,5000000,10000000);
        $price4 = $model->countProductsByTypeLevel1($alias,10000000,20000000);
        $price5 = $model->countProductsByTypeLevel1($alias,0,0,20000000);
        
        
        if(count($result) == 0)
            $result = $model->selectProductsByTypeLevel2($alias,$position,$qty);

            $price1 = $model->countProductsByTypeLevel2($alias,200000,1000000);
            $price2 = $model->countProductsByTypeLevel2($alias,1000000,5000000);
            $price3 = $model->countProductsByTypeLevel2($alias,5000000,10000000);
            $price4 = $model->countProductsByTypeLevel2($alias,10000000,20000000);
            $price5 = $model->countProductsByTypeLevel2($alias,0,0,20000000);

        //print_r($price3); die;
        if(count($result)==0 || $type == ''){
            header('Location:404.html');
            return;
        }




        $data = [
            'result'=>$result,
            'nameType'=>$type,
            'showPagination'=>$showPagination,
            'price1'=>$price1->qty,
            'price2'=>$price2->qty,
            'price3'=>$price3->qty,
            'price4'=>$price4->qty,
            'price5'=>$price5->qty
        ];
        //print_r($data); die;

        return $this->loadView('type',$data);
    }

}



?>