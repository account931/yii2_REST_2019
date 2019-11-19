<?php

namespace app\models\Bot;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "bot".
 *
 * @property int $b_id

 */
class InputModel extends Model
{
	
	
	 public $yourInput;
	 //public $answer;
    //private $_user = false;
	
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            ['yourInput', 'string', 'message'=>'your text'],
           
        ];
    }
public function attributeLabels()
    {
        return [
            'yourInput' => 'say',
			//'answer' => 'Chat Flow',
            
        ];
    }

    
}
