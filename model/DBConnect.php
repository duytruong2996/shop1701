<?php
class DBConnect{

    private $connect;

    function __construct($dbName = 'apple',$user = 'root',$password = ''){
        try{
            $this->connect = new PDO("mysql:host=localhost;dbname=$dbName",$user,$password);
            $this->connect->exec('set names utf8');
        }
        catch(Exception $e){
            echo $e->getMessage();
            die;
        }
    }

    function setStatement($query,$params = []){
        $stmt = $this->connect->prepare($query);

        foreach($params as $key => $p){
            $stmt->bindValue(($key+1),$p);             
        }
        return $stmt;
    }

    //INSERT | UPDATE | DELETE
    function executeQuery($query,$params = []){
        $stmt = $this->setStatement($query,$params);
        return $stmt->execute(); //bool(true/false)
    }

    // SELECT 1 ROW
    function loadOneRow($query,$params = []){
        $stmt = $this->setStatement($query,$params);        
        $result = $stmt->execute();
        if($result){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    // SELECT MORE ROWS
    function loadMoreRows($query,$params = []){
        $stmt = $this->setStatement($query,$params);

        $result = $stmt->execute();
        if($result){
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return false;        
    }

}








?>