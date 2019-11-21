<?php

namespace app\models\Bot;
use Yii;

//include("../../secret_tokens.php");
/**
 * This is the model class for table "bot".
 *
 * @property int $b_id
 * @property string $b_category
 * @property string b_autocomplete
 * @property string $b_key
 * @property string $b_reply
 */
class BotModel extends \yii\db\ActiveRecord
{
	
	public $category; 
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_category', 'b_key', 'b_reply'], 'required'],
            [['b_key', 'b_reply'], 'string'],
            [['b_category'], 'string', 'max' => 77],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'b_id' => Yii::t('app', 'B ID'),
            'b_category' => Yii::t('app', 'B Category'),
			'b_autocomplete' => Yii::t('app', 'Autocomplete'),
            'b_key' => Yii::t('app', 'B Key'),
            'b_reply' => Yii::t('app', 'B Reply'),
        ];
    }
	
	
	//just a test if ajax is recognized
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	public  function testIf_IsAjax(){
		 //global $test;
		 if (Yii::$app->request->isAjax) { 
	        $test = "Ajax Worked, recognized! (message is from {actionAjaxReply})";
	    } else {
            $test = "Ajax  not recognized! message is from {actionAjaxReply}";
		}
		return  $test;
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	//defines the category. Reg Exp to differentiate Statements/Questions; //NOT USED so far!!!!!!!
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	public  function ifStatements_orQuestions_category(){
		//global $category;
		$RegExp_Name = '/\?/';  //'/^[a-zA-Z]{3,16}$/';
		//checking name text input for {?}
        if (!preg_match($RegExp_Name,  $_POST['serverMessageX'])){
			$this->category = "Statements";
		} else {
			$this->category = "Questions";
		}
		return $this->category;
	}
	
	
	
	//output the answer to ajax
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	 public  function giveCoreAnswer(){
		 
		 //handle empty messages
		if($_POST['serverMessageX']==""){
			$answer = "Your message is empty. Please try harder with a new one.";
		} else { //if message is not empty
		
		    //find answer from DB, returns array!!!!!!!
		    $found = BotModel::find()->orderBy ('b_id DESC') /*->where(['b_category'=> $this->category ])*/ -> andFilterWhere(['like', 'b_key', $_POST['serverMessageX']])->asArray() ->all();
		    if($found){
				
				 //Procees specific commands like weather, time, etc
				 /*if($found[0][b_id] == 18){ //if it is time question
				      date_default_timezone_set('Europe/Kiev');
				      $answer = $found[0]['b_reply'] . " " . date('h:i:s a', time());
			
			     } else if($found[0][b_id] == 19){ //if it is day question
				      date_default_timezone_set('Europe/Kiev');
				      $answer = $found[0]['b_reply'] . " " .   date('j-M-D-Y');
				 
				 //weather
				 } else if($found[0][b_id] == 2){ //if it is weather question
				     $weather_URL = "http://api.openweathermap.org/data/2.5/forecast/daily?q=Kyiv&mode=json&units=metric&cnt=7&appid=" . WEATHER_API_TOKEN;
					 if (!$json = file_get_contents($weather_URL)) {
		                 $answer = 'weather api failed';
	                 }
					 $res = json_decode($json,true);
					 $answer = "Weather in  " . $res['city']['name'] . ". Minimal temp is expected to be " . $res['list'][0]['temp']['max'] . "C. Forecast is for  " . date('d M Y ', $res['list'][0]['dt']) ;
					 
				//news
				} else if($found[0][b_id] == 20){ //if it is News question  https://newsapi.org/v2/top-headlines?country=ua&apiKey=
                      $news_URL = "http://newsapi.org/v2/top-headlines?country=ua&apiKey=" . NEWS_API_ORG;
					  if(!$json2 = file_get_contents($news_URL)) {
		                 $answer = 'news api failed';
	                  }
					 $res2 = json_decode($json2,true);
				     $answer = $found[0]['b_reply'] . $res2['totalResults'] . " items. " . $res2['articles'][0]['title']; //$found[0]['b_reply'] .
				*/	  
					  
					  
				//proceed normal answers from DB
				/*} else { */
		            //if(strpos( $found[0]['b_reply'], '//' ) !== false){  
					
					//if user's text is the same as prev, avoid the same answer
					/*if (Yii::$app->session->has('prevMessage')){
						if(Yii::$app->session->get('prevMessage') == $_POST['serverMessageX']){
							
						}
					} else {
					    Yii::$app->session->set('prevMessage', $_POST['serverMessageX']);
					}*/
					
					/*} else { */
		                $arr = explode("//",$found[0]['b_reply']);
		                $countX = count($arr);
		                $random = rand(0,$countX - 1 );
		                $answer = $arr[$random];
					/*} */
				//}

		    } else {
			    $answer = "Sorry, can not understand you. Try with another question.";
		    }
		}
		 return $answer;
	 }
	 
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	 
	 
	 
	 
	 
	 
    // **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	 
	 
	
}
