<?php
include 'controller/CheckoutController.php';

$c = new CheckoutController;

return isset($_POST['btnCheckout']) ? $c->postCheckout() : $c->getCheckout();


?>