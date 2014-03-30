<?php
namespace vendor\vk;

use \Yii;

class vkSequre {
    
    private static $instance = null;
    
	public static function getInstance() {
        if (!self::$instance)
            self::$instance = new vkAPI();
        
        return self::$instance;
    }
    
    private $vk_options;
    
    public function __construct() {
        $vk_options = Yii::app()->session['vk_options'];
        $this->Init();
    }
    
    protected function Init() {
        if (isset($this->vk_options['access_token']))
            return;
        
        $this->connectToVK();
    }
    
    protected function connectToVK() {
        $appId = Yii::app()->params['vk_app_id'];
        $appSecret = Yii::app()->params['vk_app_secret'];
        $answer = file_get_contents("https://api.vk.com/oauth/access_token?client_id=$appId&client_secret=$appSecret&grant_type=client_credentials");
        $options = json_decode($answer);
        
        $this->setOptions((array)$options);
    }
    
    protected function setOptions($options) {
        $this->vk_options = $options;
        Yii::app()->session['vk_options'] = $this->vk_options;
    }
    
    public function call($method, $params) {
        $query = http_build_query($params);
        $access_token = $this->vk_options['access_token'];
        $json = file_get_contents("https://api.vk.com/method/$method?{$query}&access_token=$access_token");
        
        $result = (array)  json_decode($json);
        
        return $result;
    }
}