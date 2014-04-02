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
        $page = (int)$_GET['page'];
        
        $data = \actionControllers\getOfferList::getList($page);
        $data['offersCount'] = $this->getOffersCountForProjects($data['projects']['records']);
        $data['page'] = $page;
        $data['pages'] = \helpers\Paginator::getPageList($data['projects']['count'], $page, OFFERS_ON_PAGE);
        
        $this->render('index', $data);
	}
    
    protected function getOffersCountForProjects($projects) {
        $projectIds = helpers\DataExtractor::extractColumn($projects, 'id');
        $projectsOffersCount = Offer::getOffersCountByProjectIds($projectIds);
                
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($projectsOffersCount, 'project_id');
    }
/*-----------*/
    
    
}