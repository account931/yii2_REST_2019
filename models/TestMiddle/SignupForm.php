<?php
//copied from site
namespace app\models\TestMiddle;
 
use Yii;
use yii\base\Model;
 
/**
 * Signup form
 */
class SignupForm extends Model
{
 
    public $username;
    public $email;
    public $password;
	public $password_confirm;
	public $_account;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			
			['password_confirm','required'],
            //my compare passwords  & confirm
            ['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match", /*'on' => 'update' */   ],
        ];
    }
 
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
 
        if (!$this->validate()) {
            return null;
        }
 
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
	
	
	
	
	
	 /**
     * Checks if Token in DB
     *
     * @
     */
    public function checkToken($token)
    {
		if (empty($token) || !is_string($token)) {
            //throw new InvalidParamException('Password reset token cannot be blank.');
			throw new \yii\web\NotFoundHttpException("Registration token cannot be blank. Check you email box confirmation letter");
        }
		
		 $this->_account = TestForMiddle_Resister_Token::find()-> where( 'test_middle_regist_token =:status', [':status' => $token])-> one();
 
        if (!$this->_account) {
			throw new \yii\web\NotFoundHttpException("Wrong registration token. Check you email box confirmation letter");
            //throw new InvalidParamException('Wrong password reset token.');
        }
		return $this->_account;
	}
	
	
	
	
	
	
	
	
	//
	public function clearToken_fromTest_for_middle_DB($tokenn)
	{
		$i = TestForMiddle_Resister_Token::find()-> where( 'test_middle_regist_token =:status', [':status' => $tokenn])-> one();
		$i->delete();
	}
 
}