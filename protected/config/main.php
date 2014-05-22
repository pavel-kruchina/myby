<?php
setlocale(LC_TIME, 'UA');

include('constants.php');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('actionControllers', dirname(__DIR__).'/controllers/actionControllers');
Yii::setPathOfAlias('vendor', dirname(__DIR__).'/vendor');
Yii::setPathOfAlias('helpers', dirname(__DIR__).'/helpers');
Yii::setPathOfAlias('models', dirname(__DIR__).'/models');

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MyBy.com.ua',
    'sourceLanguage'=>'en',
    'language'=>'ru',
	// preloading 'log' component
	//'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',

	),

	'modules'=>array(
		'shopmanager'=>array(),
        'public'=>array(),
        'vk'=>array(),
        
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'artlebedev',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','212.42.94.*', '109.251.175.*'),
		),
        
	),

	// application components
	'components'=>array(
                
		'user'=>array(
            'class'=>'application.components.WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
        'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                '/' => 'public',
                'public/index/<page:\d+>'=>'public',
                'public/index'=>'public',
                'public/mylist/<page:\d+>'=>'public/mylist',
                'public/ql/<code:\w+>'=>'public/ql',
                'public/conversation/one/<id:\d+>'=>'public/conversation/one',
                'public/conversation/index/<page:\d+>'=>'public/conversation/index',
                'public/shopuserabout/<id:\d+>'=>'public/shopuserabout',
                'public/add/<landing:\w+>'=>'public/add',
                
                
                'shopmanager/index/<page:\d+>'=>'shopmanager',
                'shopmanager/index'=>'shopmanager',
                'shopmanager/myoffers/<page:\d+>'=>'shopmanager/myoffers',
                'shopmanager/conversation/one/<id:\d+>'=>'shopmanager/conversation/one',
                'shopmanager/conversation/index/<page:\d+>'=>'shopmanager/conversation/index',
                
                
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
        
		'db'=>  include 'db_settings.php',
        
        'viewRenderer'=>array(
            'class'=>'application.extensions.renderers.smarty.ESmartyViewRenderer',
              'fileExtension' => '.tpl',
              //'pluginsDir' => 'application.smartyPlugins',
              //'configDir' => 'application.smartyConfig',
              //'prefilters' => array(array('MyClass','filterMethod')),
              //'postfilters' => array(),
              //'config'=>array(
              //    'force_compile' => YII_DEBUG,
              //   ... any Smarty object parameter
        ),

        
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>include 'params.php'
   
);