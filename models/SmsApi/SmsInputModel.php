<?php

namespace app\models\SmsApi;

use Yii;
use yii\base\Model;

/**
 * This is the model class for sms form.
 *
 * @property int $b_id

 */
class SmsInputModel extends Model
{
	
	
	 public $cellNumber;
	 public $smsText;
	
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['cellNumber', 'smsText'], 'required'],
            ['smsText', 'string', 'message'=>'error message'],
			['cellNumber','validatePhoneX'] //my validation
           
        ];
    }
public function attributeLabels()
    {
        return [
            'cellNumber' => 'Phone # ',

            
        ];
    }
	
	
	
	
	
	
	
	 //my validation
	 public function validatePhoneX($attribute, $params){
		  //$RegExp_Phone = '/^[+]380\([\d]{1,4}\)[0-9]+$/';
		  $RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/';
		  if (!preg_match($RegExp_Phone, $this->$attribute)){
			  $this->addError('$attribute','Phone must be in format 380********* ');
		  }
		  /*
		   if ($this->$attribute == 'a'){
			  $this->addError('$attribute','Phone must be in format 380********* ');
			  return false;
		  }*/
     }
	 
	 

    
}
