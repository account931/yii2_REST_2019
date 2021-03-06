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

	
	//has MANY relations for table {wpress_category}. Used in in views rendered by actionShowAllBlogs()
	 public function getTokens(){                                           //that table ID(WpressCategory)   //THIS table ID
        return $this->hasMany(WpressCategory/*AuthAssignment*/::className(), ['wpCategory_id' => 'wpBlog_category']); //[THAT table column/ THIS CLASS column]
	   //return $this->hasMany(WpressCategory/*AuthAssignment*/::className(), ['wpBlog_category' => 'wpCategory_id']); //args=> (model/db name to connect, this model/DB column name => second model/db name id// Db fields which cooherent each other(from 2 DBs)
      }
	  
	 //has ONE relations for table {user}. Used in views rendered by actionShowAllBlogs(), actionIndex(Gridview)
	 public function getUsernames(){                               //that table ID(User)     //THIS table ID
        return $this->hasOne(User/*AuthAssignment*/::className(), ['id' => 'wpBlog_author']); //[THAT table column/ THIS CLASS column]
	   //return $this->hasMany(WpressCategory/*AuthAssignment*/::className(), ['wpBlog_category' => 'wpCategory_id']); //args=> (model/db name to connect, this model/DB column name => second model/db name id// Db fields which cooherent each other(from 2 DBs)
      }
	  
	  
     //has ONE relations for table {wpress_category}. Used in in views rendered by  actionIndex(Gridview)
	 public function getCategories(){                                         //that table ID(WpressCategory)   //THIS table ID
        return $this->hasOne(WpressCategory/*AuthAssignment*/::className(), ['wpCategory_id' => 'wpBlog_category']); //[THAT table column/ THIS CLASS colum
     }
	  
	  
	  
	  
	  
	  //EVENTS---------
	  // declare constant that stores event name
      const EVENT_NEW_MY_TRIGGER_X = 'any-text-you-want';
	  public $eventStatus;
	  
	  // somy mome method to execute on Event
      public function sendMail($event){
		  global $eventStatus; //$GLOBALS['eventStatus'];
	      $eventStatus = "EVENT IS OK. Implemented in models/WpressBlogPost";//echo 'Test of Yii2 EVENTS is OK';
         // you code 
     }
	 
	 // this should be inside Model class.
     public function init(){
         $this->on(self::EVENT_NEW_MY_TRIGGER_X, [$this, 'sendMail']);
        //$this->on(self::EVENT_NEW_MY_TRIGGER_X, [$this, 'notification']);
        // first parameter is the name of the event and second is the handler. 
        parent::init(); // DON'T Forget to call the parent method.
   }
    //END EVENTS -----------------
	  
	  
	  
	  
	  
	  
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
            'wpBlog_title' => 'Blog Title',
            'wpBlog_text' => 'Blog Text',
            'wpBlog_author' => 'Blog Author',
            'wpBlog_created_at' => 'Created At',
            'wpBlog_category' => 'Category',
            'wpBlog_status' => 'Status',
        ];
    }
}
