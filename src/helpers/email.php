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
        $mail->Username = 'isa.itukeren0104@gmail.com';  
        $mail->Password = 'kewrenitugua0104';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('isa.itukeren0104@gmail.com', 'Training Team');
        $mail->addAddress($email);
        $mail->addAttachment($file);

        $mail->isHTML(true);
        $mail->Subject = 'Sertifikat Training';
        $mail->Body = "Halo, <br><br> Berikut sertifikat untuk training Anda. <br><br> Terima kasih.";

        // Menambahkan debugging
        $mail->SMTPDebug = 2; // Menampilkan pesan debug (0 untuk tidak ada output, 2 untuk debugging)

        $mail->send();
        return true;
    } catch (Exception $e) {
        file_put_contents("debug.log", 'Mailer Error: ' . $mail->ErrorInfo . PHP_EOL, FILE_APPEND);
        return false;
    }
}
?>
