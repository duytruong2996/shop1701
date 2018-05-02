<?php

include_once 'DBConnect.php';

class TypeModel extends DBConnect{

    //UPDATE products SET id_type=id_type-1
    function selectProductsByTypeLevel2($alias){
        $sql = "SELECT p.*, u.url
                FROM products p
                INNER JOIN page_url u
                ON p.id_type = u.id
                WHERE u.url = '$alias'";
        return $this->loadMoreRows($sql);
    }
    function getNameType($alias){
        $sql = "SELECT name 
                FROM categories c
                INNER JOIN page_url u 
                ON c.id_url = u.id
                WHERE u.url = '$alias'";
        return $this->loadOneRow($sql);
    }
}



?>