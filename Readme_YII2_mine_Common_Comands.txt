THIS FILE IS THE MASTER SOURCE for git-browserify-yii_commands_manuals/Yii2_General_Guidelines/yii2_commands.txt (which is a slave file)
THIS FILE IS MASTER, ORIGINAL & CORE. ALL EDITS ARE TO BE DONE HERE IN THIS ORIGINAL FILE.
ERASE-> It is a core file, all edits from here must be copies to yii_commands and then from there to Git
-----------------------------------

#This YIi2 Basic uses DB registration/login, RESTful, RBAC roles
#DB SL is =>yii2-rest






---------------------------------------------
COPY BELOW CODE ONLY!!!!!!!!!!!!!!!!!!!!!!!!
---------------------------------------------
Yii2 Rest Api. Basic template.
IF use direct Yii download (not Composer), after folder unzip must create {cookieValidationKey} in config/web.php

Table of contents:
1.Yii2 CLI Composer install & init.
2.Migration.
3.Add a module.
4.Pretty URL.
5.Yii2 basic. Registration, login via db.
6.Yii Error Handler.
7.Yii Restful API
7.1 Yii Restful API(control token authorization(access available with token only))
8.Yii RBAC
9.Error deep_copy.php
10.Pagination, LinkPager, Active Record
11.Flash message
12.DataProvider(can be used both in GridViw and ListView) + GridView + ListView.
13.Yii Access Filter (ACF)
14.Register custom assets (js, css)
15.Multilanguages
16. Has Many relation
17. Yii2 my custom validation
18. Reset password form (if you have forgotten it)
19. Sending mail
20. Hand made captcha
20.1 Built-in Captcha=> 
21. Change application name
22. Hide {/web/} from URL
23. Prevent folder from Listing (e.g images)

24. Basic vs Advanced configs
25. Comments widget extension =>rmrevin/yii2-comments + Vote widget extension => /Chiliec/yii2-vote + Dektrium/Yii2_User Module 
26. Yii2 Ccodeception tests
27. Dropdown List in </form>
28. Behaviors
29. Events


98.V.A Yii (ActRec,create URL, redirect, get $_POST[''], etc)
98.2.V.A(php)
98.3.V.A example references (CSS,JS,Php)
99. Known Errors

Codexception
Yii ajax(shop)
crsf
Widget

 

 
 
 
 
 
 =======================================
1.Yii2 CLI Composer install & init.
CLI:
(if CLI commands dont work, add {php} before-> i.e {php migrate}). 
#Browse to go to needed folder: cmd -> cd[blankspace]folder. U can hint folders by TAB.(i.e  C:\Users\Dima\Downloads\domains\....)
#CLI->init        => to init Yii2 index.php in folder "web" (or {php init})
#CLI->yii migrate => apply migration to DB(if migration is available, from start migration is available in advanced, not in basic)
#CLI->composer update/composer install     => update dependencies in file {composer.json}




========================================
2.Migration.
How to Add your migration(for instance in Basic, where no migration is avialble from start)
#yii migrate/create create_user_table or (php yii migrate/create create_user_table)
#yii migrate  ->(or {php yii migrate}), just command without migrate file name from {console/migration} to apply all migrations.
#to apply 1 migration only=> php yii migrate/to m150101_185401_create_news_table

#to create table migrations with colums at once using CLI, specify them via --fields. => yii migrate/create create_post_table --fields=title:string,body:text
#view last applied migrations=> yii migrate/history all

#to add columns to migration (in text editor) => see more at https://github.com/account931/yii2_REST_and_Rbac_2019/tree/master/migrations/m191203_114306_create_testttX_table.php
   $this->createTable('testtt', [
        't_id' => $this->primaryKey(),
	    't_name' => $this->string()->notNull()->unique(),
		't_desc' => $this->smallInteger()->notNull()->defaultValue(10),
		'created_at' => $this->integer()->notNull(),	
        ]);
   
#to add values to migration (in text editor) => 
  $this->batchInsert('tableName', ['col_name_1', 'col_name_2'], [
    ['category1', 'aaa'], 
    ['category2', 'bbb'], 
    ['category3', 'ccc']
]);

# to cancel last migration => yii migrate/down

Error "Could not find driver PDOException in yii2", to fix go to openserver/modules/php/version/php.ini-> Line 886, decomment (remove{;}){pdo_mysql} -> ;extension=php_pdo_mysql.dll




========================================
3.Add a module.
How to Add your module
#To add your own module, use Gii modules and add OUTSIDE THE COMPONENT{'components' => []} this lines in config/web.php (for basic yii2 template):
  'modules' => ['admin' => ['class' => 'app\module\admin\admin',],],
#Create url for your own component-> ['label' => 'Admin module', 'url' => ['/admin/default/index']], 
 
 
 
 
 
 
======================================= 
4.Pretty URL.
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
		    'yout-text-from-config-web-php.rar' => 'site/about', //pretty url for 1 action(if Yii sees 'site/about' it turn it to custom text)
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ),
       ],
	   //END Pretty
	   
3. If CSS/JS crashes with enabled prettyURL, create additional .htaccess in folder /web/
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . index.php
---------------------------------------------------------------------------------------











=================================================================
5.Yii2 basic. Registration, login via db.
#Yii2 basic. Registration, login via db->
How turn Yii2 Basic to resistration/login via DB SQL:
https://xn--d1acnqm.xn--j1amh/%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8/yii2-basic-%D0%B0%D0%B2%D1%82%D0%BE%D1%80%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D1%8F-%D0%B8-%D1%80%D0%B5%D0%B3%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%86%D0%B8%D1%8F-%D1%87%D0%B5%D1%80%D0%B5%D0%B7-%D0%B1%D0%B4

1. create migration(creats in /migrations/) -> yii migrate/create create_user_table 
3. go to /migration/m000000_000000_create_user_table.php and paste code from Advanced template migration or create your own. Paste ONLY methods {up() down()}!!!!! DON"T TOUCH/modify original CLASS NAME.
2. apply migration-> php yii migrate
3. modify code in /models/User.php. (see => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/models/User.php)
   Next methods should be added: findIdentity($id), findIdentityByAccessToken($token, $type = null), findByUsername($username), getId(), getAuthKey(), validateAuthKey($authKey), validatePassword($password), setPassword($password), generateAuthKey()
