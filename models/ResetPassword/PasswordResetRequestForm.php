<?php
//Used in PasswordResetController to reset your forgotten password. 
//When u request it, firstly u input your email, then checks your email box and follow the link with token to reset forgotten password.
 
namespace app\models\ResetPassword;   //namespace must contain subfolder to model
 
use Yii;
use yii\base\Model;
use app\models\User;  //must be
 
/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
	public $myToken; //just for test in flash, must be DELETED in Production
	
	public $captcha;
    public $recaptcha;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
			 //captcha
			[['captcha','recaptcha'], 'required'],
            ['recaptcha', 'compare', 'compareAttribute' => 'captcha', 'operator' => '=='],
        ];
    }
 
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
 
        if (!$user) {
            return false;
        }
		
		$GLOBALS['myToken'] = $user->password_reset_token; //just for test in flash, must be DELETED in Production
 
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }
 
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], //taken from /mail/
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
 
}