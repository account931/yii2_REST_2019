<?php
//model for EMAIL input in form (NO ACTIVE RECORD) + sendEmal method + method to generate token (random string + time)

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

    public $password_reset_token; //mine for register by email
 
 
 
 
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
		
		
		
		
		
	  public function generatePasswordResetToken()
      {
          $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
      }
		
		
		/**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail($_emailX)
    {
        /* @var $user User */
		/*
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
 
        if (!$user) {
            return false;
        }
 
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }
		*/
 
      
	  
	  $this->generatePasswordResetToken();
	  
  
      $GLOBALS['myToken'] = $this->password_reset_token; //just for test in flash, must be DELETED in Production
	   
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'register-by-email/register_by_email-html', 'text' => 'register-by-email/register_by_email-text'], //taken from /mail/
                ['user' => $_emailX/*$user*/ , 'code' => $this->password_reset_token])
            ->setFrom('account931@ukr.net' /*[Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot']*/)
            ->setTo($_emailX /*$this->email*/)
            ->setSubject('Confirm registration by email ' /*. Yii::$app->name*/)
            ->send();
    }
	
	
	
	




	
		

}