4. create model for registration in /models/SignupForm.php (see => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/models/SignupForm.php)
5. add {use app\models\SignupForm} + {function actionSignup()} in /controller/SiteController
6. create  /views/site/signup.php
7. add registration URL to menu in /views/layouts/main.php 
  
  
  
  
  
  
  
==============================================================
6.Yii Error Handler (how to handle Exceptions).
(see example at => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/SiteController.php)
#You can throw your custom Yii exception with following code ->   throw new \yii\web\NotFoundHttpException("Your text");
#If Yii2 encounters your exception or any internal error, it will use ErrorHandler(built-in or your custom). It will use ErrorHandler if in Development, not Debug mode(true?)

How to use built-in ErrorHandler, i.e when Yii2 encounters your custom Exception or some error (i.e 404 NOT FOUND):
By default, the following code is already deployed in Yii2 application. Just make sure, this code exists, otherwise add it manually:
1. In config/web.php set action for errors (inside {'components' => []}) ->  'errorHandler' => ['errorAction' => 'site/error',],  //Note that by default SiteController does not have ActionError(), but the handler will work, as it uses Class \vendor\yii\web\ErrorAction. For rendering view it  uses views/site/error.php
2. In controller->  public function actions() return [ 'error' => ['class' => 'yii\web\ErrorAction',]. 
In above case, Yii2 will use template from views/site/error.php to display Error page (i.e NOT FOUND PAGE or your custom Exception).
To pass and show an Exception message to view, use in views/site/error.php {$message}. I.e can use in <title>, or pass to flash/alert div.

This built-in  error Handler will use built \vendor\yii\web\ErrorAction,if you want create your own, comment it and create in controller your actionError()
3. If you created your own {actionError()} and it does not work, try in web/index.php ->  define('YII_ENABLE_ERROR_HANDLER', true);//to show my personal error handler





6.2If you want to use your own actionError(for example for the purpose of handling 404 errors differently from other errors):
  - create it in controller => public function actionErrorNotUsed(){//your logic .....}. See more at https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/SiteController.php
  - specify it in config/web.php => 
       'errorHandler' => [
            'errorAction' => 'site/error-not-used',  //'errorAction' => 'site/error', 
        ],




		
		
===========================================================
7.Yii Restful API
#Yii Rest
Yii2 REST  -> http://developer.uz/blog/restful-api-in-yii2/

test URL from Yii2 (if prettyUrl off) -> http://localhost/yii2_REST/yii-basic-app-2.0.15/basic/web/index.php?r=rest
test URL from Yii2 , Pretty URL, retuns  only ID and email with $_GET specified like this: http://localhost/yii2_REST/yii-basic-app-2.0.15/basic/web/rests?fields=id,email
test URL from Yii2 (ControllerRest/actionView)(view 1 record by ID, 4 is db ID)-> http://localhost/yii2_REST/yii-basic-app-2.0.15/basic/web/rest/view/4   

How to test Yii2 Rest Api from from non-Yii2 file, see more at =>  Readme_YII2_mine_This_Project_itself.txt -> 1.HOW TO TEST REST API from non-Yii2 file. 

1.Main core Rest Controller in /controllers/RestController.php. File in /modules/admin/DefaultController is just a test of module building, it is minor.(See core minor -> /Files/Yii2_basic/controller/RestController.php)
2.This code line turns response to JSON (config/web.php) -> 'response' => ['format' => \yii\web\Response::FORMAT_JSON],
3.By default model returns in response all model fields (i.e sql fields), to exclude excludes some unsafe fields from response-> public function fields(){$fields = parent::fields();unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);return $fields;}
4.
5.To test Yii2 RESTful Api from non-REST file(i.e file outside Yii2 folder)=>(see /Files/my_rest_js_ajax_test/index.php)
  If you try to get Yii2 Rest response from non-REST file(i.e file outside Yii2 folder), that file must be run on localhost(i.e must have .php extension not .html)
6.By default Yii2 rest returns xml, but it must not bother u,just specify in ajax {contentType: "application/json; charset=utf-8",} and it will return json
7.We use RestController as a main Rest controller, it contains no actions, but actionIndex, actionView, etc work because our Controller extends {yii\rest\ActiveController}, which includes all these actions.
  In our RestConroller we just have to defines the model to parse {public $modelClass = 'app\models\User';}.
#To avoid CORS(cross domain) error, in RestController we should add code: (/Files/Yii2_basic/controller/RestController.php)

public static function allowedDomains(){
    return [ '*',  // star allows all domains
	'http: // localhost: 3000', 'http://test1.example.com',];  
	}

public function behaviors(){
    return array_merge(parent::behaviors(), [
        // For cross-domain AJAX request
        'corsFilter'  => [
            'class' => \yii\filters\Cors::className(),
            'cors'  => [
                // restrict access to domains:
                'Origin'                           => static::allowedDomains(),
                'Access-Control-Request-Method'    => ['POST'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 3600,  // Cache (seconds)
            ], ], ]);




#Pagination in Rest Api	=> 
   1.1 in action use:
        $query = User::find();
        $dataProvider = new \yii\data\ActiveDataProvider(['query' => $query,  'pagination' => ['defaultPageSize' => 2,] ]);
		return $dataProvider;
	1.2 in Url use -> restURl&page=2		 (restURL?per-page=2  will  returns 2 records per page only)		
			
			

-----------------------------------------------------
AJAX EXAMPLE TO Yii2 Rest (ajax request from non-REST file ):

                   <script>
				      //below script makes a test request to Yii2 Rest Api
					  //this file must be run on localhost(i.e must have .php extension not .html)
					  //By default Yii2 rest returns xml, but it must not bother,just specify in ajax {contentType: "application/json; charset=utf-8",} and it will return json
				      $.ajax({
                          url: '../yii-basic-app-2.0.15/basic/web/rest',
                          type: 'GET', //must be GET, as it is REST /GET method
						  crossDomain: true,
						  contentType: "application/json; charset=utf-8",
			              dataType: 'json', // without this it returned string(that can be alerted), now it returns object
			              //passing the city
                          data: { 
			                  //serverCity:window.cityX
			              },
                          success: function(data) {
                             // do something;
                           
			                //alert(data);
							console.log(data);
							var ress = "REST Api Response (list of users): <br>";
							for (var i = 0; i < data.length; i++){
								ress+= data[i].username + "-> " + data[i].email + "<br>";
							}
							$("#result").stop().fadeOut("slow",function(){ $(this).html(ress) }).fadeIn(2000);
				
                          },  //end success
			              error: function (error) {
				              $("#result").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Rest API crashed <br>" + error + "</h4>")}).fadeIn(2000);
                              console.log(error);
						  }	  
                     });                             
                    //END AJAXed  part 
				  </script>





				  
================================================
7.1 Yii Restful API(control token authorization(access available with token only))
#test url with token=>  http://localhost/yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/rests?access-token=1111
#Tokens are stored in SQL {rest_access_tokens}, fields {rest_tokens, r_user} = (token, userID)

#If 'authenticator' => is Enabled in controllers/RestController (meaning user token is required), ajax(from non-Yii) or Yii2 URL must contain user token (from SQL rest_access_tokens)  
  i.e => url: '../web/rest?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b
  Otherwise, it will fire "Unauthorized".
  
  
How to implement access to Yii2 Rest Api with access token only:
  a.)set property {enableSession} to {false} in User component. It is not mandatoty, so we don't use it here
  b.)set public function behaviors() in Rest controller (different variant see in RestController):
     use yii\filters\auth\HttpBasicAuth;
	 $behaviors = parent::behaviors();
     $behaviors['authenticator'] = [
        'class' => HttpBasicAuth::className(),
     ];
      return $behaviors;
     }
	 
  c.)set method {public static function findIdentityByAccessToken}:
    c1.)IN CASE YOU STORE TOKENS in SQL DB {USER} in field {access_token}), set this method in models/User:
     
      use yii\web\IdentityInterface;
	  public static function findIdentityByAccessToken($token, $type = null)
      {
        return static::findOne(['access_token' => $token]);
      }

   c2.)IN CASE YOU STORE TOKENS in a special own created SQL database(created for storing tokens only)-> for example in {rest_access_tokens} in field {rest_tokens}) , 
     c2_step1:set this method in models/User:
	 
	     public static function findIdentityByAccessToken($token, $type = null){
		     return \app\models\RestAccessTokens::findOne(['rest_tokens' => $token]); //MINE //to use API Auth token, now it uses tokens stored in models/RestAccessTokens -> DB {rest_access_tokens}
         }
		
    c2_step2:set in in models/RestAccessTokens:
	  #add to class declaration ->  {implements \yii\web\IdentityInterface} //have to implements \yii\web\IdentityInterface to be used in models/Users/findIdentityByAcces
      #copy 5 methods from model/User to comply with implementation of IdentityInterface Interface
	  #change function findIdentityByAccessToken to:
	     public static function findIdentityByAccessToken($token, $type = null){
		    return static::findOne(['rest_tokens' => $token]); }


				  
		





		
				  
