<?php
include_once 'DBConnect.php';

class BaseModel extends DBConnect{

    function selectCategories(){
        $sql = "SELECT url.url, menu.name, menu.icon,  GROUP_CONCAT(sub.name, '::' ,sub.url ) as submenu 
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
        ORDER BY submenu DESC";

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