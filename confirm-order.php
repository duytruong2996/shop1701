<?php
include 'controller/CheckoutController.php';

$c = new CheckoutController;

return $c->getConfirmOrder();
 


?>