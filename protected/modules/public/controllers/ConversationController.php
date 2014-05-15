<?php

class ConversationController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index', 'create', 'one'),
                'users'=>array('@'),
            ),
            
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionCreate() {
        if (models\forms\CreateConversationForm::sent())
        {
            echo json_encode($this->tryCreate());
        }
        Yii::app()->end();
    }
    
    protected function tryCreate() {
        $form = new \models\forms\CreateConversationForm();
        $form->autoFill();
        if (!$form->validate())
            return array('is_error'=>true, 'errors'=>$form->getErrors());
        
        $conversation_id = $this->createConversation($form);
        $this->addUserMessage($conversation_id, $form->message);
        
        return array('is_error'=>false, 'url'=>'public/conversation/one/'.$conversation_id);
    }
    
    protected function AddUserMessage($conversation_id, $messageText) {
        $message = new ConversationMessage();
        $message->message = $messageText;
        $message->author_type = 'user';
        $message->conversation_id = $conversation_id;
        $message->create_date = helpers\Date::getCurrent();
        $message->save();
        
        $conversation = Conversation::getById($conversation_id);
        $conversation->setShopUserUnread();
        $conversation->save();
        
        $this->createAddMessageEvent($message);
    }
    
    protected function createAddMessageEvent(ConversationMessage $message) {
        $event = new models\events\UserPutMessageEvent();
        $event->message_id = $message->id;
        $event->create();
    }

    protected function createConversation(\models\forms\CreateConversationForm $form) {
        $offer = Offer::getById($form->offer_id);
        $project = Project::getActiveById($offer->project_id);
        
        $conversation = new Conversation();
        $conversation->create_date = helpers\Date::getCurrent();
        $conversation->user_id = Yii::app()->user->getId();
        $conversation->shop_user_id = $offer->shop_user_id;
        $conversation->title = $project->title;
        $conversation->user_unread = 'no';
        $conversation->shop_user_unread = 'yes';
        
        $conversation->save();
        $this->addFirstMessageToConversation($conversation, $offer);
        
        return $conversation->id;
    }
    
    protected function addFirstMessageToConversation(Conversation $conversation, Offer $offer) {
        $message = new ConversationMessage();
        $message->message = $offer->text;
        $message->author_type = 'shop_user';
        $message->conversation_id = $conversation->id;
        $message->create_date = $offer->date;
        
        $message->save();
    }
    
    public function actionOne() {
        $id = (int)$_GET['id'];
        $data = $this->collectDataForConversationPage($id);
        if (!$data)
            return $this->render('invalid-conversation');
        
        $this->render('one', $data);
    }
    
    protected function checkAddMessage(\models\forms\AddMessageForm $form, Conversation $conversation) {
        if (\models\forms\AddMessageForm::sent()) {
            $form->autoFill();
            if ($form->validate()) {
                $this->AddUserMessage($conversation->id, $form->message);
                $form->message = '';
            }
        }
    } 
    
    protected function collectDataForConversationPage($id) {
        $conversation = Conversation::getByIdForUserId($id, Yii::app()->user->getId());
        if (!$conversation)
            return false;
        $this->setConversationRead($conversation);
        $addForm = new \models\forms\AddMessageForm();
        
        $this->checkAddMessage($addForm, $conversation);
        
        $messages = ConversationMessage::getMessagesByConversationId($conversation->id);
        $shopUser = ShopUserModel::getById($conversation->shop_user_id);
        
        return array('conversation'=>$conversation, 'messages'=>$messages, 'shopUser'=>$shopUser, 'addForm'=>$addForm);
    }

    protected function setConversationRead(Conversation $conversation) {
        if ($conversation->user_unread=='yes') {
            $conversation->setUserRead();
            $conversation->save();
        }
    }

    public function actionIndex()
	{
        $page = (int)$_GET['page'];
        $conversations = Conversation::getConversationsForUserId(Yii::app()->user->getId(), $page);
        $shopUsers = $this->getShopUsersForConversations($conversations['records']);
        
        $this->render('index', array('conversations'=>$conversations, 'shopUsers'=>$shopUsers, 'pages' => \helpers\Paginator::getPageList($conversations['count'], $page, CONVERSATIONS_ON_PAGE) ));
	}
    
    protected function getShopUsersForConversations($conversations) {
        $shopUserIds = helpers\DataExtractor::extractColumn($conversations, 'shop_user_id');
        $shopUsers = ShopUserModel::getUsersByIds($shopUserIds);
                
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($shopUsers, 'id');
    }
    
    
}