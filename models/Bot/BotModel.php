<?php

namespace app\models\Bot;
use Yii;

include("../../secret_tokens.php");
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
	public $found; //used in isSearchAnswerExists_inSQL() as $this->found
	
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
	
	
	
	//output the answer. Gets predifined answers from SQL DB, from field ['b-reply'](to send to ajax)
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	 public  function AnswerFromDataBase($found){
		 	
		    
		    //if($found){
				
					  
					  
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
					
					    $cookies = Yii::$app->request->cookies;//getting all Cookies from collection
				
		                $arr = explode("//",$found[0]['b_reply']); //explodes SQL DB table field {b_reply} to array
		                $countX = count($arr);
		                $random = rand(0,$countX - 1 ); //generates random int within the range
						
						//If user question is the sane as prev, make sure not to display the same random answer
						/*if($cookies->has('prevMessageID')){
							if($found[0]['b_id'] == $cookies->getValue('prevRandomInt') && $random == $cookies->$cookies->getValue('prevRandomInt')){
								$random = ($random == count($arr)) ? $random - 1 : $random + 1;
								$answer = 'exists';
							} else {
						
		                    $answer = 'No'; //$arr[$random];
						   }
						}*/
							
						 $answer = $arr[$random];
						
						//sets this answer ID & randon int to session variables
						$cookies = Yii::$app->response->cookies;
						$cookies->add(new \yii\web\Cookie(['name' => 'prevMessageID', 'value' => $found[0]['b_id'], 'expire' => time() + 86400 * 365, ] )); //saves Cookie variant 
                        $cookies->add(new \yii\web\Cookie(['name' => 'prevRandomInt', 'value' => $random,           'expire' => time() + 86400 * 365, ] )); //saves Cookie variant 

					   
						
					
				//}

		   /* } else {
			    $answer = "Sorry, can not understand you. Try with another question.";
		    }*/
		//}  //!!!!!!!!!!
		 return $answer;
	 }
	 
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 //output the answer. Gets calculated answer, i.e response from Weather, News API, current time/date, etc. (to send to ajax) 
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	 public  function giveComputeredAnswer($found){
		 
				 //Procees specific commands like weather, time, etc
				 
				 //if it is time question
				 if($found[0]['b_id'] == 18){ 
				      date_default_timezone_set('Europe/Kiev');
				      $answer = "it is  " . date('h:i:s a', time());
					  
			     //if it is day question
			     } else if($found[0]['b_id'] == 19){ 
				      date_default_timezone_set('Europe/Kiev');
				      $answer = "Today " .   date('j-M-D-Y');
					  
				 
				 
				 //if it is Open weather Api question for TODAY weather
				 } else if($found[0]['b_id'] == 21){ 
				     $weather_URL = "http://api.openweathermap.org/data/2.5/forecast/daily?q=Kyiv&mode=json&units=metric&cnt=7&appid=" . WEATHER_API_TOKEN;
					 
					 /*if (!$json = file_get_contents($weather_URL)) { //reassigned to cURL
		                 $answer = 'weather api failed';
	                 }*/
					 $json = $this->run_cURL_requestt($weather_URL); //run cUrl
					 $res = json_decode($json,true);
					 $answer = "<br>Here you are today weather in  " .
					         $res['city']['name'] . "." .  //city name
							 "<br>Forecast is for  " . date('d M Y ', $res['list'][0]['dt']) . "." .  //date
							 "<br> Temperature is expected to be min:" . $res['list'][0]['temp']['min'] . "C, max:  " . $res['list'][0]['temp']['max'] . "C, ".
        					  $res['list'][0]['weather'][0]['description'] . ".";
					 
				
				
				
				//if it is Open weather Api question for TOMORROW weather
				 } else if($found[0]['b_id'] == 22){ 
				     $weather_URL = "http://api.openweathermap.org/data/2.5/forecast/daily?q=Kyiv&mode=json&units=metric&cnt=7&appid=" . WEATHER_API_TOKEN;
					 
					 /*if (!$json = file_get_contents($weather_URL)) { //reassigned to cURL
		                 $answer = 'weather api failed';
	                 }*/
					 $json = $this->run_cURL_requestt($weather_URL); //run cUrl
					 $res = json_decode($json,true);
					 $answer = "<br>Here you are tomorrow weather forecast in  " .
					         $res['city']['name'] . "." .  //city name
							 ", " . date('d M Y ', $res['list'][1]['dt']) . "." . //date
							 "<br> Temperature is expected to be min:" . $res['list'][1]['temp']['min'] . "C, max:  " . $res['list'][1]['temp']['max'] . "C, ".
        					  $res['list'][1]['weather'][0]['description'] . ".";
				
				
				
				
				
				
				//if it is News API question  https://newsapi.org/v2/top-headlines?country=ua&apiKey=
				} else if($found[0]['b_id'] == 20){ 
                      $news_URL = "http://newsapi.org/v2/top-headlines?country=ua&apiKey=" . NEWS_API_ORG;
					  
					  /*if(!$json2 = file_get_contents($news_URL)) { //reassigned to cURL
		                 $answer = 'news api failed';
	                  }*/
					  
					 $json2 = $this->run_cURL_requestt($news_URL); //run cUrl
					 $res2 = json_decode($json2,true);
					 
					 $random = rand(0, $res2['totalResults']-1 ); //to get a 1 random news from all available
				     $answer = "<br>" . $found[0]['b_reply'] . $res2['totalResults'] . " news found. " .  //found 30 news
					           "<br>Here is a random news:</br>" . $res2['articles'][$random]['title']; //getting 1 random news from all available
				}
				
				return $answer;
	 }
	 
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	 
	 //search for key words presence in SQL Dn [b_key]
    // **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	 function isSearchAnswerExists_inSQL(){
		//find answer from DB, returns array!!!!!!!
		$this->found = /*BotModel*/self::find()->orderBy ('b_id DESC') /*->where(['b_category'=> $this->category ])*/ -> andFilterWhere(['like', 'b_key', $_POST['serverMessageX']])->asArray() ->all(); 
	     if($this->found){
			 return true;
		 } else {
			 return false;
		 }
	 }
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	
	 // **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function run_cURL_requestt($url){
		
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET", //PUT
         //CURLOPT_POSTFIELDS => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
         /* CURLOPT_HTTPHEADER => array(
           "cache-control: no-cache",
           "content-type: application/json",
           "x-api-key: whateveriyouneedinyourheader"
        ),*/
       ));
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error
       $response = curl_exec($curl);
	   
       $err = curl_error($curl);
       curl_close($curl);
	   
       if ($err) {
           //echo "cURL Error #:" . $err;
	       //array_push($this->messageArray, " ERROR SAVING MARKER"); //add message to messageArray to show later in div id="techInfo"
      } else if ($response) {
         //echo "<p> FEATURE STATUS=></p><p>Below is response from API-></p>";
         //echo $response;
	     //array_push($this->messageArray, $myName, $myDescript);//add message to messageArray to show later in div id="techInfo"
         //echo "<br> Marker is Saved!!!";
	     //array_push($this->messageArray, " Marker is Savedd!!!"); //add message to messageArray to show later in div id="techInfo"
	     //array_push($this->messageArray, $response); //add message to messageArray to show later in div id="techInfo"
		 return $response;
       }
     //END cURL -> Version for localhost and 000webhost.com, cURL is not supported on zzz.com.ua hosting-------------
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	
	
	
	 // **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	
	
	
	
	
	
	 // **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
}
