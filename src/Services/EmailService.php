<?php

namespace App\Services;

use App\Config\Config;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private PHPMailer $mail;
    private string $email_sender; 
    
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->email_sender = Config::get('EMAIL_ADDRESS'); // ini email pengirim
        
        try {
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP server
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $this->email_sender; 
            $this->mail->Password = Config::get('EMAIL_PASSWORD'); // ini app password dari akun email pengirim
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;
            $this->mail->setFrom($this->email_sender, 'Trustmedis');
        } catch (Exception $e) {
            throw new Exception("Mailer Error: " . $e->getMessage());
        }
    }

    public function sendEmail(string $to, string $subject, string $body): bool
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($to);
            $this->mail->isHTML(false);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();

            return true;
        } catch (Exception $e) {
            error_log("Email could not be sent. Error: {$this->mail->ErrorInfo}");
            return false;
        }
    }
}
