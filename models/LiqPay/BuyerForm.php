<?php
namespace app\models\LiqPay;
 
use Yii;
use yii\base\Model;
 
/**
 * Signup form
 */
class BuyerForm extends Model
{
 
    public $username;
    public $email;
    public $phone_number;
	public $first_name;
	public $last_name;
	public $address;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username', 'address', 'phone_number', 'email'], 'required', 'message' => 'This field can not be blank.'],
            //['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
			['phone_number', 'validatePhoneX'], //my validation
			
            /*
			['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			['password_confirm','required'],
            //my compare passwords  & confirm
			*/
            //['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match", /*'on' => 'update' */ ],
			
        ];
    }
 
 
 
    /**
     * my validation.
     *
     * checks phone nember
     */
    //my validation
	
	 public function validatePhoneX(){
		  //$RegExp_Phone = '/^[+]380\([\d]{1,4}\)[0-9]+$/';
		  $RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/';
		  if (!preg_match($RegExp_Phone, $this->phone_number)){
			  $this->addError('phone_number','Телефон має бути у форматі +380********* ');
		  }
     }
	 
	 
	 
 
}