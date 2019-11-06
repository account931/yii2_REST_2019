<?php

namespace app\models\Wpress;

use Yii;

/**
 * This is the model class for table "wpress_category".
 *
 * @property int $wpCategory_id
 * @property string $wpCategory_name
 */
class WpressCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wpress_category';
    }

	
	
	
	//has many relations
	 public function getPostsX(){
       return $this->hasMany(WpressBlogPost/*AuthAssignment*/::className(), ['wpCategory_id' => 'wpBlog_category']); //args=> (model/db name to connect, this model/DB column name => second model/db name id// Db fields which cooherent each other(from 2 DBs)
      }
	
	
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wpCategory_name'], 'required'],
            [['wpCategory_name'], 'string', 'max' => 77],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wpCategory_id' => Yii::t('app', 'Wp Category ID'),
            'wpCategory_name' => Yii::t('app', 'Wp Category Name'),
        ];
    }
}
