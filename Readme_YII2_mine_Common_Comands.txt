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
8.Yii RBAC
9.Error deep_copy.php
10.Pagination, PageLinker, AR
11.Flash message
12.DataProvider(can be used both in GridViw and ListView) + GridView + ListView.
13.Yii Access Filter (ACF)
14.V.A(ActRec,create URL, redirect, get $_POST[''], etc)
15. Known Errors

Yii ajax(shop)
crsf
Widget
Access Control filter
 

 
 
 
 
 
 =======================================
1.Yii2 CLI Composer install & init.
CLI:
(if CLI commands dont work, add {php} before-> i.e {php migrate}). 
#init  -> to init index.php in folder "web" (or {php init})
#yii migrate -> apply migration to DB(if migration is available, from start migration is available in advanced, not in basic)
#composer update/composer install  -> update dependencies




========================================
2.Migration.
How to Add your migration(for instance in Basic, where no migration is avialble from start)
#yii migrate/create create_user_table or (php yii migrate/create create_user_table)
#yii migrate  ->(or {php yii migrate}), just command without migrate file name from {console/migration} to apply all migrations.

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
3. go to /migration/m000000_000000_create_user_table.php and paste code from Advanced template migration or create your own. Paste ONLY methods {up() down()}!!!!! DON"T TOUCH/modify CLASS NAME.
2. apply migration-> php yii migrate
3. modify code in /models/User.php. (see /Files/Yii2_basic/models/Users.php)
4. create model for registration in /models/SignupForm.php (see /Files/Yii2_basic/models/SignupForm.php)
5. add {use app\models\SignupForm} + {function actionSignup()} in /controller/SiteController
6. create  /views/site/signup.php
7. add registration URL to menu in /views/layouts/main.php 
  
  
  
  
  
  
  
==============================================================
6.Yii Error Handler (how to handle Exceptions).
#You can throw your custom Yii exception with following code ->   throw new \yii\web\NotFoundHttpException("Your text");
#If Yii2 encounters your exception or any internal error, it will use built-in ErrorHandler.

How to use built-in ErrorHandler, i.e when Yii2 encounters your custom Exception or some error (i.e 404 NOT FOUND):
By default, the following code is already deployed in Yii2 application. Just make sure, this code exists, otherwise add it manually:
1. In config/web.php set action for errors (inside {'components' => []}) ->  'errorHandler' => ['errorAction' => 'site/error',],  //Note that by default SiteController does not have ActionError(), but the handler will work, as it uses Class \vendor\yii\web\ErrorAction. For rendering view it  uses views/site/error.php
2. In controller->  public function actions() return [ 'error' => ['class' => 'yii\web\ErrorAction',]. 
In above case, Yii2 will use template from views/site/error.php to display Error page (i.e NOT FOUND PAGE or your custom Exception).
To pass and show an Exception message to view, use in views/site/error.php {$message}. I.e can use in <title>, or pass to flash/alert div.

This built-in  error Handler will use built \vendor\yii\web\ErrorAction,if you want create your own, comment it and create in controller your actionError()
3. If you created your own {actionError()} and it does not work, try in web/index.php ->  define('YII_ENABLE_ERROR_HANDLER', true);//to show my personal error handler











===========================================================
7.Yii Restful API
#Yii Rest
Yii2 REST  -> http://developer.uz/blog/restful-api-in-yii2/

test URL(if prettyUrl off) -> http://localhost/yii2_REST/yii-basic-app-2.0.15/basic/web/index.php?r=rest
test URL, Pretty URL, retuns  only ID and email with $_GET specified like this: http://localhost/yii2_REST/yii-basic-app-2.0.15/basic/web/rests?fields=id,email
test URL(ControllerRest/actionView)(view 1 record)-> http://localhost/yii2_REST/yii-basic-app-2.0.15/basic/web/rest/view/4


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


8.

			
			
			
			
			

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
10.Pagination, PageLinker, AR
In Controller:
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

$query=SupportData::find()->orderBy ('sData_id DESC')->andFilterWhere(['like', 'sData_text', Yii::$app->getRequest()->getQueryParam('q')])/*->where(['sData_text'=>Yii::$app->getRequest()->getQueryParam('q') ])*/ /* ->all()*/;
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
14.V.A(ActRec,create URL, redirect, get $_POST[''], etc)

#Create URL =>$infoLink= Html::a( "more  info", ["/site/about", "period" => "",   ] /* $url = null*/, $options = ["title" => "more  info",] ); 
#Create URL2 =>  use yii\helpers\Url; $url = Url::to(['message/view', 'id' => 100]);

#Redirect =>  return $this->redirect(['support-data/index']);

#To get $_GET['some'] => if (Yii::$app->getRequest()->getQueryParam('traceURL')=="supp_kbase"){}
 
#To check if user has logged=> if(!Yii::$app->user->isGuest){ 

#To get logged user name/id => Yii::$app->user->identity->username; Yii::$app->user->identity->id;

#Active Record (in view use simple foreach(){})=> $activeRec = Mydbstart::find() ->orderBy ('mydb_id DESC') ->limit('5') ->where(['mydb_user' => Yii::$app->user->identity->username]) ->all();
#Render=>  return $this->render('registration' , ['model' => $model, 'data' => $data]  );
 
#Safe Echo text in view=>  <?= HtmlPurifier::process($model->mydb_g_am ." geo  per  ") ;  ?>

#Url name rule for actions like {actionAddAdmin} => {['/site/add-admin']]}
#gets array with current user all roles rights=> $myRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id); 
#Image  echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/addarrow.gif' , $options = ["id"=>"sx","margin-left"=>"3%","class"=>"sunimg","width"=>"12%","title"=>"click to add a  new  one"] ); ?>

#How to write Method inside model-> $rbac = self::find()->where(['name' => $roleName])->one(); To use in Controller=>  if(AuthItem::checkIfRoleExist('adminX'))
#Gii(prettyUrl):   yii-basic-app-2.0.15/basic/web/gii  Non-pretty:  yii-basic-app-2.0.15/basic/web/index.php?r=gii
#Refresh(prevent from sending form on the reload of page)=> return $this->refresh();

#Throw yii exception -> throw new \yii\web\NotFoundHttpException("This exception is hand made.");
=======================================================
15. Known Errors
15.1 While trying to add RBAC migrations there is a Error "You should configure "authManager", while u have already added authManager to component in /config/web.php.
  Solution: add same config {  'authManager' => ['class' => 'yii\rbac\DbManager',],} to /config/console.php (for Basic template). For Advanced template, add it  to /console/config/main.php and not in the backend or frontend configuration files.
  
  
  
  
  
  
  
  
  