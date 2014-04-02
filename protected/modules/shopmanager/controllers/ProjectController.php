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
        
        $data = $this->collectDataForProjectPage($id);
        if (!$data)
            return $this->render('invalid-project');
        
        $this->render('project', $data);
	}
    
    protected function collectDataForProjectPage($project_id) {
        $data = array();
        
        $data['project'] = Project::getActiveById($project_id);
        if (!$data['project']->id)
            return false;
        
        $data['add'] = new models\forms\AddProjectOffer();
        \actionControllers\addOffer::checkOfferSend($data['add'], $data['project']->id);
        $data['author'] = User::getById($data['project']->user_id);
        $data['offers'] = Offer::getOffersForProject($data['project']->id);
        $data['comments'] = Comment::getCommentsForOffers($data['offers']);
        $data['shopUsers'] = $this->getShopUsersForOffers($data['offers']);
        $data['showedContacts'] = $this->getShowedContacts($data['project']->id);
        $data['openUsers'] = User::getInfoByIds(helpers\DataExtractor::extractColumn($data['showedContacts'], 'user_id'));
        
        return $data;
    }
    
    protected function getShowedContacts($project_id) {
        return ShowedContacts::getAllContactsByProjectId($project_id);
        
    }
    
    protected function getShopUsersForOffers($offers) {
        $shopUserIds = helpers\DataExtractor::extractColumn($offers, 'shop_user_id');
        $shopUsers = ShopUserModel::getUsersByIds($shopUserIds);
        
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($shopUsers, 'id');
    }
    
}