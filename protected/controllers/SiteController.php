<?php

class SiteController extends Controller
{
    public function init() {
        parent::init();
        
        Yii::app()->getClientScript()->registerCoreScript('jquery');
    }
    
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    
	public function actionIndex()
	{
		//$data = \actionControllers\getOfferList::getList();
        
        $data = $this->subscribeUser();
        $this->render('index', $data);
	}
    
    public function subscribeUser() {
        if (isset($_POST['mailSubmit'])) {
            $smail = new SubscribedMail();
            $smail->mail = $_POST['mail'];
            $smail->save();
            
            return array('mailSaved'=>true);
        }
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}