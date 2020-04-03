<?php

namespace app\models\LiqPay_2_Simple;

use Yii;

/**
 * This is the model class for table "liqpay_shop_simple".
 *
 * @property int $l_id
 * @property string $l_name
 * @property string $l_image
 * @property string $l_price
 * @property string $l_descript
 */
class LiqpayShopSimple extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'liqpay_shop_simple';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['l_name', 'l_image', 'l_price', 'l_descript'], 'required'],
            [['l_price'], 'number'],
            [['l_descript'], 'string'],
            [['l_name', 'l_image'], 'string', 'max' => 77],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'l_id' => Yii::t('app', 'L ID'),
            'l_name' => Yii::t('app', 'L Name'),
            'l_image' => Yii::t('app', 'L Image'),
            'l_price' => Yii::t('app', 'L Price'),
            'l_descript' => Yii::t('app', 'L Descript'),
        ];
    }
}
