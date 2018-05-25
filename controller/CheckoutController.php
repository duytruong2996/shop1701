<?php
require_once 'BaseController.php';
require_once 'model/CheckoutModel.php';
require_once 'helper/Cart.php';
require_once 'helper/functions.php';
require_once "helper/PHPMailer/mailer.php";

session_start();

class CheckoutController extends BaseController{
    function __construct(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

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

            $token = createToken();
            
            $tokenDate = date('Y-m-d H:i:s');
            $tokenTime = strtotime($tokenDate);
            $idBill = $model->saveBill($idCustomer, $dateOrder, $total, $promtPrice,$paymentMethod, $note,$token , $tokenDate);

            if($idBill){
                foreach($cart->items as $idProduct=>$item){
                    $qty = $item['qty'] ;
                    $price = $item['price'];
                    $detail = $model->saveBillDetail($idBill, $idProduct,$qty, $price);
                }
                
                //gui mail cho cus
                $link = "http://localhost/shop1701/$token/$tokenTime";
                $subject = "SHOP 1701 - XÁC NHẬN ĐƠN HÀNG";
                $content = "
                Chào bạn $name,
                <br/>
                .....
                <br/>
                Vui lòng nhấp vào link sau để xác nhận đơn hàng của bạn:
                $link
                ";

                sendMail($email, $name, $subject, $content);
                unset($_SESSION['cart']);
                $_SESSION['message_success'] = "Đặt hàng thành công, vui lòng kiểm tra email để xác nhận đơn hàng";
            }

        }
        else{
            $_SESSION['message_error'] = "Đặt hàng không thành công, vui lòng kiểm tra lại";
        }
        header('Location:checkout.php');
    }

    function getConfirmOrder(){
        $token = $_GET['token'];
        $oldTime = $_GET['tokentime'];

        $model = new CheckoutModel();
        $bill = $model->findBillByToken($token);
        if($bill){
            $today = strtotime(date("Y-m-d H:i:s",time())); 
            
            if($today - $oldTime <= 86400 ){
               //xac nhan don hang bang cach update status=1, xoa token&tokendate
                $model->updateStatusBill($token);
                $_SESSION['message_success'] = "Xác nhận đơn hàng thành công. Cảm ơn bạn, chúng tôi sẽ sớm liên hệ  với bạn ......";
            }
            else{
                $_SESSION['message_error'] = "Thời gian xác nhận đơn hàng đã hết hạng, vui lòng đặt hàng lại";
            }
        }
        else{
            $_SESSION['message_error'] = "Liên kết bạn nhập vào không hợp lệ, vui lòng kiểm tra lại";
        }
        header('Location:http://localhost/shop1701/checkout.php');
    }
}

?>