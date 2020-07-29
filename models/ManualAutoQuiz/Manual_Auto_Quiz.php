<?php

namespace app\models\ManualAutoQuiz;

use Yii;
use yii\base\Model;

/**
 * This is the model class for methods used in ManualAutoQuizController.
 *
 * 

 */
class Manual_Auto_Quiz extends Model
{
	//public $cellNumber;


	
	
	
	

//************************************************** Methods for returning/building  list of question, i.e when user just opens the quiz page *************************************	
	
	
	//check if user's array {$quizQuestionList_Initial} accidentally has duplicate value for key {'name_id_attr'}, that is unacceptable
	public function ifQuestionsArrayHasDuplicates($quizQuestionList_Initial){
		$z = 0;
		$ifHasDublicate = FALSE;
		$tempoArray = array();
		foreach($quizQuestionList_Initial as $k ){
			if( !in_array( $k['name_id_attr'], $tempoArray ) ){ //if value does not exist in tempoArray['name_id_attr']
			   array_push($tempoArray, $k['name_id_attr']);
			} else {
				//$ifHasDublicate = TRUE;
				//$result = "false";
				return TRUE;
					
			}
		}
		return false;
	}
	
	
	
	
//************************************************** End Methods for returning/building  list of question, i.e when user just opens the quiz page *************************************	














//************************************************** Methods for checking correct answers when user selected answers and clicked submit *************************
	public function checkIfAnswersCorrect(){
	}
//************************************************** End Methods for checking correct answers when user selected answers and clicked submit *************************
	
		 

    
}
