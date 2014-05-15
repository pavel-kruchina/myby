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
                'actions'=>array('index', 'one'),
                'users'=>array('@'),
            ),
            
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
    
    protected function AddShopUserMessage($conversation_id, $messageText) {
        $message = new ConversationMessage();
        $message->message = $messageText;
        $message->author_type = 'shop_user';
        $message->conversation_id = $conversation_id;
        $message->create_date = helpers\Date::getCurrent();
        $message->save();
        
        $conversation = Conversation::getById($conversation_id);
        $conversation->setUserUnread();
        $conversation->save();
        
        $this->createAddMessageEvent($message);
    }
    
    protected function createAddMessageEvent(ConversationMessage $message) {
        $event = new models\events\ShopUserPutMessageEvent();
        $event->message_id = $message->id;
        $event->create();
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
                $this->AddShopUserMessage($conversation->id, $form->message);
                $form->message = '';
            }
        }
    } 
    
    protected function collectDataForConversationPage($id) {
        $conversation = Conversation::getByIdForShopUserId($id, Yii::app()->user->getId());
        if (!$conversation)
            return false;
        
        $this->setConversationRead($conversation);
        $addForm = new \models\forms\AddMessageForm();
        
        $this->checkAddMessage($addForm, $conversation);
        
        $messages = ConversationMessage::getMessagesByConversationId($conversation->id);
        $user = User::getById($conversation->user_id);
        
        return array('conversation'=>$conversation, 'messages'=>$messages, 'user'=>$user, 'addForm'=>$addForm);
    }

    protected function setConversationRead(Conversation $conversation) {
        if ($conversation->shop_user_unread=='yes') {
            $conversation->setShopUserRead();
            $conversation->save();
        }
    }

    public function actionIndex()
	{
        $page = (int)$_GET['page'];
        $conversations = Conversation::getConversationsForShopUserId(Yii::app()->user->getId(), $page);
        $users = $this->getUsersForConversations($conversations['records']);
        
        $this->render('index', array('conversations'=>$conversations, 'users'=>$users, 'pages' => \helpers\Paginator::getPageList($conversations['count'], $page, CONVERSATIONS_ON_PAGE) ));
	}
    
    protected function getUsersForConversations($conversations) {
        $userIds = helpers\DataExtractor::extractColumn($conversations, 'user_id');
        $users = User::getUsersByIds($userIds);
                
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($users, 'id');
    }
    
    
}