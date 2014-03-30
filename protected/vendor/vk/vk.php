<?php
namespace vendor\vk;

use \Yii;

class vk {
    
    private static $vkApiInstance = null;
    
	public static function getInstance() {
        if (!self::$vkApiInstance)
            self::createApiInstance();
        
        return self::$vkApiInstance;
    }
    
    protected function createApiInstance() {
        $appId = Yii::app()->params['vk_app_id'];
        $appSecret = Yii::app()->params['vk_app_secret'];
        
        self::$vkApiInstance = new vkapi($appId, $appSecret);
    }
    
    public static function call($method, $params) {
        $vkapi = self::getInstance();
        
        $result = (array)$vkapi->api($method, $params);
        
        return $result;
    }
    
    public static function getUserData($viewer_id) {
        $result = self::call('users.get', array('uids'=>$viewer_id, 'fields'=>'sex,contacts'));
        return $result['response'][0];
    }
    
    public static function getVkViewerId() {
        $request=Yii::app()->getRequest();
        
        $viewer_id = (int)$request->getParam('viewer_id');
        $appId = Yii::app()->params['vk_app_id'];
        $appSecret = Yii::app()->params['vk_app_secret'];
        $auth_key = $request->getParam('auth_key');
        
        if (md5($appId.'_'.$viewer_id.'_'.$appSecret) === $auth_key)
            return $viewer_id;
        
        return false;
    }
    
    public static function sendNotification($viewer_id, $message) {
        $result = self::call('secure.sendNotification', array('uids'=>$viewer_id, 'timestamp'=>time(), 'random'=>microtime(), 'message'=>$message));
        return $result['response'][0];
    }
}