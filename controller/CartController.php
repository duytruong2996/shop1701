<?php
include_once 'model/CartModel.php';
include_once 'helper/Cart.php';
session_start();

class CartController{
    function addToCart(){

        $id = $_POST['idProduct'];
        $model = new CartModel;
        $result = $model->selectProductById($id);
        //print_r($result);
        
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        
        $cart = new Cart($oldCart);
        $cart->add($result);

        $_SESSION['cart'] = $cart;
        echo $result->name;
    }
}

?>