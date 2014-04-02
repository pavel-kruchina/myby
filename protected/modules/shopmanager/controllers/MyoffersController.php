<?php

class MyoffersController extends Controller
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
        $page = (int)$_GET['page'];
                
        $offers = Offer::getOffersByManager(Yii::app()->user->getId());
        $data['projects'] = Project::getActiveRecordsByIds(helpers\DataExtractor::extractColumn($offers, 'project_id'), $page);
        $data['offersCount'] = $this->getOffersCountForProjects($data['projects']['records']);
        $data['page'] = $page;
        $data['pages'] = \helpers\Paginator::getPageList($data['projects']['count'], $page, OFFERS_ON_PAGE);
        
        $this->render('mylist', $data);
	}
    
    protected function getOffersCountForProjects($projects) {
        $projectIds = helpers\DataExtractor::extractColumn($projects, 'id');
        $projectsOffersCount = Offer::getOffersCountByProjectIds($projectIds);
                
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($projectsOffersCount, 'project_id');
    }
/*-----------*/
    
    
}