=========================================================
8.Yii RBAC
#Yii2 RBAC http://developer.uz/blog/rbac-%D1%80%D0%BE%D0%BB%D0%B8-%D0%B8-%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D0%B8-%D0%B2-yii2/
#RBAC saves user roles/rights to  auth_item DB(holds names of all roles) & auth_assignment DB(holds roleName + id of a user who has the right).
8.1 Add {authManager} to components in /config/web.php. If u have error "You should configure "authManager" alse add to /config/console.php (see 14.1)
'components' => [
  ...
  'authManager' => ['class' => 'yii\rbac\DbManager',],
8.2 Apply rbac migration to add rbac tables{auth_item, auth_assignment, etc}. (@yii is an alias for {vendor/yiisoft/yii2} )  =>    
   php yii migrate --migrationPath=@yii/rbac/migrations/
8.3 Create a new Rbac role=>
  $role = Yii::$app->authManager->createRole('adminX');
  $role->description = 'Админ';
  Yii::$app->authManager->add($role);
8.4 Before creation u may check if does not already exists:
   in controller=> $rbac = AuthItem::find()->where(['name' => 'your roleName'])->one(); + if ($rbac){return false;}
   or in model=>  self::find()->where(['name' => your roleName])->one(); + if ($rbac){return false;}
8.5 Assign the rbac to certain user:
  $userRole = Yii::$app->authManager->getRole('name_of_role');
  Yii::$app->authManager->assign($userRole, Yii::$app->user->identity->id); //assign to current user
8.6 Finally, check in controller/view if user has some role:
   if(Yii::$app->user->can('adminX')){





   
   
   




===============================================
9.Error deep_copy.php
#Error deep_copy.php-> if encounter this error - how to fix:
 Parse error: syntax error, unexpected 'function' (T_FUNCTION), expecting identifier (T_STRING) or in \vendor\myclabs\deep-copy\src\DeepCopy\deep_copy.php on line 
 This error can be fixed just by removing this line-> {use function function_exists;}. The use function syntax is supported since PHP 5.6 only.
 
 




===============================================
10.Pagination, LinkPager, Active Record
In Controller:
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

$query=SupportData::find()->orderBy ('sData_id DESC')->andFilterWhere(['like', 'sData_text', Yii::$app->getRequest()->getQueryParam('q')])/*->where(['sData_text'=>Yii::$app->getRequest()->getQueryParam('q') ])*/ /* ->all()*/;  //don't use { ->all()} as it returns array not object
$pages= new Pagination(['totalCount' => $query->count(), 'pageSize' => 9]);
$modelPageLinker = $query->offset($pages->offset)->limit($pages->limit)->all();  

//RENDER
     return $this->render('searchmine', [
         'modelPageLinker' => $modelPageLinker, //pageLinker
         'pages' => $pages,      //pageLinker
]);

----------------------------------
In views/searchmine.php:

use yii\widgets\LinkPager;
foreach ($modelPageLinker as $model) {
    echo "<h4 style='cursor:pointer;'>" . $model->sData_header . "</h4>";
  }

// display LinkPager
echo LinkPager::widget([
    'pagination' => $pages,
]); 
 
 
 

 
====================================
11.Flash message
In Controller: Yii::$app->getSession()->setFlash('searchFail', "your text"); 
In View: 
use yii\bootstrap\Alert;
$nn=Yii::$app->session->getFlash('searchFail'); //or directly <?= Yii::$app->session->getFlash('savedItem');?>
if (Yii::$app->session->hasFlash('searchFail'))
    {
	    echo Alert::widget([
		    'options' => [
				'class' => 'alert alert-danger'
			],
			'body' => "$nn"
		]); 
   }
   
 
 11.2 Variant 2
   <!------ FLASH Success from BookingCpg/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('successX') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH Successfrom BookingCpg/actionIndex() ----->
   
   
   
======================================
12.DataProvider(can be used both in GridViw and ListView) + GridView + ListView.
In Controller:

use yii\data\ActiveDataProvider;

$searchModel = new SupportDataSearch();
//$dataProvider = $searchModel->search(Yii::$app->request->queryParams); //was  by  default
$dataProvider = new ActiveDataProvider([
    'query' => SupportData::find()/*->where(['mydb_user' => Yii::$app->user->identity->username])*/,
    'pagination' => [
        'pageSize' => 4,],
     'sort'=> ['defaultOrder' => ['sData_id'=>SORT_DESC]],
]);
------------------------
In View:

use yii\grid\GridView;
use yii\widgets\ListView;

 echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'supp_id',
            'supp_user',
            'supp_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
 
 
 echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_listview_1_view', //additional view for each record
 ]);
 
 
 
 
 
 
 
 
 
 
