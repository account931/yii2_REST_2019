<?php

namespace app\models\LiqPay_2_Simple;

use Yii;
use yii\base\Model;

/**
 * This is the model class for form input
 *
 * @property int $yourInput

 */
class InputModel extends Model
{
	
	
	 public $yourInputValue; //product quantity
	 public $productID; //hidden product ID

	
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            ['yourInputValue', 'number', 'message'=>'Number only!!!', 'min'=>1, 'max'=>999,],
			[['yourInputValue', 'productID'], 'required'],
           
        ];
    }
public function attributeLabels()
    {
        return [
            'yourInputValue' => 'quantity',
			//'answer' => 'Chat Flow',
            
        ];
    }

    
}
