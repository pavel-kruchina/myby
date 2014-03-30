<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class WebUser extends CWebUser{
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
        $this->checkVkUser();
    }

    protected function checkVkUser() {
        $viewer_id = \vendor\vk\vk::getVkViewerId();
        if (!$viewer_id)
            return false;
        
        if (!$this->existVkUserInDB($viewer_id)) {
            $this->createAndLoginVkUser($viewer_id);
        } else {
            $this->loginVkUser($viewer_id);
        }
    }
    
    protected function existVkUserInDB($viewer_id) {
        $result = User::model()->exists('viewer_id=:viewer_id', array(':viewer_id'=>$viewer_id));
        
        return $result;
    }
    
    protected function createAndLoginVkUser($viewer_id) {
        $this->createVkUser($viewer_id);
        $this->loginVkUser($viewer_id);
        Yii::app()->request->redirect('/vk/about');
    }
    
    protected function createVkUser($viewer_id) {
        $vkData = \vendor\vk\vk::getUserData($viewer_id);
        
        $user = new User();
        $user->viewer_id = $viewer_id;
        $user->create_date = \helpers\Date::getCurrent();
        $user->name = $vkData['first_name'];
        $user->sname = $vkData['last_name'];
        $user->extra_data = json_encode($vkData);
        $user->save();
        
    }
    
    protected function loginVkUser($viewer_id) {
        $user = User::model()->find('viewer_id=:v_id', array(':v_id'=>$viewer_id));
        $this->login($user);
    }
    
    public function login(User $user) {
        $user->updateLastVisit();
        
        $this->setUserData($user);
        $this->setId($user['id']);
    }
    
    public function getUserData() {
        return $this->getState('userData');
    }
    
    public function setUserData(User $user) {
        return $this->setState('userData', $user);
    }
    
    public function checkUser() {
        return false;
    }
    
    public function isShopManager() {
        return false;
    }
}