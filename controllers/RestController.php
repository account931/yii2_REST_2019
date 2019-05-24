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
	

   public $modelClass = 'app\models\User';
   
   /*
   public function actionNew()
    {
		$result = $modelClass::find()
        //->where(['>', 'population', 70000000])
        ->all();
        return $result;
	}*/
   
}
