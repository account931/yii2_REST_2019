<?php
//Textbelt Sms API
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\SmsApi\SmsInputModel;



class SmsApiController extends Controller
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
				
		
		function runSmsCurl($model){
		
		    $ch = curl_init('https://textbelt.com/text');
            $data = array(
                'phone' => $model->cellNumber, //'+380976641342',
                'message' => $model->smsText, //'Hello. Eng version. Русская версия',
                'key' => 'textbelt',
             );

             curl_setopt($ch, CURLOPT_POST, 1);
             curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

             $response = curl_exec($ch);
		     $err = curl_error($ch);
             curl_close($ch);
		
	
	        //info if any curl error happened
		    if ($err) {
                //echo "cURL Error #:" . $err;
			    $errorX = $err;
           } else {
               //echo "<p> FEATURE STATUS=></p><p>Below is response from API-></p>";
               //echo $response;
		       $errorX = "No err detected";
           }
		
		    $messageAnswer = json_decode($response, TRUE); //gets the cUrl response and decode to normal array
		
		    //echo $messageAnswer;
		    if($messageAnswer['success']){
		        $status = $messageAnswer['success'];
			    Yii::$app->getSession()->setFlash('successX', "Sms was sent successfully"); 
		    } else {
			    $status = "Sms not sent";
			    Yii::$app->getSession()->setFlash('failX', "<i class='fa fa-envelope-o' style='font-size:28px;color:'></i> Sms was not sent. Error: <b>" . $messageAnswer['error'] . "</b>"); 
		    }
		
	        if(isset($messageAnswer['error'])){
	            $errMsg = $messageAnswer['error']; //gets the array element "message", it exists only if UUID is unique, i.e "message":"Feature does not exist", if Feature exists, 'message' does not exist
	        } else {
			    $errMsg = "No errors";
		    }
        
		    //convert array to string
		    $allMsg = str_replace('=', ':', http_build_query($messageAnswer, null, ','));
		
		    $text = $status . " Error: " .  $errMsg . " Err: " . $errorX ." Response=> " . $allMsg . " " . $model->cellNumber;
			return $text;
        }
		
		
		$model = new SmsInputModel();
		if ($model->load(Yii::$app->request->post())) {
		    $text = runSmsCurl($model);
			//return $this->refresh();
        } else {
			$text = "waiting for your message";
		}	

		
        return $this->render('index', [
		    'text' => $text,
			'model' => $model
		]);
    }

	
	
}
