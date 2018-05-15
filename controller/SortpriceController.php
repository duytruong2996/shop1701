<?php
include_once "model/TypeModel.php";
include_once "model/SortPriceModel.php";
include_once 'BaseController.php';

class SortpriceController extends BaseController{
    function sort(){
        $arrPrice = explode('-',$_GET['priceSend']);
        $minPrice = $arrPrice[0];
        $maxPrice = isset($arrPrice[1]) ? $arrPrice[1] : 0;

        $alias = isset($_GET['alias']) ? $_GET['alias'] : '';
        $model = new SortpriceModel;
    
        $typeModel = new TypeModel();
        $result = $typeModel->selectProductsByTypeLevel1($alias);

        if($maxPrice != 0){
            //search by between
            
            if(count($result) == 0){
                $products = $model->getProductsByTypeLevel2($alias,$minPrice,$maxPrice);
            }
            else{
                $products = $model->getProductsByTypeLevel1($alias,$minPrice,$maxPrice);
            }
        }
        else{
            //search > min
            if(count($result) == 0){
                $products = $model->getProductsByTypeLevel2($alias,0,0,$minPrice);
            }
            else{
                $products = $model->getProductsByTypeLevel1($alias,0,0,$minPrice);
            }
        }
        $data = [
            'products'=>$products,
            'data-id'=>$_GET['priceSend'],
            'id'=>$_GET['id']
        ];
        return $this->loadHtmlSortPrice("sort_price",$data);

    }
}


?>