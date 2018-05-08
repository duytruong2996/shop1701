<?php
include_once 'DBConnect.php';

class DetailModel extends DBConnect{

    function  selectDetailProduct($alias,$id){
        $sql = "SELECT p.*, u.url
                FROM products p
                INNER JOIN page_url u
                ON p.id_url = u.id
                WHERE url= '$alias' AND p.id=$id";
        return $this->loadOneRow($sql);
    }

    function selectRelatedProduct($idType,$idProduct){
        $sql = "SELECT p.*, u.url
                FROM `products` p 
                INNER JOIN page_url u 
                ON u.id = p.id_url
                WHERE id_type = $idType
                AND p.id <> $idProduct";
        return $this->loadMoreRows($sql);
    }


}


?>