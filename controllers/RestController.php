<?php
//Rest controller. actionIndex & other actions are inherited from yii\rest\ActiveController that is why this controller will work with {public $modelClass} only & no visible actions
namespace app\controllers;

use Yii;
//use app\models\User;

use yii\rest\ActiveController;
//use yii\web\NotFoundHttpException;
//use yii\web\Response;


/**
 * RestController implements the CRUD actions for User model.
 */
class RestController extends ActiveController
{
  
   /*
   public function init()
    {
        parent::init();
        Yii::$app->response->format = Response::FORMAT_JSON;
    }*/

    /*
	  public function actionTest(){
        $items = ['one', 'two', 'three' => ['a', 'b', 'c']];
        return $items;
    }
	*/
	

   //public $enableCsrfValidation = false; //disable _csrf
   public $modelClass = 'app\models\User';
   
   
   
   
   
   
   
  //TO ALLOW CORS cross-domian ajax requests-------------------------------- 
   /**
 * List of allowed domains.
 * Note: Restriction works only for AJAX (using CORS, is not secure).
 *
 * @return array List of domains, that can access to this API
 */
public static function allowedDomains()
{
    return [
         '*',                        // star allows all domains
		'http: // localhost: 3000',
        'http://test1.example.com',
        'http://test2.example.com',
    ];
}

/**
 * @inheritdoc
 */
public function behaviors()
{
    return array_merge(parent::behaviors(), [

        // For cross-domain AJAX request
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

    ]);
	
//END TO ALLOW CORS cross-domian ajax requests-------------------------------- 	
	
	
	
	
	
}
   /*
   public function actionNew()
    {
		$result = $modelClass::find()
        //->where(['>', 'population', 70000000])
        ->all();
        return $result;
	}*/
   
}
