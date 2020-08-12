<?php
////Multi steps quiz form
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ManualAutoQuiz\Manual_Auto_Quiz;


use yii\base\ErrorException;
use yii\web\NotFoundHttpException;

class ManualAutoQuizController extends Controller
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
                    throw new \yii\web\NotFoundHttpException("Only logged users are permitted(set in behaviors)!!!");
                 },
				 //END To show message to unlogged users. Without this unlogged users will be just redirected to login page
				 
				//following actions are available to logged users only 
                'only' => ['logout', 'add-admin', 'get-token', 'change-password'], //actionGetToken, actionChangePassword
                'rules' => [
                    [
                        'actions' => ['logout', 'add-admin', 'get-token', 'change-password'], //actionGetToken, actionChangePassword
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					
					// RBAC roles: actionAbout is avialable for users with role {adminX}-----
					[
                    'actions' => ['about'],
                    'allow' => true,
                    'roles' => ['adminX'],
                    ],
					//End RBAC roles: actionAbout is avialable for users with role {adminX}-----
					
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
                'class' => 'yii\web\ErrorAction',  //pre-difined error handler, comment if want to use my personal
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	
	
	

	
	
	
	
    /**
     * Displays Quiz page, it just renders quiz form.
     *
     * @return string
     */
	 //----------- My manual multi steps Quiz Builder with JQ Validation and RadioButtons in form of buttons  ----------------------->
	//-- Multi steps quiz form content is loaded to <div id="quizDiv"> by JS ajax in (my-manual-quiz-builder.js.js). List of questions is in W3schoolController/actionAjaxQuizQuestionsList(). See details => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/web/js/W3school/my-manual-quiz-builder.js-->
    public function actionIndex()
    {
		//throw new NotFoundHttpException('Yeahhh');

        return $this->render('index');
    }


	
	
	
	
	 /**
     * Contains list of questions for Quiz in form of array.
     * is gotten via ajax from /views/w3school/sub_views/my-manual-quiz-builder
	 * 	<!-- Multi steps quiz form content is loaded to <div id="quizDiv"> in {\yii2_REST_and_Rbac_2019\yii-basic-app-2.0.15\basic\views\w3school\index.php taht uses subfolder/my-manual-quiz-builder.php} by JS ajax in (my-manual-quiz-builder.js.js). See details => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/web/js/W3school/my-manual-quiz-builder.js-->
     * @return json
     */
    public function actionAjaxQuizQuestionsList()
    {
		$model = new Manual_Auto_Quiz();
		
		//array to contain all quiz questions, set your questions only here, all the rest will be done automatically
		//if you want to add some new array element to be displayed in quiz, i.e image, etc, after adding this el here, process it in next step {//filtering $quizQuestionList_Initial} where we specify what is returned to client, e.g {'correctAnswer'} is not ruturned for security reson
		$quizQuestionList_Initial = array(
		
		    //question1 
		    array ( 
		       'questions' => 'What district has earned the title of the hippest district in Copenhagen and  popular for its trendy hostels, organic restaurants, and independent shops?',
			   'answer' => array('Vesterbro', 'Norrebro', 'Amager', 'Orestad'),
			   'name_id_attr' => 'question9311', //must be unique
			   'correctAnswer' => 'Vesterbro'
		    ),
		   
		    //question2 
		    array ( 
		       'questions' => 'One of the oldest districts in Copenhagen’s Indre By (inner city)? Famouse for colourful sections of the old town, which is tucked away just off the tourist track of the Strøget pedestrian street, is Copenhagen’s Bohemian quarter, a diverse community that’s a gathering place for artistic types',
			   'answer' => array('The Latin Quarter', 'Norrebro', 'Amager', 'Orestad'),
			   'name_id_attr' => 'question9312', //must be unique
			   'correctAnswer' => 'The Latin Quarter'
		    ),
		   
		    //question3
		    array ( 
		       'questions' => 'The most touristed neighbourhood in Copenhagen and home to beloved writer Hans Christian Andersen for approximately 20 years?',
			   'answer' => array('Nyhavn', 'Norrebro', 'Amager', 'Orestad'),
			   'name_id_attr' => 'question9313', //must be unique
			   'correctAnswer' => 'Nyhavn'
		    ),
			
			//question4
		    array ( 
		       'questions' => 'Where is a red light district in Copenhagen??',
			   'answer' => array('Vesterbro', 'Norrebro', 'Amager', 'Orestad'),
			   'name_id_attr' => 'question9314', //must be unique
			   'correctAnswer' => 'Vesterbro'
		    ),
		   
		);
		
		
        //if request is not ajax, stop anything further
        if (!Yii::$app->request->isAjax) { /* текущий запрос является AJAX запросом */ 
		    return "screw you";
		}

		
		//if it is an ajax request to check correct anwsers, i.e request contains _POST['serverAnswer']
		if(isset($_POST['serverAnswer'])){
			
			//check if $_POST['serverAnswer']) length ==
			
		   //$_POST['serverAnswer']) is a string (as it is sent via ajax as data:{serverAnswer:$("#quiz_form").serialize()} ), so convert it here to array
		   $answers = explode('&', $_POST['serverAnswer']); //convers to array ('question9311=Vesterbro', 'question9312=Amager', etc)
		   $answerArrayFinal = array();
		   
		   //reurns normal array $answerArrayFinal with ajax answers, ie ['name9311'=>'Nuhavn', 'name9312'=>'Amager']
		   foreach($answers as $v){
			   $v = str_replace("%20"," ", $v); //removes %20 symbols from string if any, e.g {The%Latin%Quarter} comes from ajax, as u can t have raw spaces in the URL. 
			   $t = array();
			   $t = explode('=', $v);
			   $key = $t[0];
			   //array_push($tempoArray, $k['name_id_attr']);
			   $answerArrayFinal[$key] = $t[1] ;

		   }
		   
		   
		   //checking/compare answers
		   $yourScorsForAnswers = array();
		   
		   //$n = array_column($quizQuestionList_Initial, 'name_id_attr'); //CAN NOT USE in Php <5.5 //gets every column 'name_id_attr' to new array $n, i.e $n = ['name9311', 'name9312', etc] 
		   $n = array_map(function($element){return $element['name_id_attr'];}, $quizQuestionList_Initial);
 
           $amountOfCorrect = 0;
		   //foreach($quizQuestionList_Initial as $m){
			   foreach($answerArrayFinal as $key => $val){
			   
			       $indexx = array_search($key, $n ); //(/* what we look for */, arrayName, column)
				   if( $quizQuestionList_Initial[$indexx]['correctAnswer'] == $val ) { //if your answer == answer from $quizQuestionList_Initial
				       $amountOfCorrect++; //increment amount of correct answers
					   array_push($yourScorsForAnswers, array('correct', $quizQuestionList_Initial[$indexx]['questions'], $answerArrayFinal[$key] )); //('correct', question, your answer)
				   } else {
					   array_push($yourScorsForAnswers, array('wrong', $quizQuestionList_Initial[$indexx]['questions'], $answerArrayFinal[$key], $quizQuestionList_Initial[$indexx]['correctAnswer'] )); //('wrong', question, your answer, correct answer)

				   }
               }
		   //}
			   
		   
		   
		   
		   
			
			//RETURN JSON DATA
		    // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
             return [
                 'result_status' => $yourScorsForAnswers, // return to ajax srores results
				 'questionsCount' => count($quizQuestionList_Initial), //amount of questions
				 'amountOfCorrectAnswers'=> $amountOfCorrect,
				 //'error' => "Error, you have duplicate key value in your array",		 
             ]; 
			
		
		//**********************************************************************************************************************
        //if it is request to get list of questions, i.e contains no $_POST['serverAnswer'])		
		} else {

		
		
		
		
		//check if user's array {$quizQuestionList_Initial} accidentally has duplicate value for key {'name_id_attr'}, that is unacceptable
		//if $quizQuestionList_Initial[['name_id_attr']] has duplicates, return Error to ajax
		if($model->ifQuestionsArrayHasDuplicates($quizQuestionList_Initial) == TRUE){
			$result = "false";
			
			//RETURN JSON DATA
		    // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
             return [
                 'result_status' => $result, //"OK", // return ajx status
				 'error' => "Error, you have duplicate key value in your array. Check it.",		 
             ]; 
		}
	   //End check if user's array {$quizQuestionList_Initial} accidentally has duplicate value for key {'name_id_attr'}, that is unacceptable

		
		
		
		//filtering $quizQuestionList_Initial to $quizQuestionList (what to return to client)(here removing from array elements {correctAnswer} not them to be visible on client side), e.g {'correctAnswer'} is not ruturned for security reson  
		//and copying to new array {$quizQuestionList} that will be outputed to client
		$i = 0;
		foreach($quizQuestionList_Initial as $v){
			foreach($v as $key => $value){
			    $quizQuestionList[$i]['questions'] = $v['questions'];
				$quizQuestionList[$i]['answer'] = $v['answer'];
				$quizQuestionList[$i]['name_id_attr'] = $v['name_id_attr'];
				
			}
			$i++;
		}
		
		$result = "OK"; 
		
		
		
	
		//NOT USED, now we assign NaME/Id attributes manually in $quizQuestionList_Initial
		//adding to array $quizQuestionList new array element which will contain NAME attribute that will be used in form radioButton input, e.g =>  <input type='radio' name='Color' value='Green'id="myRadio2"/><label for="myRadio2">Green</label>
        /*$j = 0;
		foreach($quizQuestionList_Initial as $v){
			foreach($v as $key => $value){
			    $quizQuestionList[$j]['name-attribute'] = Yii::$app->security->generateRandomString(3) . '_' . time();;
			}
			$j++;
		}*/
		
		
		//randomly shuffle/mix order of questions
		shuffle($quizQuestionList);
		
		
		//RETURN JSON DATA
		  // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => $result, //"OK", // return ajx status
             //'code' => 100,	
             'questionList' => $quizQuestionList,			 
			 
          ]; 
    }
	
	}
	

}
