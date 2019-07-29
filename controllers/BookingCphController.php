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

	
	
	
	
	
 
 

    public function actionIndex() //uses web/js/booking_cph.js!!!!
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
	 
	 
	 
	 





        
        return $this->render('index' , [
            'model' => $model,  //form model of models/BookingCph
			/*'current' => $current, // Act Record only- for current month summary
            'current1' => $current1, // Act Record only- for Previous month summary-> created dynamiclyy in for loop
            'current2' => $current2, // Act Record only- for Previous month summary
            'current3' => $current3, // Act Record only- for Previous month summary
            'current4' => $current4, 
            'current5' => $current5, 
           //'current6' => $current6, */
		    'all_records' => $all_records //just for test, gets all record from SQL table{booking_cph}
			
        ]);
    }
    
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	//function that works with ajax sent from js/booking_cph.js -> function get_6_month()
    public function actionAjax_get_6_month() //ajax
    // **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // **                                                                                  **
    {
		date_default_timezone_set('UTC');  //use ('UTC') to avoid -1 day result    //('europe/kiev')	('UTC')
		
		$array_All_Month = array();//will store all 6 month data
		$array_All_sqlData = array();//will store all sql results
		$array_All_Unix = array();//will store all Unix start & stop time for all 6 month, will be in format [[CurrentStart, Currentend], [start-1, end-1], [start-2, end-2]]
		$array_All_CountDays = array();//will store counts of booked days for every month (for badges)
		
		
		$MonthList= array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"); //General array for all click actions
       //General arrayweek days for all click actions
        $weekdays = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
       
		//------------------
		
		
		
		 //Start Procedure for 1 current month only************
		 //gets current month/year
	     $current = date('M', strtotime(date('Y-m'))) . " " . date('Y', strtotime(date('Y-m'))); //i.e Jul 2019
		 array_push($array_All_Month, $current); //adds current month to array
		 
		 //test first/last days
		 $monthZZZ = date('n'); //current month in digits, i.e 2
		 
		 $first = date("Y-m-d", mktime(0, 0, 0, $monthZZZ  ,1 ,date("Y"))); ////gets the first day of the current monthreturns "2019-05-01"
		 $dayofweek_first = date('w', strtotime($first)); //returns day of week of 1st day , i.e 3,4,5...
		 
		 $last = date("Y-m-d", mktime(0, 0, 0, $monthZZZ+1,0,date("Y"))); //gets the last day of the current month //returns "2019-05-31"
		 $dayofweek_last = date('w', strtotime($last)); //returns day of week of 1st day , i.e 3,4,5...
		 
		 //gets Unix Start Time & Unix End Time of the current month (i.e Unix of the 1st & last day)
		 $array_tempo = array(strtotime($first), strtotime($last)); //push current month unix start/stop Unix time to subarray // returns [1556654400,1559246400]
		 array_push($array_All_Unix, $array_tempo); //push subarray to array in order to have structure [[35, 57], [35, 57], [35, 57],]
		 
		  //SQL for 1 current month only
		  $monthData = BookingCph::find() ->orderBy ('book_id DESC')  /*->limit('5')*/ ->where([ 'book_user' => Yii::$app->user->identity->username, /* 'mydb_id'=>1*/   ])  ->andWhere(['between', 'book_from_unix', strtotime($first), strtotime($last)   ])   /*->andFilterWhere(['like', 'supp_date', $PrevMonth])  ->andFilterWhere(['like', 'supp_date', $PrevYear])*/    ->all(); 
          array_push($array_All_sqlData, $monthData); //adds this current month booking data to array $array_All_sqlData
		  
		  
		  //count amount of booked days for this 1 current month. Unix from & to are from DB results
		  $countX = 0;
		  foreach ($monthData as $a){
		      $number = ($a->book_to_unix - $a->book_from_unix)/60/60/24;
		      //$from = strtotime($last); $to = strtotime($first); $diff = $from - $to;   $countX = $diff;///60/60/24;
			  $countX = $countX + $number;
		  }
		  array_push($array_All_CountDays, $countX); //adds this current month booked days (in numbers, i.e 22) to array 
		  //END count amount of booked days for this 1 current month. Unix from & to are from DB results
		  
		 //END  Procedure for 1 current month only*************
		 
		 
		 
		 
		 
		
	     // FIND SQL DATA for ALL Future MONTHS IN FOR LOOP
         for ($i = 1; $i < 6; $i++){  //($i=1; $i<4; $i++)  // for 5 future month
            //Start DATE for Previous month  ONLY----------------------------
            $PrevMonth = date('M', strtotime(date('Y-m'). " + " .$i. " month")); //i.e Jul  //$PrevMonth=date('M', strtotime(date('Y-m')." -1 month"));         
            $PrevYear =  date('Y', strtotime(date('Y-m')." + " .$i. " month"));  //i.e 2019 // $PrevYear=date('Y', strtotime(date('Y-m')." -1 month"));// getting previous  month  and  year;
        
		    ${'current'.$i} = $PrevMonth . " " . $PrevYear; //i.e Jul 2019
			array_push($array_All_Month, ${'current'.$i}); //adds prev months to array in a loop
			
			//!!!!!!!
			$may =  array_search($PrevMonth , $MonthList); //search the index of $PrevMonth  in array, i.e index of Jul
			$may = $may + 1;
			$first1 = date("Y-m-d", mktime(0, 0, 0, $may  ,1 ,date("Y"))); //returns "2019-05-01"
		    $last1 = date("Y-m-d", mktime(0, 0, 0, $may+1,0,date("Y"))); //returns "2019-05-31"
			
			//gets Unix Start Time & Unix End Time of the current month (i.e Unix of the 1st & last day)
		    $array_tempo = array(strtotime($first1), strtotime($last1)); //push current month unix start/stop Unix time to subarray // returns [1556654400,1559246400]
		    array_push($array_All_Unix, $array_tempo); //push subarray to array in order to have structure [[35, 57], [35, 57], [35, 57],]
		
		
		
			
		    //Find data for a specific Previous month one by one in a loop
           //creating array {SmonthData1,SmonthData2,}
            ${'monthData'.$i} = BookingCph::find()   ->orderBy ('book_id DESC')  /*->limit('5')*/ ->where([ 'book_user' => Yii::$app->user->identity->username, /* 'mydb_id'=>1*/   ])  ->andWhere(['between', 'book_from_unix', strtotime($first1), strtotime($last1)   ])   /*->andFilterWhere(['like', 'supp_date', $PrevMonth])  ->andFilterWhere(['like', 'supp_date', $PrevYear])*/    ->all(); 
            array_push($array_All_sqlData, ${'monthData'.$i}); //adds current month booking data to array $array_All_sqlData
			//END DATE for Previous month  ONLY-------------------------------
			
			
			
			//count amount of booked days for for a specific Previous month one by one in a loop. Unix from & to are from DB results
		    $countX = 0;
		    foreach (${'monthData'.$i} as $a){
		      $number = ($a->book_to_unix - $a->book_from_unix)/60/60/24;
		      //$from = strtotime($last); $to = strtotime($first); $diff = $from - $to;   $countX = $diff;///60/60/24;
			  $countX = $countX + $number;
		    }
		    array_push($array_All_CountDays, $countX); //adds this current month booked days (in numbers, i.e 22) to array 
		   //END count amount of booked days for for a specific Previous month one by one in a loop. Unix from & to are from DB results
			
		
         } // END FOR(++)
    //END  FIND SQL DATA for ALL PREVIOUS MONTHS IN FOR LOOP
		
		
		
		
		
		
		//RETURN JSON DATA
		  // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => "OK", // return ajx status
             'code' => 100,	 
			 'allMonths' => $array_All_Month,
			 'firstDay' => $first,
			 'dayofweekFirst' => $weekdays[$dayofweek_first], //returns Sun, Mond, Tue....
			 'dayofweek_last' => $weekdays[$dayofweek_last],   //returns Sun, Mond, Tue....
			 'array_All_sqlData' => $array_All_sqlData,    //will all sql DB booking RESULTS,
			 'array_All_Unix' => $array_All_Unix,          //will store all Unix start & stop time for all 6 month, will be in format [[CurrentStart, Currentend], [start-1, end-1], [start-2, end-2]]
			 'array_All_CountDays' => $array_All_CountDays //will store counts of booked days for every month (for badges)
          				 
          ]; 
	}
    
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************


	


}
