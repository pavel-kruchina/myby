<?php

class ShopmanagerModule extends CWebModule
{
    private $_assetsUrl;

    public function init()
    {
        Yii::app()->setComponents(array(
			'user'=>array(
				'class'=>'ShopUser',
				'stateKeyPrefix'=>'su',
				'loginUrl'=>Yii::app()->createUrl($this->getId().'/login'),
			),
            
            'authManager' => array(
                'class' => 'application.components.PhpAuthManager',
                'defaultRoles' => array('guest'),
                'authFile' => Yii::getPathOfAlias('application.config.authShopRoles').'.php',
            ),
		), false);
        Yii::app()->getClientScript()->registerCoreScript('jquery');
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    /**
     * @return string the base URL that contains all published asset files of admin module.
     */
    public function getAssetsUrl()
    {
        if($this->_assetsUrl===null){
            $this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('shopmanager.assets'));
        }
        return $this->_assetsUrl;
    }

    /**
     * @param string $value the base URL that contains all published asset files of admin module.
     */
    public function setAssetsUrl($value)
    {
        $this->_assetsUrl=$value;
    }
}