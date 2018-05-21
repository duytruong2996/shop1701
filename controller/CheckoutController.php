<?php
require_once 'BaseController.php';

class CheckoutController extends BaseController{

    function getCheckout(){
        return $this->loadView('checkout');
    }
}

?>