===================================================== 
13.Yii Access Filter (ACF).
(see example at => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/SiteController.php)
It filters users access based if they are logged/unlogged.
How to:
 #In Controller, adds to  {public function behaviors()}:
 use yii\filters\AccessControl;
 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
				
				//To show message to unlogged users. Without this unlogged users will be just redirected to login page
				'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\NotFoundHttpException("Only logged users are permitted!!!");
                 },
				 //END To show message to unlogged users. Without this unlogged users will be just redirected to login page
				 
                'only' => ['logout', 'add-admin'],
                'rules' => [
                    [
                        'actions' => ['logout', 'add-admin'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
 
 
 
 
 
 
 
 
 
 
 =====================================================
 14.Register custom assets (js, css)
 How to:
  1. Create in /assets folder new file, i.e {IshopAssetOnly.php}, class of this file should have the same name { IshopAssetOnly}
  2. In View u want to register this css/js Asset Bundle put:
       use app\assets\IshopAssetOnly;   // use your custom asset
       IshopAssetOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name of Class)
 
 
 
 
=====================================================
15.Multilanguages
(see live example at MultilanguageController/public function actionIndex()=> https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/views/multilanguage/index.php)
NB: setting is reset to null on reload, u should save selected language to Session or Cookie)
When using Cookie keep in mind MEGA FIX : {Yii::$app->request->cookies} is for READ ONLY, to add a new cookie use {Yii::$app->response->cookies->}
How to add multilanguages:
  1. Add to main config (for basic it is /config/web.php)=>
        return [
	      //....
          // set target language to be Russian
             'language' => 'ru-RU',

          // set source language to be English
          'sourceLanguage' => 'en-US',
          //......
        ];
		
  2.Create new file /messages/ru-RU/app.php (for implementing translation for ru-RU language. 
	            If you target language will be my-Lang, so, that will be /messages/my-Lang/app.php.
	
  3.Implement translation of your strings (in /messages/ru-Ru/app.php):
	    return [
           'welcome' => 'Добро пожаловать',
           'This is a string to translate!' => 'Это строка для перевода'
           //...
         ];
		 
  4.Configure i18n component in your main config file like this (for basic it is in /config/web.php):
	   'components' =>  
       // ...
       'i18n' => [
          'translations' => [
              'app*' => [
                  'class' => 'yii\i18n\PhpMessageSource',
                  //'basePath' => '@app/messages',
                  //'sourceLanguage' => 'en-US',
                  'fileMap' => [
                      'app' => 'app.php',
                      'app/error' => 'error.php',
                  ],
              ],
          ],
       ],
],
 
 
 5. You can change/set current language with the below code. 
            \Yii::$app->language = $lang;
 
 NB: language setting is reset to null on reload, u should save selected language to Session) 
      $session = Yii::$app->session;//opens session
	  $session->set('language', $someValue);
 
 
 6. Use => echo \Yii::t('app', 'This is a string to translate!');
 
 
 
 
 
 
 
 
 
=====================================================
16. Has Many relation 
(see live example at SiteController/public function actionHasMany())
 How to connect 2 SQL DB with relations ():
 1. Create a getter in model which will have realtion hasMany {this model(DB) iq can have many connections in other DBs}.
    Getter name must start with get:
	
	  public function getTokens(){
       return $this->hasMany(RestAccessTokens/*AuthAssignment*/::className(), ['r_user' => 'id']); //args=> (model/db name to connect, [THAT model/DB column name => THIS CLASS model/db name id]    // Db fields which cooherent each other(from 2 DBs)
      }
  2. Then u can use this Getter in Controller:
     $currentUser = User::findOne(Yii::$app->user->identity->id); //just find current user
	 $orders = $currentUser->tokens; //call hasMany action //Token is a function getTokens
  
  
 ---------------------
 
