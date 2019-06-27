<?php
//Rest controller. actionIndex & other actions are inherited from yii\rest\ActiveController that is why this controller will work with {public $modelClass} only & no visible actions
namespace app\controllers;

use Yii;
use app\models\User;//just for my custom Rest actionNew()

use yii\rest\ActiveController;
//use yii\web\NotFoundHttpException;
//use yii\web\Response;

use yii\filters\auth\HttpBasicAuth;  //For using REST API Authorized access only (with token only)
use yii\filters\auth\CompositeAuth;  //For using REST API Authorized access only
use yii\filters\auth\HttpBearerAuth; //For using REST API Authorized access only
use yii\filters\auth\QueryParamAuth; //For using REST API Authorized access only



//RestController implements the CRUD actions for User model.
class RestController extends ActiveController
{
   
   //Define the model table for RestFul Api to work with
   public $modelClass = 'app\models\User';
   

   
   
   /*
   public function init()
    {
        parent::init();
        Yii::$app->response->format = Response::FORMAT_JSON;
    }*/

   //public $enableCsrfValidation = false; //disable _csrf
   
   
 
   
   
   
   
   
   
   
//TO ALLOW CORS cross-domian ajax requests, used in behaviors() 
//List of allowed domains.
//Note: Restriction works only for AJAX (using CORS, is not secure).
//@return array List of domains, that can access to this API
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
public static function allowedDomains()
{
    return [
         '*',                        // star allows all domains
		'http: // localhost: 3000',
        'http://test1.example.com',
        'http://test2.example.com',
    ];
}
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************
//END TO ALLOW CORS cross-domian ajax requests, used in behaviors()









public function behaviors()
{
	
	 
	//array_merge accepts as args arrays and merge them in one  
    return array_merge(parent::behaviors(), [

        //To allow cross-domain AJAX request for Rest API
        'corsFilter'  => [
            'class' => \yii\filters\Cors::className(),
            'cors'  => [
                // restrict access to domains:
                'Origin'                           => static::allowedDomains(),
                'Access-Control-Request-Method'    => ['POST'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
            ],
        ],
		//END to allow cross-domain AJAX request for Rest API

		
		
		
		//This enables REST API Authorized access only (with token only). Token is stored in DB, field "access-token" Comment it and Rest Api will work without access-token.
		//test url with token=> http://localhost/yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/rests?access-token=1111
		'authenticator' => [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ], 
		//END This enables REST API Authorized access only (with token only). Token is stored in DB, field "access-token" Comment it and Rest Api will work without access-token.

		
		
		//u may list here other behaviour settings........
		
		//RateLimeter
		'rateLimiter' => [
		   'class' => \yii\filters\RateLimiter::className(),
		   'enableRateLimitHeaders' => false,
		],
		//END RateLimeter
		
		 //u may list here other behaviour settings........
    ]
	
	
	
	);	//end array_merge
	
	
	
	
	//Behavior array may be also rewritten in this variant
	/*$behaviors = parent::behaviors();
    $behaviors['authenticator'] = [
        'class' => HttpBasicAuth::className(),
    ];
    return $behaviors;*/
	//END Behavior array may be also rewritten in this variant 

}
   
   
   
   
   
   
   
//my RESTFUL custom action, does not need any additional setting in config. 
//Called by http://localhost/yii2_REST/yii-basic-app-2.0.15/basic/web/rest/new
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
   public function actionNew()
    {
		$result = User::find()
            //->where(['>', 'population', 70000000])
			//->where(['email' => Yii::$app->user->identity->username])
            ->all();
        return $result;
		
		/*$items = ['one1', 'two2', 'three' => ['a_sub', 'b_sub', 'c_sub']];
        return $items;*/
	}
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************
//END my RESTFUL custom action, does not need any additional setting in config.






}
