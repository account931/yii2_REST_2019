<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\BookingCph; //table BookingCph, SQL table{booking_cph}


class BookingCphController extends Controller
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
                        'roles' => ['@'],
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

	
	
	
	
	
 
 

    public function actionIndex()
 // **************************************************************************************
 // **************************************************************************************
 // **                                                                                  **
 // **                                                                                  **
    {
	 date_default_timezone_set('UTC');  //use ('UTC') to avoid -1 day result    //('europe/kiev')	('UTC')
		
	 $model = new BookingCph(); //model of SQL table{booking_cph},  models/BookingCph. Used pass to view to create a form.
	 
	 //just for test, gets all record from SQL table{booking_cph}
	 $all_records = BookingCph::find()->where(['book_user' => Yii::$app->user->identity->username])->all();
	 
	 //if u filled in the form to book a new date range for a new guest
	 if ($model->load(\Yii::$app->request->post()) && $model->save()) {
           \Yii::$app->session->setFlash('successX', 'Successfully Booked');
     }
	 
	 
	 
	 //gets current month/year
	 $current = date('M', strtotime(date('Y-m'))) . " " . date('Y', strtotime(date('Y-m')));
		
	 // FIND SQL DATA for ALL Future MONTHS IN FOR LOOP
     for ($i = 1; $i < 6; $i++){  //($i=1; $i<4; $i++)  // for 5 future month
        //Start DATE for Previous month  ONLY----------------------------
        $PrevMonth = date('M', strtotime(date('Y-m'). " + " .$i. " month")); //$PrevMonth=date('M', strtotime(date('Y-m')." -1 month"));         
        $PrevYear =  date('Y', strtotime(date('Y-m')." + " .$i. " month"));  // $PrevYear=date('Y', strtotime(date('Y-m')." -1 month"));// getting previous  month  and  year;
        
		${'current'.$i} = $PrevMonth . " " . $PrevYear;
		//Find data for specific Previous month
           //createing array {Scurrent1,Scurrent2,}
            //${'current'.$i} = Support::find()   ->orderBy ('supp_id DESC')  /*->limit('5')*/ ->where([   'supp_user' => Yii::$app->user->identity->username, /* 'mydb_id'=>1*/   ]) /* ->andWhere(['between', 'mydb_date', $startDAte, $endDAte   ])  */ ->andFilterWhere(['like', 'supp_date', $PrevMonth])  ->andFilterWhere(['like', 'supp_date', $PrevYear])    ->all(); 
        //END DATE for Previous month  ONLY-------------------------------
		
     } // END FOR(++)
    //END  FIND SQL DATA for ALL PREVIOUS MONTHS IN FOR LOOP





        
        return $this->render('index' , [
            'model' => $model,  //form model of models/BookingCph
			'current' => $current, // Act Record only- for current month summary
            'current1' => $current1, // Act Record only- for Previous month summary-> created dynamiclyy in for loop
            'current2' => $current2, // Act Record only- for Previous month summary
            'current3' => $current3, // Act Record only- for Previous month summary
            'current4' => $current4, 
            'current5' => $current5, 
           //'current6' => $current6, 
		    'all_records' => $all_records //just for test, gets all record from SQL table{booking_cph}
			
        ]);
    }
    
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	


}
