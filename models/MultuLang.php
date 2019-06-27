<?php
//just an empty model to use in echo in views/multilangusges/index.php $form->field($model, 'q')->dropDownList($items,$params);
namespace app\models;
use Yii;
use yii\base\Model;


class MultuLang extends Model
{
	
    public $q;
	 
	public function rules()
    {
        return [
            ['q', 'string', 'message'=>'your text'],
			// q is required
            [['q'/*, 'q'*/], 'required'],
           
        ];
    }
	
    public function attributeLabels()
    {
        return [
            'q' => 'me',
            
        ];
    }

}
