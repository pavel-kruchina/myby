<?php
namespace actionControllers;

use \Yii;

class Mailer
{
	public static function send($text, $topic, $email) {
        $mail = self::confMail();
        
        $mail->Body = $text;
        $mail->Subject = $topic;
        $mail->addAddress($email);
        
        $mail->send();
                
        return true;
    }
    
    /**
     * @return \vendor\phpMailer\PHPMailer 
     */
    protected static function confMail() {
        $mail = new \vendor\phpMailer\PHPMailer;
        $mail->IsSMTP();
        $mail->isHTML();
        $mail->CharSet = 'UTF-8';

        $mail->Host       = "smtp.mandrillapp.com"; // SMTP server example
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "pavel.kruchina@gmail.com"; // SMTP account username example
        $mail->Password   = Yii::app()->params['mandrillAPIKey'];        // SMTP account password example
        
        $mail->From = 'info@myby.com.ua';
        $mail->FromName = 'MyBy';
        
        return $mail;
    }


    public static function broadcast($text, $topic, $emails) {
        foreach ($emails as $email) {
            self::send($text, $topic, $email);
        }
        
        return true;
    }
    
    public static function sendToAllActiveManagers($text, $topic) {
        $managers = \ShopUserModel::getAllActive();
        
        $emails = \helpers\DataExtractor::extractColumn($managers, 'mail');
        static::broadcast($text, $topic, $emails);
    }
}