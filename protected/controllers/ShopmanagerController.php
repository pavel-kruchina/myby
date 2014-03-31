<?php

class ShopmanagerController extends Controller
{
    
    public function init() {
        parent::init();
        $this->setShopUser();
        Yii::app()->getClientScript()->registerCoreScript('jquery');
    }
    
    protected function setShopUser() {
        Yii::app()->setComponents(array(
			'user'=>array(
				'class'=>'application.components.ShopUser',
				'stateKeyPrefix'=>'shopuser',
				'loginUrl'=>Yii::app()->createUrl($this->getId().'/default/login'),
			),
		), false);
    }

    /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{        
        if (yii::app()->user->isGuest) 
            return $this->actionLogin();
        
        $this->indexPage();
	}
    
    protected function indexPage() {
        $page = (int)$_GET['page'];
        
        $data = \actionControllers\getOfferList::getList();
        $data['offersCount'] = $this->getOffersCountForProjects($data['projects']['records']);
        $data['page'] = $page;
        $data['pages'] = \helpers\Paginator::getPageList($data['projects']['count'], $page, OFFERS_ON_PAGE);
        
        $this->render('index', $data);
    }
    
    public function actionMyOffers()
	{        
        if (yii::app()->user->isGuest) 
            return $this->actionLogin();
        
        $this->myOffersPage();
	}
    
    protected function myOffersPage() {
        $page = (int)$_GET['page'];
                
        $offers = Offer::getOffersByManager(Yii::app()->user->getId());
        $data['projects'] = Project::getActiveRecordsByIds(helpers\DataExtractor::extractColumn($offers, 'project_id'), $page);
        $data['offersCount'] = $this->getOffersCountForProjects($data['projects']['records']);
        $data['page'] = $page;
        $data['pages'] = \helpers\Paginator::getPageList($data['projects']['count'], $page, OFFERS_ON_PAGE);
        
        $this->render('mylist', $data);
    }
    
    public function actionLogin() {
        $form = new models\forms\ShopUserLogin();
        if (actionControllers\shopUserLogin::Login($form))
            Yii::app()->request->redirect('/shopmanager/');
        
        $this->render('login', array('loginForm'=>$form));
    }
    
    public function actionProject() {
        if (yii::app()->user->isGuest) 
            return $this->actionLogin();
        
        $this->projectPage();
    }
    
    protected function projectPage() {
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
    
    protected function getOffersCountForProjects($projects) {
        $projectIds = helpers\DataExtractor::extractColumn($projects, 'id');
        $projectsOffersCount = Offer::getOffersCountByProjectIds($projectIds);
                
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($projectsOffersCount, 'project_id');
    }
    
    protected function getShowedContacts($project_id) {
        return ShowedContacts::getAllContactsByProjectId($project_id);
        
    }
    
    protected function getShopUsersForOffers($offers) {
        $shopUserIds = helpers\DataExtractor::extractColumn($offers, 'shop_user_id');
        $shopUsers = ShopUserModel::getUsersByIds($shopUserIds);
        
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($shopUsers, 'id');
    }
    
    public function actionLogout()
	{
		Yii::app()->user->logout();
		Yii::app()->request->redirect('/shopmanager/');
	}
}