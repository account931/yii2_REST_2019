<?php
namespace app\models\LiqPay;
 
use Yii;
use yii\base\Model;
 
/**
 * 
 */
class BuyerForm extends Model
{
 
    public $username;
    public $email;
    public $cellar_numb;
	public $first_name;
	public $last_name;
	public $address;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
		    
            //['username', 'trim'],
            [['address', 'cellar_numb', 'email', 'first_name', 'last_name'], 'required', 'message' => 'This field can not be blank.'],
            //['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            [['first_name', 'last_name', 'address'], 'string', 'min' => 3, 'max' => 22],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
			//['cellar_numb', 'number', 'max' => 14], 
			['cellar_numb', 'validateDatesX'], //my validation
			
            /*
			['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			['password_confirm','required'],
			*/
			//my compare passwords  & confirm
            //['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match", /*'on' => 'update' */ ],
			
        ];
    }
 
 
 
    /**
     * my validation.
     *
     * checks phone nember
     */
    //my validation
	
	 //my validation
	 public function validateDatesX($attribute, $params){
		  //$RegExp_Phone = '/^[+]380\([\d]{1,4}\)[0-9]+$/';
		  $RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/';
		  if (!preg_match($RegExp_Phone, $this->$attribute)){
			  $this->addError($attribute,'phone number must be in format +380********* ');

              //return false;
		  }
		 
     }
	 
	 
	 
	 
	 
	 
	
	
	
 
}