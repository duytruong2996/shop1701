<?php
require_once 'BaseController.php';
require_once 'model/CheckoutModel.php';
require_once 'helper/Cart.php';
session_start();

class CheckoutController extends BaseController{

    function getCheckout(){
        return $this->loadView('checkout');
    }

    function postCheckout(){
        //print_r($_POST);
        $name = $_POST['fullname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        $paymentMethod = $_POST['payment_method'];

        $model = new CheckoutModel();
        //save cus
        $idCustomer = $model->saveCustomer($name, $email, $gender, $address, $phone);
        if($idCustomer){
            //save bill

            $cart = $_SESSION['cart'];

            $dateOrder = date('Y-m-d');
            $total = $cart->totalPrice;
            $promtPrice = $cart->promtPrice;
            $token = "sdfghsdfddcsfref23456taedfv";
            $tokenDate = date('Y-m-d H:i:s');
            $idBill = $model->saveBill($idCustomer, $dateOrder, $total, $promtPrice,$paymentMethod, $note,$token , $tokenDate);

            if($idBill){
                foreach($cart->items as $idProduct=>$item){
                    $qty = $item['qty'] ;
                    $price = $item['price'];
                    $detail = $model->saveBillDetail($idBill, $idProduct,$qty, $price);
                }
                echo 'success';die;
                //gui mail cho cus

                //thong bao cho customer
                //thanh cong
            }

        }
        else{
            //error
        }
        
    }
}

?>