<?php

include_once 'DBConnect.php';

class TypeModel extends DBConnect{

    //UPDATE products SET id_type=id_type-1
    function selectProductsByTypeLevel2($alias,$position=0,$qty = 0){
        $sql = "SELECT p.*, u.url
                FROM products p 
                INNER JOIN (
                    SELECT c.* 
                    FROM categories c
                    INNER JOIN page_url u 
                    ON u.id = c.id_url
                    WHERE u.url = '$alias'
                ) type
                ON p.id_type = type.id
                INNER JOIN page_url u 
                ON p.id_url = u.id";
        if($qty != 0)
                $sql.=" LIMIT $position,$qty";
        
        return $this->loadMoreRows($sql);
    }
    function getNameType($alias){
        $sql = "SELECT name,id_parent
                FROM categories c
                INNER JOIN page_url u 
                ON c.id_url = u.id
                WHERE u.url = '$alias'";
        return $this->loadOneRow($sql);
    }


    function selectProductsByTypeLevel1($alias,$position=0, $qty=0){
        $sql = "SELECT p.*, pu.url
                FROM products p 
                INNER JOIN(
                    SELECT c.*
                    FROM categories c 
                    WHERE c.id_parent = (
                        SELECT c2.id 
                        FROM categories c2
                        INNER JOIN page_url u 
                        ON u.id = c2.id_url
                        WHERE u.url = '$alias'
                    )
                ) type 
                ON type.id = p.id_type
                INNER JOIN page_url pu 
                ON pu.id = p.id_url";
        if($qty != 0)
            $sql.=" LIMIT $position,$qty";
        return $this->loadMoreRows($sql);           
    }
    function countProductsByTypeLevel1($alias,$minPrice=0,$maxPrice=0, $priceWhere=0 ){
        $sql = "SELECT count(p.id) as qty
                FROM products p 
                INNER JOIN(
                    SELECT c.*
                    FROM categories c 
                    WHERE c.id_parent = (
                        SELECT c2.id 
                        FROM categories c2
                        INNER JOIN page_url u 
                        ON u.id = c2.id_url
                        WHERE u.url = '$alias'
                    )
                ) type 
                ON type.id = p.id_type
                INNER JOIN page_url pu 
                ON pu.id = p.id_url";
        if($minPrice != 0 && $maxPrice !=0)
            $sql.=" WHERE price BETWEEN $minPrice AND $maxPrice";
        if($priceWhere != 0 )
            $sql.=" WHERE price > $priceWhere";
        return $this->loadMoreRows($sql);           
    }
}



?>