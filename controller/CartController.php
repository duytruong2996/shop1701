<?php
include_once 'BaseController.php';
include_once 'model/CartModel.php';
include_once 'helper/Cart.php';
session_start();

class CartController extends BaseController{
    function shoppingCart(){
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        $data = [
            'cart'=>$cart
        ];
        //print_r($cart); die;
        return $this->loadView('cart', $data);
    }

    function addToCart(){

        $id = isset($_POST['idProduct']) ? $_POST['idProduct'] : 0;
        if($id==0){
            echo "error";
            return;
        }
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
        $model = new CartModel;
        $result = $model->selectProductById($id);
        //print_r($result);
        
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        
        $cart = new Cart($oldCart);
        $cart->add($result,$quantity);

        $_SESSION['cart'] = $cart;
        echo $result->name;
    }
}

?>