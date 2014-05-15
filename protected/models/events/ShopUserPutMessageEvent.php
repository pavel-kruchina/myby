<?php
namespace models\events;

class ShopUserPutMessageEvent  extends BaseEvent{
    public $message_id;
    
    public function Process() {
        $message = \ConversationMessage::getById($this->message_id);
        $conversation = \Conversation::getById($message->conversation_id);
        
        $user = \User::getById($conversation->user_id);
        $manager = \ShopUserModel::getById($conversation->shop_user_id);
        $mail = $user->mail;
        $topic = 'Магазин оставил вам сообщение';
        $text = self::createText($message, $manager, $user);
        
        \actionControllers\Mailer::send($text, $topic, $mail, MAIL_TYPE_ADD_COMMENT);
        
        return true;
    }
    
    protected function createText(\ConversationMessage $message, \ShopUserModel $shopUser, \User $user) {
        $link = \QuickLink::createLink('/public/conversation/one/'.$message->conversation_id, $user->id);
        $text = "Магазин <b>@name</b> оставил вам сообщение:<br /> @message <hr /> <a href='http://myby.com.ua/public/@link'>Перейти к цепочке сообщений</a> ";
        $text = str_replace('@name', $shopUser->name, $text);
        $text = str_replace('@message', $message->message, $text);
        $text = str_replace('@link', $link, $text);
        
        return $text;
    }
}