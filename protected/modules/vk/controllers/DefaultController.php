<?php

class DefaultController extends Controller
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
        Yii::app()->user->checkUser();
        
        //if($this->isFirstFrame())
            $this->initialRedirect();
        /*
        $page = (int)$_GET['page'];
        $data = \actionControllers\getOfferList::getListSmallPortion($page);
        $data['offersCount'] = $this->getOffersCountForProjects($data['projects']['records']);
        $data['page'] = $page;
        $data['pages'] = \helpers\Paginator::getPageList($data['projects']['count'], $page, OFFERS_ON_PAGE_FEW);
        $this->render('index', $data);*/
	}
    
    protected function isFirstFrame() {
        if (Yii::app()->request->getParam('firstFrame')) {
            return true;
        }
        
        return false;
    }
    
    protected function initialRedirect() {
        //$projects = Project::getActiveRecordsForUserId(Yii::app()->user->getId());
        
        //if(count((array)$projects))
            Yii::app()->request->redirect('/vk/about');
    }
        
    protected function getOffersCountForProjects($projects) {
        $projectIds = helpers\DataExtractor::extractColumn($projects, 'id');
        $projectsOffersCount = Offer::getOffersCountByProjectIds($projectIds);
                
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($projectsOffersCount, 'project_id');
    }
/*-----------*/
    
    public function actionAbout() {
        $this->render('about', array());
    }
}