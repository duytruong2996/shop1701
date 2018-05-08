<?php
include_once 'DBConnect.php';

class HomeModel extends DBConnect{

    function selectSlide(){
        $sql = "SELECT * FROM slide WHERE status=1";
        return $this->loadMoreRows($sql);
    }

    function selectFeatureProduct(){
        $sql = "SELECT p.*, u.url 
                FROM products p
                INNER JOIN page_url u
                ON p.id_url = u.id
                WHERE status = 1";
        return $this->loadMoreRows($sql);
    }

    function selectBestSeller(){
        $sql = "SELECT p.*, u.url, sum(bd.quantity) as tongsoluong
                FROM products p
                INNER JOIN bill_detail bd
                ON p.id = bd.id_product
                INNER JOIN page_url u
                ON u.id = p.id_url
                GROUP BY bd.id_product
                ORDER BY tongsoluong DESC
                LIMIT 0,10";
        return $this->loadMoreRows($sql);        
    }

    /*
        SELECT url.url, menu.name, GROUP_CONCAT(sub.name, '::' ,sub.url ) as submenu 
        FROM (
            SELECT * FROM `categories` WHERE id_parent IS NULL
        ) menu 
        LEFT JOIN ( 
            SELECT c.*, url.url 
            FROM `categories` c 
            INNER JOIN page_url url ON url.id = c.id_url 
            WHERE c.id_parent IS NOT NULL 
        ) sub 
        ON menu.id = sub.id_parent 
        INNER JOIN page_url url 
        ON url.id = menu.id_url 
        GROUP BY menu.name 
        ORDER BY submenu DESC

    */

    


}


?>