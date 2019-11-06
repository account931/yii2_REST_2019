<?php

namespace app\models\Wpress;

use Yii;
use app\models\User;

/**
 * This is the model class for table "wpress_blog_post".
 *
 * @property int $wpBlog_id
 * @property string $wpBlog_title
 * @property string $wpBlog_text
 * @property int $wpBlog_author
 * @property string $wpBlog_created_at
 * @property int $wpBlog_category
 * @property string $wpBlog_status
 */
class WpressBlogPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wpress_blog_post';
    }

	
	//has many relations for table {wpress_category}
	 public function getTokens(){                                           //that table ID(WpressCategory)   //THIS table ID
        return $this->hasMany(WpressCategory/*AuthAssignment*/::className(), ['wpCategory_id' => 'wpBlog_category']); //[THAT table column/ THIS CLASS column]
	   //return $this->hasMany(WpressCategory/*AuthAssignment*/::className(), ['wpBlog_category' => 'wpCategory_id']); //args=> (model/db name to connect, this model/DB column name => second model/db name id// Db fields which cooherent each other(from 2 DBs)
      }
	  
	 //has many relations for table {user}
	 public function getUsernames(){                               //that table ID(User)     //THIS table ID
        return $this->hasOne(User/*AuthAssignment*/::className(), ['id' => 'wpBlog_author']); //[THAT table column/ THIS CLASS column]
	   //return $this->hasMany(WpressCategory/*AuthAssignment*/::className(), ['wpBlog_category' => 'wpCategory_id']); //args=> (model/db name to connect, this model/DB column name => second model/db name id// Db fields which cooherent each other(from 2 DBs)
      }
	  
	  
	  
	  
	  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wpBlog_title', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category'], 'required'],
            [['wpBlog_text', 'wpBlog_status'], 'string'],
            [['wpBlog_author', 'wpBlog_category'], 'integer'],
            [['wpBlog_created_at'], 'safe'],
            [['wpBlog_title'], 'string', 'max' => 222],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wpBlog_id' => 'Wp Blog ID',
            'wpBlog_title' => 'Wp Blog Title',
            'wpBlog_text' => 'Wp Blog Text',
            'wpBlog_author' => 'Wp Blog Author',
            'wpBlog_created_at' => 'Wp Blog Created At',
            'wpBlog_category' => 'Wp Blog Category',
            'wpBlog_status' => 'Wp Blog Status',
        ];
    }
}
