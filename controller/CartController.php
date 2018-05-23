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

    function updateCart(){
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
        $cart->update($result,$quantity);

        $_SESSION['cart'] = $cart;
        $res = [
            'discountPrice' => number_format($cart->items[$id]['discountPrice']),
            'totalPrice' => number_format($cart->totalPrice),
            'promtPrice' => number_format($cart->promtPrice)
        ];
        echo json_encode($res); // arr->json
        //   json_decode($str) // json->arr

    }

    function deleteCart(){
        $id = isset($_POST['idProduct']) ? $_POST['idProduct'] : 0;
        if($id==0){
            echo "error";
            return;
        }
        
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        $_SESSION['cart'] = $cart;
        $res = [
            'totalPrice' => number_format($cart->totalPrice),
            'promtPrice' => number_format($cart->promtPrice)
        ];
        echo json_encode($res);
    }
}

?>