<?php

class MylistController extends Controller
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
        $data = \actionControllers\getOfferList::getUserListSmallPortion(Yii::app()->user->getId(), $page);
        $data['offersCount'] = $this->getOffersCountForProjects($data['projects']['records']);
        $data['page'] = $page;
        $data['add_project'] = (int)$_GET['add_project'];
        $data['pages'] = \helpers\Paginator::getPageList($data['projects']['count'], $page, OFFERS_ON_PAGE_FEW);
        $this->render('my_projects', $data);
  
	}
    
    protected function getOffersCountForProjects($projects) {
        $projectIds = helpers\DataExtractor::extractColumn($projects, 'id');
        $projectsOffersCount = Offer::getOffersCountByProjectIds($projectIds);
                
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($projectsOffersCount, 'project_id');
    }
    
}