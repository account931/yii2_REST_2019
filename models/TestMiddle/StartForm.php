<?php

namespace app\models\TestMiddle;
//namespace frontend\models;
 
use Yii;
use yii\base\InvalidParamException;
use yii\base\Model;
//use models\User;
 
/**
 *
 */
class StartForm extends Model
{
    public $emailX;


 
 
 
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emailX'], 'required'],
            [['emailX'], 'string', 'min' => 6],
        ];
    }
 
    
	
	  public function attributeLabels(){
         return [
                'emailX'=>'Your email',

            ];
        }
		

}
