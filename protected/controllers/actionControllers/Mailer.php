<?php
namespace actionControllers;

use \Yii;

class Mailer
{
	public static function send($text, $topic, $email) {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: MyBy <info@myby.com.ua>' . "\r\n";
        
        mail($email, $topic, $text, $headers, '-finfo@myby.com.ua');
        return true;
    }
    
    public static function broadcast($text, $topic, $emails) {
        foreach ($emails as $email) {
            static::send($text, $topic, $email);
        }
    }
    
    public static function sendToAllActiveManagers($text, $topic) {
        $managers = \ShopUserModel::getAllActive();
        
        $emails = \helpers\DataExtractor::extractColumn($managers, 'mail');
        static::broadcast($text, $topic, $emails);
    }
}