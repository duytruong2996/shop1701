<?php
include_once 'DBConnect.php';

class HomeModel extends DBConnect{

    function selectSlide(){
        $sql = "SELECT * FROM slide WHERE status=1";
        return $this->loadMoreRows($sql);
    }
    /**
     * 
     * 
     *  SELECT menu.name, GROUP_CONCAT(sub.name) as submenu
     *  FROM (SELECT * FROM `categories` WHERE id_parent IS NULL) menu
     *  LEFT JOIN (SELECT * FROM `categories` WHERE id_parent IS NOT NULL) sub 
     *      ON menu.id = sub.id_parent
     *  GROUP BY menu.name
     *  ORDER BY submenu DESC
     */
}


?>