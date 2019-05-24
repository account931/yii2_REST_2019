Yii2 Rest Api. Basic template.
After unzip must create Cookie keys in config/web.php

1. Error page
2. Route, pretty URL
3.
 
 How it works:

 
 ===============================================
 Error deep_copy.php-> how to fix:
 Parse error: syntax error, unexpected 'function' (T_FUNCTION), expecting identifier (T_STRING) or in \vendor\myclabs\deep-copy\src\DeepCopy\deep_copy.php on line 
 This error can be fixed just by removing this line-> {use function function_exists;}. The use function syntax is supported since PHP 5.6 only.
 
 
 
 
 
 ===============================================
 How to, lessons:
 #Yii2 basic, registration, login via db->
https://xn--d1acnqm.xn- -j1amh/%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8/yii2-basic-%D0%B0%D0%B2%D1%82%D0%BE%D1%80%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D1%8F-%D0%B8-%D1%80%D0%B5%D0%B3%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%86%D0%B8%D1%8F-%D1%87%D0%B5%D1%80%D0%B5%D0%B7-%D0%B1%D0%B4

 #Yii2 RBAC
 #Yii Rest
 #Yii Error
 
 
 
 
 =======================================
CLI:
(if CLI commands dont work, add {php} before-> i.e {php migrate}). 
#init  -> to init index.php in folder "web" (or {php init})
#yii migrate -> apply migration to DB(if migration is available, from start migration is available in advanced, not in basic)
#composer update/composer install  -> update dependencies


-----------------------------------
Add your migration(for instance in Basic, where no migration is avialble from start)
#yii migrate/create create_user_table or (php yii migrate/create create_user_table)
#yii migrate  ->(or {php yii migrate}), just command without migrate file name from {console/migration} to apply all migrations.

Error "Could not find driver PDOException in yii2", to fix go to openserver/modules/php/version/php.ini-> Line 886, decomment (remove{;}){pdo_mysql} -> ;extension=php_pdo_mysql.dll
----------------------------------
Add your module
#To add your own module, use Gii modules and add OUTSIDE THE COMPONENT{'components' => []} this lines in config/web.php (for basic yii2 template):
  'modules' => ['admin' => ['class' => 'app\module\admin\admin',],],
 #Create url for your own component-> ['label' => 'Admin module', 'url' => ['/admin/default/index']], 
 
 
 
 --------------------------------------------
 
 Pretty URL
1. In .htaccess in root folder(not in web folder) ->
 
  Options +FollowSymlinks 
  RewriteEngine On 

  RewriteCond %{REQUEST_URI} !^/web/(assets|css|js|pdf|img)/ 
  RewriteCond %{REQUEST_URI} !index.php 
  RewriteCond %{REQUEST_FILENAME} !-f [OR] 
  RewriteCond %{REQUEST_FILENAME} !-d 
  RewriteRule ^.*$ web/index.php

2. In config/web/php->

//Pretty
		'urlManager' => [
        'class' => 'yii\web\UrlManager',
        // Disable index.php
        'showScriptName' => false,
        // Disable r= routes
        'enablePrettyUrl' => true,
        'rules' => array(
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ),
       ],
	   //END Pretty
	   
3. If CSS/JS crashes with prettyURL, create additional .htaccess in folder /web/
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . index.php
---------------------------------------------------------------------------------------










// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **

MANUAL (diffrent aspects)->




==============================================================================
How turn Yii2 Basic to resistration/login via DB SQL:
1. create migration(creats in /migrations/) ->  yii migrate/create create_user_table 
3. go to /migration/m000000_000000_create_user_table.php and paste code from Advanced template migration or create your own. Paste ONLY methods {up() down()}!!!!! DON"T TOUCH CLASS NAME.
2. apply migration-> yii migrate
  
  
  
  
==============================================================================
How to use ErrorHandler (i.e 404 NOT FOUND):
1. In config/web.php set action for errors ->  'errorHandler' => ['errorAction' => 'site/error',],
2. In controller->  public function actions() return [ 'error' => ['class' => 'yii\web\ErrorAction',]. 
  It will use built vendor/yii\web\ErrorAction,if you want create your own, comment it and create in controller your actionError()
3. In web/index.php -> define('YII_ENABLE_ERROR_HANDLER', true);//to show my personal error handler





================================================
Yii2 REST 
http://developer.uz/blog/restful-api-in-yii2/

http://localhost/yii2_REST/yii-basic-app-2.0.15/basic/web/index.php?r=rest
