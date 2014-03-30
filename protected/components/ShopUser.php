<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class ShopUser extends CWebUser{
    public function init()
	{ 
		Yii::app()->getSession()->open();
        
        if ($this->isGuest)
            $this->checkAutoLogin();
        else  {
            $this->getUserData()->updateLastVisit();
        }
	}
    
    protected function checkAutoLogin() {
        
    }
    
    public function login(ShopUserModel $user) {
        $user->updateLastVisit();
        
        $this->setUserData($user);
        $this->setId($user['id']);
    }
    
    /*
     * $return ShopUserModel
     */
    public function getUserData() {
        return $this->getState('userData');
    }
    
    public function setUserData(ShopUserModel $user) {
        return $this->setState('userData', $user);
    }
    
    public function checkUser() {
        return false;
    }
    
    public function isShopManager() {
        return true;
    }
}