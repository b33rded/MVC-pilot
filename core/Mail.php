<?php
namespace Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {
    public $mail;
    public $error;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = getenv('SMTP_HOST');
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = getenv('SMTP_USER');
        $this->mail->Password   = getenv('SMTP_PASS');
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = getenv('SMTP_PORT');
    }

    public function confirmation($address, $code) {
        try {
            $this->mail->setFrom(getenv('SMTP_USER'), 'Php-blog');
            $this->mail->addAddress($address, 'dear user');
            $this->mail->addReplyTo(getenv('SMTP_USER'), 'Information');

            $this->mail->isHTML(true);
            $this->mail->Subject = 'Registration confirmation';
            $this->mail->Body    = 'Hello new user!</br> To complete your registration please click on a link below:</br> http://yourwebsite.com/register/verify/?email='.$address.'&code='.$code;
            $this->mail->AltBody = 'Hello new user! To complete your registration please click on a link below:';

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            $this->error = $this->mail->ErrorInfo;
            return false;
        }
    }
}