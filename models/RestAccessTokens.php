<?php
//Model to SQL tables that stores users token for REST api request
namespace app\models;

use Yii;

/**
 * This is the model class for table "rest_access_tokens".
 *
 * @property string $rest_tokens
 * @property int $r_user
 */
class RestAccessTokens extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface //have to implements \yii\web\IdentityInterface to be used in models/Users/findIdentityByAccessToken()
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rest_access_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['rest_tokens', 'r_user'], 'required'],
            [['r_user'], 'integer'],
            [['rest_tokens'], 'string', 'max' => 88],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rest_tokens' => 'Rest Tokens',
            'r_user' => 'R User',
        ];
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//MUST HAVE METHODS AS LONG AS U IMPLEMENT implements \yii\web\IdentityInterface----------------
//Among all i have changed only  method findIdentityByAccessToken()	
	    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
 
 
    public static function findIdentityByAccessToken($token, $type = null)
    {
		 return static::findOne(['rest_tokens' => $token]); //MINE //FOR USE API Auth token
		//return static::findOne(['access_token' => $token]); //MINE //FOR USE API Auth token
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
 
 
 
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
 
 
    public function getId()
    {
        return $this->getPrimaryKey();
    }
 
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
	
	public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
	
//MUST HAVE METHODS AS LONG AS U IMPLEMENT implements \yii\web\IdentityInterface----------------------
	
	
}
