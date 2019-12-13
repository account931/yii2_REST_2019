<?php
//Test for middle
// How should work: user at {test-middle/index} enters email -> if email in SQL DB -> redirect to {test-middle/existed-account} with entered email as S_GET[''] to login
//  -> if email in NOT SQL DB -> redirect to {test-middle/new-account} that sends email confirmation

//Copied to \models\TestMiddle following models (& thus edited):  LoginForm, SignupForm, User.

//To login by email not username: 
    //in models\TestMiddle\User added => public static function findByEmail($email){return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]); }
    //in models\TestMiddle\LoginForm =>  {$username} change to  {$email} + adds to rules()  [['email'], 'email'] +  in getUser() change {User::findByUsername($this->username)} to {User::findByEmail($this->email)}
	//in \views\test-middle\password change username field to => echo $form->field($model, 'email')->hiddenInput([ 'value'=> Yii::$app->request->get('emailZ') ])->label(false);
	
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
		    /*
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
			*/
			
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
			
			if($userModel ){ //if email exists in DB
				return $this->redirect(['test-middle/existed-account' , 'emailZ' => $model->emailX ]); //passing {emailZ} as $_GET['emailZ'] in the URL
			
			} else { //if a user is NEW, email is not in DB
				
				//return $this->redirect(['test-middle/new-account', 'emailZ' => $model->emailX ]);
				if ($model->sendEmail($model->emailX)) {
				    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['test-middle/new-account', 'token' => $GLOBALS['myToken']]); //just for test in flash, must be DELETED in Production
				    $text = "Your email is new to us. We sent you an activation letter.<br> Follow the link below to comfirm your registration: <a href = $resetLink >$resetLink</a> "; //just for test in flash, must be DELETED in Production
                    Yii::$app->session->setFlash('successX', '<i class="fa fa-envelope-o" style="font-size:36px"></i><br><b>TEST FLASH -> in PRODUCTION it should not contain Link as it is Classified </b><br>Check your email <b>' .$model->emailX . ' </b> for further instructions.<br> '. $text ); //$text is just for test in flash, must be DELETED in Production
                    //return $this->goHome();
					 $model->emailX = ""; //reset the field
                } else {
                    Yii::$app->session->setFlash('error', 'Sorry, we are unable to send you registration mail');
                }
				
			} //end if a user is NEW, email is not in DB
			
			//if($model->save()){}
		}
        
        return $this->render('index' , [
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
     public function actionNewAccount($token) {
		 
		 $model = new SignupForm();
		 
		 //copy from Site
		 
		 return $this->render('new-account' , [
            'model' => $model,
            'token' => $token			
        ]);
	 }
	




	
//if email exists in DB, so account exists, use authentication (email/password). Email is passed as hidden field
// **************************************************************************************
 // **************************************************************************************
 // **                                                                                  **
 // **                                                                                  **
     public function actionExistedAccount() {
          
		  //copy from Site
		 /*
		  if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
		*/
		
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
