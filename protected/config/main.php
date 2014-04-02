<?php
header('P3P: CP="NOI ADM DEV COM NAV OUR STP"');
setlocale(LC_TIME, 'UA');

define('ROLE_ADMIN', 'admin');
define('ROLE_MODER', 'moderator');
define('ROLE_USER', 'user');

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
		'vk'=>array(),
        'shopmanager'=>array(),
        
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
                '/' => 'site/index',
                'vk/ajaxprojectspageload/<page:\d+>'=>'vk/ajaxprojectspageload',
                'vk/index/<page:\d+>'=>'vk',
                'vk/index'=>'vk',
                'vk/mylist/<page:\d+>'=>'vk/mylist',
                
                'shopmanager/index/<page:\d+>'=>'shopmanager',
                'shopmanager/index'=>'shopmanager',
                'shopmanager/myoffers/<page:\d+>'=>'shopmanager/myoffers',
                
                
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