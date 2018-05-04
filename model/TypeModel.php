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
        $sql = "SELECT name,id_parent
                FROM categories c
                INNER JOIN page_url u 
                ON c.id_url = u.id
                WHERE u.url = '$alias'";
        return $this->loadOneRow($sql);
    }

    /**
     * 
     * 
     * 
            SELECT p.*
                FROM (
                    SELECT c.id, c.id_url,url.url FROM categories c 
                    INNER JOIN page_url url ON url.id = c.id_url 
                    WHERE c.id_parent IS NULL
                ) menu
                LEFT JOIN ( 
                    SELECT c.id_parent,c.id as idSub, url.url 
                    FROM `categories` c 
                    INNER JOIN page_url url ON url.id = c.id_url 
                    WHERE c.id_parent IS NOT NULL 
                ) sub 
                ON menu.id = sub.id_parent 
                INNER JOIN page_url url 
                ON url.id = menu.id_url
                LEFT JOIN products p 
                ON p.id_type = sub.idSub
                WHERE menu.url = 'iphone'
     */

    function selectProductsByTypeLevel1($alias){
        $sql = "SELECT p.*
                FROM (
                    SELECT c.id, c.id_url,url.url FROM categories c 
                    INNER JOIN page_url url ON url.id = c.id_url 
                    WHERE c.id_parent IS NULL
                ) menu
                LEFT JOIN ( 
                    SELECT c.id_parent,c.id as idSub, url.url 
                    FROM `categories` c 
                    INNER JOIN page_url url ON url.id = c.id_url 
                    WHERE c.id_parent IS NOT NULL 
                ) sub 
                ON menu.id = sub.id_parent 
                INNER JOIN page_url url 
                ON url.id = menu.id_url
                LEFT JOIN products p 
                ON p.id_type = sub.idSub
                WHERE menu.url = '$alias'";
        return $this->loadMoreRows($sql);           
    }
}



?>