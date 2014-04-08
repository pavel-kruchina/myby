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
        \vendor\vk\vk::sendNotification($user->viewer_id, "По Вашему заказу <".$project->title."> есть новые предложения");
    }
    
    public function sendNotificationToManagers(\Offer $offer, \Project $project) {
        $offers = \Offer::getOffersForProject($project->id);
        $concurent = \ShopUserModel::getById($offer->shop_user_id);
        
        $shopUserIds = \helpers\DataExtractor::extractColumn($offers, 'shop_user_id');
        $text = 'Ваш конкурент <b>'.$concurent->name.'</b> оставил предложение на заказ "'.$project->title.'". <br />
        <a href="http://myby.com.ua/shopmanager/project/'.$project->id.'">Перейти к заказу</a>';
        
        \actionControllers\Mailer::sendToAllActiveManagers($text, 'Конкурент оставил предложение на заказ', MAIL_TYPE_CONCURENT_ADD_OFFER, $shopUserIds);
    }
}