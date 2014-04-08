<?php
namespace models\events;

class AddCommentEvent  extends BaseEvent{
    public $comment_id;
    
    public function Process() {
        $comment = \Comment::getById($this->comment_id);
        $user = \User::getById($comment->user_id);
        $offer = \Offer::getById($comment->offer_id);
        $manager = \ShopUserModel::getById($offer->shop_user_id);
        $mail = $manager->mail;
        $topic = 'Пользователь ответил на ваше предложение';
        $text = self::createText($offer, $user);
        
        \actionControllers\Mailer::send($text, $topic, $mail, MAIL_TYPE_ADD_COMMENT);
        
        return true;
    }
    
    protected function createText(\Offer $offer, \User $user) {
        $text = "Пользователь <b>@name</b> ответил на ваше предложение <<@offer>>. <br /> <a href='http://myby.com.ua/shopmanager/project/@project'>Перейти к заказу</a> ";
        $text = str_replace('@name', $user->name.' '.$user->sname, $text);
        $text = str_replace('@offer', $offer->text, $text);
        $text = str_replace('@project', $offer->project_id, $text);
        
        return $text;
    }
}