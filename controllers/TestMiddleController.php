<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\TestMiddle\StartForm;
use app\models\TestMiddle\SignupForm; //copied from site
use app\models\TestMiddle\User;      //copied from site
use app\models\TestMiddle\LoginForm; //copied from site



class TestMiddleController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
				 
				//following actions are available to logged users only 
                'only' => ['index', ''], 
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],  //@ => logged only
                    ],
					
					
                ],
            ],
			
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

	
	
	
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
		    //must be commented if want to use person actionError, otherwise errors will be handled with built vendor/yii\web\ErrorAction
            'error' => [
                'class' => 'yii\web\ErrorAction',  //predifined error handler, comment if want to use my personal
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	
	
	
	
	
 
 

    
 // **************************************************************************************
 // **************************************************************************************
 // **                                                                                  **
 // **                                                                                  **
     public function actionIndex() {
	
	 
	   $model = new StartForm(); //initial form input
	   
	   
	    if ($model->load(\Yii::$app->request->post())) {
			
			$userModel = User::find()-> where( 'email =:status', [':status' => $model->emailX])-> one(); 
			
			if($userModel ){ //if mail exists in DB
				return $this->redirect(['test-middle/existed-account' , 'emailZ' => $model->emailX ]); //passing {emailZ} as $_GET['emailZ'] in the URL
			} else {
				return $this->redirect(['test-middle/new-account', 'emailZ' => $model->emailX ]);
			}
			
			//if($model->save()){}
		}
        
        return $this->render('middle' , [
            'model' => $model,  //
        ]);
    }
    
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	// **************************************************************************************
 // **************************************************************************************
 // **                                                                                  **
 // **                                                                                  **
     public function actionNewAccount() {
		 
		 $model = new SignupForm();
		 
		 //copy from Site
		 
		 return $this->render('new-account' , [
            'model' => $model,  
        ]);
	 }
	




	

// **************************************************************************************
 // **************************************************************************************
 // **                                                                                  **
 // **                                                                                  **
     public function actionExistedAccount() {
          
		  //copy from Site
		 
		  if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
		
		
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			//return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
            return $this->goBack();
		}
		 
		 return $this->render('password' , [
            'model' => $model,  
        ]);

     }



	 

}
