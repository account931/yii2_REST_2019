<?php

namespace app\models\Bot;

use Yii;

/**
 * This is the model class for table "bot".
 *
 * @property int $b_id
 * @property string $b_category
 * @property string $b_key
 * @property string $b_reply
 */
class BotModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_category', 'b_key', 'b_reply'], 'required'],
            [['b_key', 'b_reply'], 'string'],
            [['b_category'], 'string', 'max' => 77],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'b_id' => Yii::t('app', 'B ID'),
            'b_category' => Yii::t('app', 'B Category'),
            'b_key' => Yii::t('app', 'B Key'),
            'b_reply' => Yii::t('app', 'B Reply'),
        ];
    }
}
