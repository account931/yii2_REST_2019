<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [

   
    //my Module
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Resttt',
        ],
    ],
	
	
	
	
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	
	//Components
    'components' => [
	
        'request' => [
			
              // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
              'cookieValidationKey' => 'fdgeggdfgb54654645t',
			  
			  //'baseUrl'=> '',
			  
			  //mine
		      /*'parsers' => [
                'application/json' => 'yii\web\JsonParser',
              ],*/
        ],
		
		
		//mine JSON---------------------------------------------------------------
		'response' => [
           //'format' => \yii\web\Response::FORMAT_JSON, //GIVES OUT JSON!!!!!!!!!!!!
        ],
	
	    //mine JSON
	
	
	    
		
		
	/*	
	'response' => [
    // ...
    'formatters' => [
        \yii\web\Response::FORMAT_JSON => [
            'class' => 'yii\web\JsonResponseFormatter',
            'prettyPrint' => YII_DEBUG, // используем "pretty" в режиме отладки
            'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            // ...
        ],
    ],
],
*/		
	
        //my RBAC
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
	
	
	
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
		
		//setting error handler
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
		
		
        //PRETTY URL
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,  // Hide index.php
			//'class' => 'yii\web\UrlManager',
            'rules' => [
			     'rbac-management-table' => 'site/rbac', //pretty url for 1 action(if Yii sees 'site/rbac' it turn it to custom text)
			     'yout-text-from-config-web-php.rar' => 'site/about', //pretty url for 1 action(if Yii sees 'site/about' it turn it to custom text)
			     ['class' => 'yii\rest\UrlRule', 'controller' => 'rest'/*, 'extraPatterns' => ['GET /' => 'new'], 'pluralize' => false*/], //rule for rest api, means if Yii sees any action of RestController, it uses yii\rest\UrlRule 
				  '<controller:\w+>/<id:\d+>' => '<controller>/view',  //for others, turns {site/about?vies=14} to {}
				  '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                  '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				  'defaultRoute' => '/site/index',
            ],
        ], 
        
		
		

	
		
		
    ],
	//END COMPONENTS
	
	
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
