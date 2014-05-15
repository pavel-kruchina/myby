<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class PublicWebUser extends CWebUser{
    /**
     * @var User UserModel
     */
    protected $UserModel = null;
    
    /**
     * @return User 
     */
    public function getUserModel() {
        if ($this->isGuest) {
            return false;
        } 
        
        if ($this->UserModel)
            return $this->UserModel;
        
        return $this->loadUserModel();
    }
    
    /**
     * @return User 
     */
    protected function loadUserModel() {
        if ($this->isGuest) {
            return false;
        }
        
        $this->UserModel = User::getById($this->getId());
        return $this->UserModel;
    }


    public function init()
	{ 
		Yii::app()->getSession()->open();
        
        if ($this->isGuest)
            $this->checkAutoLogin();
        
        else  {
            $user = $this->getUserModel();
            
            if (!$user) 
                $this->logout();
            else
                $user->updateLastVisit();
        }
	}
    
    protected function checkAutoLogin() {
        
    }
    
    public function login(User $user) {
        $user->updateLastVisit();
        
        $this->setId($user['id']);
    }
}