<?php
namespace models\events;

class AddOfferEvent  extends BaseEvent{
    public $offer_id;
    
    public function Process() {
        $offer = \Offer::getById($this->offer_id);
        $project = \Project::getActiveById($offer->project_id);
        $user = \User::getById($project->user_id);
        
        $this->sendNotificationToUser($user, $project);
        $this->sendNotificationToManagers($offer, $project);
        
        return true;
    }
    
    public function sendNotificationToUser(\User $user, \Project $project) {
        $link = \QuickLink::createLink('/public/project/'.$project->id, $user->id);
        $text = 'По Вашему заказу <a href="http://myby.com.ua/public/'.$link.'"> '.$project->title.' </a> есть новые предложения';
        $topic = 'Новые предложения на MyBy';
        $email = $user->mail;
        \actionControllers\Mailer::send($text, $topic, $email, MAIL_TYPE_NEW_PROJECT);
    }
    
    public function sendNotificationToManagers(\Offer $offer, \Project $project) {
        $offers = \Offer::getOffersForProject($project->id);
        $concurent = \ShopUserModel::getById($offer->shop_user_id);
        
        $shopUserIds = \helpers\DataExtractor::extractColumn($offers, 'shop_user_id');
        $text = 'Магазин <b>'.$concurent->name.'</b> оставил предложение на заказ "'.$project->title.'". <br />
        <a href="http://myby.com.ua/shopmanager/project/'.$project->id.'">Перейти к заказу</a>';
        
        \actionControllers\Mailer::sendToAllActiveManagers($text, 'оставленно предложение на заказ '.$project->title, MAIL_TYPE_CONCURENT_ADD_OFFER, $shopUserIds);
    }
}