<?php

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
   
   
}
