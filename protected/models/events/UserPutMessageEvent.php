<?php
namespace models\events;

class UserPutMessageEvent  extends BaseEvent{
    public $message_id;
    
    public function Process() {
        $message = \ConversationMessage::getById($this->message_id);
        $conversation = \Conversation::getById($message->conversation_id);
        
        $user = \User::getById($conversation->user_id);
        $manager = \ShopUserModel::getById($conversation->shop_user_id);
        $mail = $manager->mail;
        $topic = 'Пользователь оставил вам сообщение';
        $text = self::createText($message, $user);
        
        \actionControllers\Mailer::send($text, $topic, $mail, MAIL_TYPE_ADD_COMMENT);
        
        return true;
    }
    
    protected function createText(\ConversationMessage $message, \User $user) {
        $text = "Пользователь <b>@name</b> оставил вам сообщение:<br /> @message <hr /> <a href='http://myby.com.ua/shopmanager/conversation/one/@conversation'>Перейти к цепочке сообщений</a> ";
        $text = str_replace('@name', $user->name.' '.$user->sname, $text);
        $text = str_replace('@message', $message->message, $text);
        $text = str_replace('@conversation', $message->conversation_id, $text);
        
        return $text;
    }
}