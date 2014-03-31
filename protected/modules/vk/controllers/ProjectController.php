<?php

class ProjectController extends Controller
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
                'actions'=>array('index'),
                'users'=>array('@'),
            ),
            
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionIndex()
	{
        $id = (int)$_GET['id'];
        $this->checkDelete($id);
        
        
        $data = $this->collectDataForProjectPage($id);
        if (!$data)
            return $this->render('invalid-project');
        $this->render('project', $data);
	}
    
    protected function checkDelete($id) {
        if(!isset($_GET['delete']))
            return false;
        
        $project = Project::getActiveById($id);
        
        if ($project->user_id != Yii::app()->user->getId())
            return false;
        
        $project->deleted = 'yes';
        $project->save();
    }

    protected function collectDataForProjectPage($project_id) {
        $data = array();
        
        $data['project'] = Project::getActiveById($project_id);
        if (!$data['project']->id)
            return false;
        
        $data['addCommentForm'] = new models\forms\AddComment();
        $this->checkAddComment($data['addCommentForm']);
        
        $data['author'] = User::getById($data['project']->user_id);
        $data['offers'] = Offer::getOffersForProject($data['project']->id);
        $data['comments'] = Comment::getCommentsForOffers($data['offers']);
        
        $data['shopUsers'] = $this->getShopUsersForOffers($data['offers']);
        $data['showedContacts'] = $this->getShowedContacts($project_id);
        $data['showContactsForm'] = new models\forms\ShowContactsForm();
        return $data;
    }
    
    protected function checkAddComment($form) {
        \actionControllers\addComment::checkFormSend($form);
    }
    
    protected function getShowedContacts($project_id) {
        $contacts = ShowedContacts::getContactsByProjectId($project_id);
        
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($contacts, 'manager_id');
    }
    
    public function actionAjaxShowContacts() {
        return actionControllers\showContacts::processForm();
    }
    
    protected function getShopUsersForOffers($offers) {
        $shopUserIds = helpers\DataExtractor::extractColumn($offers, 'shop_user_id');
        $shopUsers = ShopUserModel::getUsersByIds($shopUserIds);
        
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($shopUsers, 'id');
    }
}