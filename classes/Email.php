<?php

namespace Classes;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;


class Email
{
    public PHPMailer $mail;
    public function __construct($from = null, $name = null)
    {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPOptions = array(

        );

        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['EMAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $_ENV['EMAIL_USERNAME'];
        $this->mail->Password = $_ENV['EMAIL_PASSWORD'];
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = $_ENV['EMAIL_PORT'];
        $this->mail->CharSet = "UTF-8";
        $this->mail->AddReplyTo($from ?? $_ENV['EMAIL_FROM_ADDRESS'], $name ?? $_ENV['EMAIL_FROM_ADDRESS']);
        $this->mail->setFrom($from ?? $_ENV['EMAIL_FROM_ADDRESS'], $name ?? $_ENV['EMAIL_FROM_ADDRESS']);
        $this->mail->isHTML(true);
        $this->mail->addEmbeddedImage(__DIR__ . '/../public/images/logo.png', 'logo', 'logo.png');
    }

    public function generateEmail($subject = '', array $addresses = [], $body = ''): PHPMailer
    {
        $this->mail->Subject = $subject;

        foreach ($addresses as $key => $address) {
            $this->mail->addAddress($address);
        }
        $this->mail->Body = $body;

        return $this->mail;
    }
    public function send(): bool
    {
        return $this->mail->send();
    }
}