16.2 INPORTANT UPDATE => hasMany/hasOne relations. relation for multiple records
(see live example at https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/models/Wpress/WpressBlogPost.php -> WpressBlogController/public function actionShowAllBlogs())
(see live example at https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/models/Wpress/WpressBlogPost.php -> WpressBlogController/function actionIndex()
  16.2.3 if Model uses hasOne relation (i.e this model for DB table {articles), and any article can have only ONE author):
     #in model place GETTER ()must start with getNNNNNNN:
	      public function getUsernames(){                                //that table ID(User)     //THIS table ID
              return $this->hasOne(User/*table to connect*/::className(), ['id' => 'wpBlog_author']); //[THAT table column/ THIS CLASS column]
          
	 #in View (if from Controller u passed an array of Objects and use foreach()):
	      foreach($data as $model){
		  //...do some stuff u want to display from the 1st DB and then when u want to display from the 2nd table->
	      echo "<p>"user .  $model->usernames->username  . "</p>";   //username, has ONE relations //i.e $model->getUsernames()->username //model->YourGetter->columnName in 2nd DB
  
  
   16.2.3 if Model uses hasMany relation (i.e this model for DB table {articles), and any article can have many Categories) http://www.cyberforum.ru/php-yii/thread2313064.html:
       #in model place GETTER ()must start with getNNNNNNN:
	      public function getTokens(){                                              //that table ID(User)  //THIS table ID
              return $this->hasMany(WpressCategory/*table to connect*/::className(), ['wpCategory_id' => 'wpBlog_category']); //[THAT table column/ THIS CLASS column]
          
	   #in View (if from Controller u passed an array of Objects and use foreach()).The trick here is to use double foreach:
              foreach ($modelPageLinker as $model) {
              //...do some stuff u want to display from the 1st DB and then when u want to display from the 2nd table->
                 foreach ($model->tokens as $b){ //i.e model->GETTER
			         echo "<p'> category: " .    $b->wpCategory_name  . "</p>";   //display category, has many relations. {wpCategory_name} is columnName in 2nd DB			  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 ==============================================================
 17. Yii2 my custom validation
 (see details at => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/models/BookingCph.php)
 To use your custom validation:
  1. Put to model, to public function rules(){Section} your validation rule in format [['field to validate','your custom function that checks validation']]:
     ['book_from','validateDatesX']
 
   2. Deploy in model your custom validation function:
       public function validateDatesX(){
           if(strtotime($this->book_from) <= date("U")){//strtotime($this->start_date)){
              $this->addError('book_from','Can"t be past!!!Please give correct Start Day');
              //$this->addError('end_date','Please give correct Start and End dates');
           }
       }

   
 
 
 
 
  
 ==============================================================
 18. Reset password form (if you have forgotten it)
 https://xn--d1acnqm.xn--j1amh/%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8/yii2-basic-%D0%B0%D0%B2%D1%82%D0%BE%D1%80%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D1%8F-%D0%B8-%D1%80%D0%B5%D0%B3%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%86%D0%B8%D1%8F-%D1%87%D0%B5%D1%80%D0%B5%D0%B7-%D0%B1%D0%B4
 
 # Edit /models/User.php by adding RESET Password Section methods (findByPasswordResetToken($token), isPasswordResetTokenValid($token), generatePasswordResetToken(), removePasswordResetToken())
   Exact method implementation please see at https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/models/User.php
 # Set {'user.passwordResetTokenExpire' => 3600,} and {'supportEmail' => 'robot@devreadwrite.com'} in {/congif/params.php}
 # Create PasswordResetRequestForm.php model in models\ResetPassword\, a model for form with email input where u request password resetting;
 # Create ResetPasswordForm.php model in models\ResetPassword\, a model if you go to your email and click on a reset link in letter;
 # Create text layout for email in {/mail/layouts/text.php}
 # Create html & text email views -> {/mail/passwordResetToken-html.php}  and {/mail/passwordResetToken-text.php}
 # Create 2 actions in Controller (i.e PasswordResetController)=> actionRequestPasswordReset() and actionResetPassword($token). See details at https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/PasswordResetController.php
   1st action is to input your email to request resetting the password, the 2ns action is a form to change the password if you followed the link in your received email letter
 # Create 2 views in {/views/password-reset/} => passwordResetRequestForm.php and resetPasswordForm.php
 # Add reset link at Login page (i.e If you forgot your password you can <?= Html::a('reset it', ['password-reset/request-password-reset']) ?>.)
 
 
 
 
 
 
 
 =====================================================
 19. Sending mail
 Go to config/web.php->
     'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set 'useFileTransport' to false and configure a transportfor the mailer to send real emails.
            'useFileTransport' => true, //true means sending mail to /runtime/, false means sending real emails
			
		    'transport' => [
               'class' => 'Swift_SmtpTransport',
               'host' => 'imap.ukr.net',
               'username' => 'account931@ukr.net',
               'password' => 'm',
               'port' => '993',
               'encryption' => 'ssl',
           ],
 
 
 
 
 
 
 
 
 
 =====================================================
 20. Hand made captcha
 (see details at => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/PasswordResetController.php  -> function actionRequestPasswordReset()
 
 1. Add to necessary model:
      public $captcha;
      public $recaptcha;
	  
	  public function rules(){ return [
	      [[ 'captcha','recaptcha'], 'required'],
          ['recaptcha', 'compare', 'compareAttribute' => 'captcha', 'operator' => '=='],
      ];}

2. Add to necessary action in Controller:
     $model->captcha = rand(11111,99999);
	 
3. Add to necessary model:
    <?= $form->field($model, 'captcha')->hiddenInput()->label(false) ?>
    <div class="form-group">
       <mark><b><?= $model->captcha ?></b></mark>                    
    </div>
    <?= $form->field($model, 'recaptcha')->textInput(['placeholder' => 'Enter Captcha'])->label(false) ?>
 
 
 
 
 
 
 
 
 ==========================================================
 20.1 Built-in Captcha=> 
 (see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/Yii2_comment_widget/frontend/controllers/SiteController.php  -> function actionVote_comment() ->views/site/voteComment.php + views/site/render_partial/myCommentForm.php
    In model:
            public $verifyCode; //for captcha
			 //..
			 // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
    In View:
	 echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                 'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]);
 
 
 
 
 
 
 ========================================================
 21. Change application name
 For basic=> add in config/web.php:
            'name'=>'Your new name',
 
 
 
 
 
 
 
 =======================================================
22. Hide {/web/} from URL
To hide {/web/} from URL & prevent basic folder from listing (instead of putting there empty index.php)
  #create 2 .htaccess files, one in /web/ folder and the 2nd in root folder.
  #See detailed code in this file at 4.Pretty URL.
 
 
 
 
 
 =======================================================
23. Prevent folder from Listing (e.g images)
 Used Not only in Yii.
 To prevent folder from Listing, put to Images folder .htaccess with content:
 
   #to prevent folder from Listing
   Options -Indexes


   
 =======================================
24. Basic vs Advanced configs
 See => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/Yii2_comment_widget/ReadMe.txt
 
 
  =======================================
25. Comments widget extension =>rmrevin/yii2-comments + Vote widget extension => /Chiliec/yii2-vote + Dektrium/Yii2_User Module 
 See => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/Yii2_comment_widget/ReadMe.txt
 
 
  =======================================
26. Yii2 Ccodeception tests
 See => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/Yii2_comment_widget/ReadMe.txt
 
 
 
 ===========================================
27. Dropdown List in </form>
dropdown
(see details at =>https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/WpressBlogController.php -> function actionCreate())
 #gets all items from DB => $Categories = WpressCategory::find()->orderBy ('wpCategory_id DESC')->all(); 
 #in view convert object $Categories to array with ArrayHelper::map => 
     use yii\helpers\ArrayHelper; 
	 echo $form->field($model, 'wpBlog_category')->dropDownList(ArrayHelper::map($allCategories,'wpCategory_id','wpCategory_name'), ['prompt' => 'Select category']);  //display <select> dropdown of all categories
	 echo $form->field($model, 'wpBlog_status')->dropDownList([ '0'=>'Not_Published', '1'=>'Published', ], ['prompt' => '',  'options'=>['1'=>['Selected'=>true]]] );  //display <select> dropdown of all {Published/Not Published} instead of SQL DB {0,1}
 
 
 
 
 
 
 
 
 
 ==========================================
 28. Behaviors 
 (see details at=>  https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/WpressBlogController.php)
 Steps to deploy behavior (the code that will fire in controller on every event u specify). Functionally it is  similar to nesting{beforeAction($action)} in controller
 28.1 In controller add to {public function behaviors()}
     public function behaviors()
     {
        return [
		    //something else..............,
            
			// my behavior...
			'slugOrAnyName_at_all' => [
                'class' => 'app\componentsX\behaviorsX\Slug', //specify your behavior class, i.e it is located in /componentsX/behaviorsX/Slug.php
                //'iniciali' => 'someVar', //passing some variable to our behavior
            ]
			//my behavior........
        ];
		
28.3 Create folder "componentsX" in the root and then folder "behaviorsX" inside.
28.4 Create "Slug.php"=> 
    namespace app\componentsX\behaviorsX; //your namespace, i.e pathway;
    use yii\base\Behavior;
    //use yii\web\Controller;  //must-have  as you use controller
    class Slug extends Behavior{  //must extend beahvior
        //public $title = 'title';
 
        public function events(){
           return [
               //ActiveRecord::EVENT_BEFORE_VALIDATE => 'changeTitle',
			    \yii\web\Controller::EVENT_BEFORE_ACTION => 'getMyMetodX'   //your method to launch
           ];
       }
 
       //your method to launch
       public function getMyMetodX(){
	      //some your code...........
          //throw new \yii\web\NotFoundHttpException("Launched in Behavior");
       }
    }


 
 
 
 
 
 
 
 
 ====================================================
 29. Events
 http://qaru.site/questions/202812/how-to-use-events-in-yii2
 (see example at => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/WpressBlogController.php    -> function actionIndex() + EVENT(specified in models/WpressBlogPost.php))
 
 
 
 
  ====================================================
 30. Login by email not username, see eaxample at => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/TestMiddleController.php
 How to login by email not username: 
    //in models\TestMiddle\User added => public static function findByEmail($email){return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]); }
    //in models\TestMiddle\LoginForm =>  {$username} change to  {$email} + adds to rules()  [['email'], 'email'] +  in getUser() change {User::findByUsername($this->username)} to {User::findByEmail($this->email)}
	//in \views\test-middle\password change username field to => echo $form->field($model, 'email')->hiddenInput([ 'value'=> Yii::$app->request->get('emailZ') ])->label(false);
 
 
 
 
 
 
 
 
=====================================================
98.V.A Yii (ActRec,create URL, redirect, get $_POST[''], etc)

#To get name/id of currently logged user => Yii::$app->user->identity->username; Yii::$app->user->identity->id;
#To get current user's DB fields info    => echo Yii::$app->user->identity->table_field;

#Create URL link  => $infoLink = Html::a( "more  info", ["/site/about", "period" => "",   ] /* $url = null*/, $options = ["title" => "more  info",] ); 
#Create URL2 link  =>  use yii\helpers\Url; $url = Url::to(['message/view', 'id' => 100]);
#Create URL3 => $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['password-reset/reset-password', 'token' => $user->password_reset_token]);

#Create URL link in button => Html::a('Reset It', ['password-reset/request-password-reset'], ['class'=>'btn btn-small btn-info']);
#Create URL link in <image><img> => echo Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/'. $model->avatar), [ 'view3', 'id' => $model->id], ['class'=>'lightboxed'] ); 


#Redirect =>  return $this->redirect(['support-data/index']);   // return $this->redirect(['support-data/index', 'getX'=> 'someText']);

#To get $_GET['some'] => if (Yii::$app->getRequest()->getQueryParam('traceURL')=="supp_kbase"){} //Yii::$app->request->get('id');
 
#To check if user has logged=> if(!Yii::$app->user->isGuest){ 

#Access to components, models, etc in 2 ways: use app\models\User; ==> \app\models\User::find()...       use yii\web\Controller; ==> \yii\web\Controller::EVENT_BEFORE_ACTION.....

#Active Record (in view use simple foreach(){})=> $activeRec = Mydbstart::find() ->orderBy ('mydb_id DESC') ->limit('5') ->where(['mydb_user' => Yii::$app->user->identity->username]) ->all();
#Active Recored, WHERE statements, var 2=>
     $model = BookingCphV2Hotel::find()->  orderBy ('book_id DESC')  ->limit('5')
	             ->where([ 'booked_by_user' => Yii::$app->user->identity->username , /*'mydb_id'=>1*/ ]) 
			     ->andWhere( 'book_room_id =:status', [':status' => $postD] )
				 ->andWhere([ 'or',
				             ['between', 'book_from_unix', strtotime($first1), strtotime($last1) ],
							 ['between', 'book_to_unix',   strtotime($first1), strtotime($last1) ]
				 ])
				 ->andWhere(['between', 'book_from_unix', strtotime($first1), strtotime($last1) ])   /*->andFilterWhere(['like', 'supp_date', $PrevMonth])  ->andFilterWhere(['like', 'supp_date', $PrevYear])*/    
			     ->orWhere (['between', 'book_to_unix',   strtotime($first1), strtotime($last1) ])  //(MARGIN MONTHS fix, when booking include margin months, i.e 28 Aug - 3 Sept) //strtotime("12-Aug-2019") returns unixstamp
				 // ->andWhere(['OR',['AND',[$a=>1],[$b=>1]],['AND',[$c=>1],[$d=>1]]]) //useful example
				 ->all(); 

#Render=>  return $this->render('registration' , ['model' => $model, 'data' => $data]  );
 
#Safe Echo text in view. To display as text only(dropping html, i.e  htmlspecialchars())=>  echo Html::encode($user->name);  To display with thml => echo HtmlPurifier::process($model->mydb_g_am ." geo  per  ") ; 

#Url name rule for actions like {actionAddAdmin} => {['/site/add-admin']]}
#Url name rule for Controllers like {BookingCphController}  => {['/booking-cph/index']]}. Views/booking-cph/index.php

#gets array with current user all roles rights=> $myRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id); 
#Image  echo \yii\helpers\Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/addarrow.gif' , $options = ["id"=>"sx","margin-left"=>"3%","class"=>"sunimg","width"=>"12%","title"=>"click to add a  new  one"] ); ?>

#How to write Method inside model-> $rbac = self::find()->where(['name' => $roleName])->one(); To use in Controller=>  if(AuthItem::checkIfRoleExist('adminX'))
#Gii(prettyUrl):   yii-basic-app-2.0.15/basic/web/gii  Non-pretty:  yii-basic-app-2.0.15/basic/web/index.php?r=gii
#Refresh(prevent from sending form on the reload of page)=> //setflash & then; return $this->refresh(); FALSE=> It will disable flash messages. In this case, after saving u can simply set form fields to empty value, like $model->field="";

#Throw yii exception -> throw new \yii\web\NotFoundHttpException("This exception is hand made.");
#Gii (access Gii with prettyUrl)-> http://localhost/yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/gii

#Generate Form url with Php for ajax: $URL = Yii::$app->request->baseUrl . "/site/ajax-rbac-insert-update";
#Generate Form url with JS for ajax: var loc = window.location.pathname; var dir = loc.substring(0, loc.lastIndexOf('/'));  var urlX = dir + '/ajax_get_6_month';
#Generate Form url with JS for ajax(var 2(in view)):
                            $urll = Yii::$app->getUrlManager()->getBaseUrl();
		                    $this->registerJs( "var urlX = ".Json::encode($urll).";",   yii\web\View::POS_HEAD,  'myproduct2-events-script' );






#Debugger: Eneable development mode on Local host only
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    // comment out the following two lines when deployed to production
    defined('YII_DEBUG') or define('YII_DEBUG', true);  defined('YII_ENV') or define('YII_ENV', 'dev');}

# Array from object => Countries::find()->where(['alive'=>1])->select(['country', 'code'])->asArray()->all();

#Render partial => pass $model from controller to view and then pass this $model again in view => echo $this->render('render_partial/myCommentForm', ['model'=> $model]); 
(see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/Yii2_comment_widget/frontend/views/site/voteComment.php)


		
#cancel last migration => yii migrate/down  
#GII => first generate model, then based on model generate CRUD (controller + view folder)

#beforeAction, triggered before any action in this controller. An equivalent of Access Filter =>
( see eaxample at => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/WpressBlogController.php)
  public function beforeAction($action){
      //....some code below
	  if(Yii::$app->user->isGuest){throw new \yii\web\NotFoundHttpException("You are not logged. Triggered in beforeAction()");}
      return parent::beforeAction($action); }
  
  
#yii alert button =>
      echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],])
	
	
#form hidden input=> $form->field($model, 'wpBlog_author')->hiddenInput(['autofocus' => true, 'value'=> Yii::$app->user->identity->id])->label(false); //
#Hidden input field + default value + hide lable =>  $form->field($model, 'entity')-> hiddenInput(['value'=> ''])->label(false);
#Add id to form input => 	<?= $form->field($model, 'book_from' ,['inputOptions' => ['id' => 'uniqueID',],]) ->input('date')->label(false);

#dropdown <select><option> with URL links => https://github.com/account931/portal_v2/blob/master/controllers/SiteController.php  -> function actionPortal()  + /js/autocomplete.js
#inner Join => https://github.com/account931/iShop_Yii2_Gitted_from_LocalHost/blob/master/basic/controllers/ProductsController.php   ->  function actionPlaced()
#gridview admin => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/WpressBlogController.php   -> function actionIndex() with anonymous functions and hasOne relations in view

#passing PHP object variable to javascript -> 
        use yii\helpers\Json; 
		 $this->registerJs(
            "var calenderEvents = ".Json::encode($model).";",  //"var urlXX ='" . $urlZ . "';",
             yii\web\View::POS_HEAD, 
            'name-of-script'
     );


#count AR result => $found ->count();

# to implement any your code beforeAction/afterAction  for any action in any Controller => go to config/web.php =>  
        $config = [ ...
		'on afterAction' => function (yii\base\ActionEvent $e) {
	       if( $e->action->id !== 'login' && $e->action->controller->id !== 'site' || $e->action->id !== 'error')
		      \yii\helpers\Url::remember();
        },

# see form errors if not save==> if(!$model->save(){var_dump($model->errors);}

#menu visble for ! Guest only => ['label' => 'Personal cabin', 'url' => [''] ,'visible' => (!Yii::$app->user->isGuest)],
# collapse widget => https://github.com/account931/Yii2_2018_SP_Knowledge_DB_and_DayBook/blob/master/views/site/login.php

# use diffrent alyout => $this->layout = 'mainHome'; //layout with NO navbar menu
# form save => if ($model->load(\Yii::$app->request->post()) && $model->save()) {}

========================================================
98.2.V.A(php)
#Use CLI in full screen =>   mode 800
#Check php version => php -v
#Difference in foreach (array vs object)=> foreach($_OBJECT as $b){echo $b->propertyName} vs foreach($_ARRAY as $b=>$v){echo $b . "" .$v} 
#get current URL => $_SERVER['HTTP_HOST']

#Time => date_default_timezone_set('Europe/Kiev'); date('m/d/Y h:i:s a', time()); // 11/21/2019 03:51:50 pm
#Today date => date('j-M-D-Y'); //21-Nov-Thu-2019
#Unix to normal => date('d M Y H:i:s Z', $Unix) ;


#create Enum SQL => choose enum + in Length/Values column put there : '0' ,'1'
# cURL library => https://github.com/account931/MapBox_Store_Location_2019/blob/master/Classes/AddMarker.php

#function return mulitple values => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/models/BookingCph.php
    function some(){return array($a, $b);}  $r = some(); $value1 = $r[0]; $value2 = $r[1];  
    function some(){return array('a'=> $a, 'b'=> $b);}  $r = some(); $value1 = $r['a']; $value2 = $r['b'];
#Php constructor =>
               class Human{ var $name; function  __construct($nameofperson){ $this -> name= $nameofperson; }  function set_name($newname){$this ->name=$newname;}
			   $firstObject = new Human("Joseph"); //calling constructor

# Enable error reporting for NOTICES => 	 ini_set('display_errors', 1);  error_reporting(E_NOTICE);
	 
JS=>
   # IOS, safari JS click fix => add empty {onClick}  => <span onClick="" id="someID"></span>   OR => cursor: pointer;
   # JS alert object => alert(JSON.stringify(aucompleteX, null, 4));
   # animate=>  $(".all-6-month").stop().fadeOut("slow",function(){ $(this).html(finalText)}).fadeIn(2000);
   # click for for newly generated => $(document).on("click", '.subfolder', function() {      //for newly generated 
   #get the clicked id=> //alert(this.id); // this.attr("id");   vs  var b = $(this);
   #to work on mobile only  => if(screen.width <= 640){ 
   #data-attribute =>  <div data-myUnix=''> =>  this.getAttribute("data-myUnix");
   #js ptototype (constructor) =>
         function Person(name, age) { this.name = name; this.age = age; }
         const me = new Person('Joe', 20);
		 Person.prototype.greet = function() { console.log('Hi', this.name); }
         me.greet(); // Hi Joe
   #callback js => function doHomework(subject, callback) {alert('someText ${subject} '); callback(); } => function someFunct(){} => doHomework('math', someFunct);
   
   	
   #dropping zzz.com.ua Adss => //drop div sign with money donut, deployed in /countdown18/
	    $('div:contains("Ця сторінка розміщена безкоштовно ")').css('display', 'none'); $('div:contains("is hosted for free by zzz.com.ua, if you are owner of this page")').css('display', 'none'); 
	   //droping Mint.me banner (in /countdown18/)
	   setTimeout(function(){ 
	      $('div').each(function() {
             if ($(this).find('img').length) { var a_href = $(this).find('div a').attr('href'); if( a_href == "https://www.mintme.com/"){  $(this).find('div').css('display', 'none');}}
         });  }, 2000);
	#  myVar = setInterval(countUserRegisterRequests, 1000 );

   

CSS=>
   #Bootstrap grid => <div class="col-lg-3 col-md-3 col-sm-3">  <div class="col-sm-6 col-xs-12">
   # css animation smoothly=> transition: 1.25s; -webkit-animation: fadeIn 1s;animation: fadeIn 1s;
   # media query => @media screen and (max-width: 480px) { }
   # div shadow => .shadowX {box-shadow: 0 1px 4px rgba(0, 0, 0, .3), -23px 0 20px -23px rgba(0, 0, 0, .6), 23px 0 20px -23px rgba(0, 0, 0, .6), inset 0 0 40px rgba(0, 0, 0, .1); }
   # div shadow 2 => .shadowX22 {-moz-box-shadow: inset 0px 0px 47px 3px #4c3f37; -webkit-box-shadow: inset 0px 0px 47px 3px #4c3f37; box-shadow: inset 0px 0px 277px 3px #4c3f37; }
   # text shadow => https://html-css-js.com/css/generator/text-shadow/


   
   
======================================================
98.3.V.A example references (CSS,JS,Php)
#Pure CSS/JS Loader => https://github.com/account931/regist_login_DAO_2019/blob/master/README.md
                    => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/controllers/WpressBlogController.php (use loader_Wpress.css + wpress.js (loader section))
#React Bakcground Loader =>  https://github.com/account931/myWaze_GeoCode_Modules_CommonJS-18/blob/master/REDUX_REACT_REDUX/README_MY_REDUX.txt










=======================================================
99. Known Errors
99.1 While trying to add RBAC migrations there is a Error "You should configure "authManager", while u have already added authManager to component in /config/web.php.
  Solution: add same config {  'authManager' => ['class' => 'yii\rbac\DbManager',],} to /config/console.php (for Basic template). For Advanced template, add it  to /console/config/main.php and not in the backend or frontend configuration files.
  
99.2 Two Yii2 application Login Conflict=> when u log in to 1st Yii2 app, the 2nd automatically log out & vice versa
  To fix add to config/main.php to 
          'components' => [
		        //other components........
		        'user' => [
				    //.....
				    'identityCookie' => ['name' => 'YOUR_UNIQUE_NAME_HERE'], //Two Yii2 application Login Conflict mega Fix
                 ], ]
  
  
  
  
  
  
  