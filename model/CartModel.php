<?php
include_once "DBConnect.php";

class CartModel extends DBConnect{
    function selectProductById($id){
        $sql = "SELECT * FROM products WHERE id=$id";
        return $this->loadOneRow($sql);
    }
}


?>