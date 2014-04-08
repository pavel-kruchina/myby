<?php
namespace actionControllers;

use \Yii;

class Mailer
{
	public static function send($text, $topic, $email, $mail_type) {
        $mail = self::confMail($mail_type);
        
        $mail->Body = $text;
        $mail->Subject = $topic;
        $mail->addAddress($email);
        
        $mail->send();
                
        return true;
    }
    
    /**
     * @return \vendor\phpMailer\PHPMailer 
     */
    protected static function confMail($mail_type) {
        $mail = new \vendor\phpMailer\PHPMailer;
        $mail->IsSMTP();
        $mail->isHTML();
        $mail->CharSet = 'UTF-8';

        $mail->Host       = "smtp.mandrillapp.com"; // SMTP server example
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "pavel.kruchina@gmail.com"; // SMTP account username example
        $mail->Password   = Yii::app()->params['mandrillAPIKey'][$mail_type];        // SMTP account password example
        
        $mail->From = 'info@myby.com.ua';
        $mail->FromName = 'MyBy';
        
        return $mail;
    }


    public static function broadcast($text, $topic, $emails, $mail_type) {
        foreach ($emails as $email) {
            self::send($text, $topic, $email, $mail_type);
        }
        
        return true;
    }
    
    public static function sendToAllActiveManagers($text, $topic, $mail_type, $except=array()) {
        $managers = \ShopUserModel::getAllActive($except);
        
        $emails = \helpers\DataExtractor::extractColumn($managers, 'mail');
        static::broadcast($text, $topic, $emails, $mail_type);
    }
}