<?php
function sendMail($emailReceive, $nameReceive, $subject, $content){
    require 'src/PHPMailer.php';

    $mail = new PHPMailer(true);    // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;    // Enable verbose debug output
        $mail->isSMTP();       // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;   // Enable SMTP authentication
        $mail->Username = 'huonghuong08.php@gmail.com';    // SMTP username
        $mail->Password = 'qwertyuiop123@';         // SMTP password
        $mail->SMTPSecure = 'tls';     // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;     // TCP port to connect to // 465

        //Recipients
        $mail->setFrom('huonghuong08.php@gmail.com', 'Huong');
        $mail->addAddress($emailReceive, $nameReceive);

        $mail->addReplyTo('huonghuong08.php@gmail.com', 'Huong');
        
        //Content
        $mail->isHTML(true);         // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->send();
        return true;
    } 
    catch (Exception $e) {
        return false;
    }

}

?>