<?php
 
//Used in PasswordResetController to reset your forgotten password. 
//When u request it, firstly u input your email, then checks your email box and follow the link with token to reset forgotten password.

namespace app\models\ResetPassword; //namespace must contain subfolder to model
 
use yii\base\Model;
use yii\base\InvalidParamException;
use app\models\User;
 
/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
 
    public $password;
	public $password_confirm;
 
    /**
     * @var \app\models\User
     */
    private $_user;
 
    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
 
        if (empty($token) || !is_string($token)) {
            //throw new InvalidParamException('Password reset token cannot be blank.');
			throw new \yii\web\NotFoundHttpException("Password reset token cannot be blank.");
        }
 
        $this->_user = User::findByPasswordResetToken($token);
 
        if (!$this->_user) {
			throw new \yii\web\NotFoundHttpException("Wrong password reset token.");
            //throw new InvalidParamException('Wrong password reset token.');
        }
 
        parent::__construct($config);
    }
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			
			['password_confirm','required'],
            //my compare passwords  & confirm
            ['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match", /*'on' => 'update' */   ],
        ];
    }
 
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
 
}