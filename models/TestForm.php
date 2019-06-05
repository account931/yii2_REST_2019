<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_form".
 *
 * @property int $id
 * @property string $name1
 * @property string $name2
 */
class TestForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name1', 'name2'], 'required'],
            [['name1', 'name2'], 'string', 'max' => 66],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name1' => 'Name1',
            'name2' => 'Name2',
        ];
    }
}
