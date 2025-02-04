<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

function sendCertificate($email, $file) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  
        $mail->Password = 'your-email-password';  
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'Training Team');
        $mail->addAddress($email);
        $mail->addAttachment($file);

        $mail->isHTML(true);
        $mail->Subject = 'Sertifikat Training';
        $mail->Body = "Halo, <br><br> Berikut sertifikat untuk training Anda. <br><br> Terima kasih.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
