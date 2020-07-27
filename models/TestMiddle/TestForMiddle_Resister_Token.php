<?php
//model for SQL table {test_for_middle_regist_token}
namespace app\models\TestMiddle;

use Yii;

/**
 * This is the model class for table "test_for_middle_regist_token".
 *
 * @property int $test_middle_id
 * @property string $test_middle_email
 * @property string $test_middle_regist_token
 */
class TestForMiddle_Resister_Token extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_for_middle_regist_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_middle_email', 'test_middle_regist_token'], 'required'],
            [['test_middle_email', 'test_middle_regist_token'], 'string', 'max' => 77],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'test_middle_id' => Yii::t('app', 'Test Middle ID'),
            'test_middle_email' => Yii::t('app', 'Test Middle Email'),
            'test_middle_regist_token' => Yii::t('app', 'Test Middle Regist Token'),
        ];
    }
}
