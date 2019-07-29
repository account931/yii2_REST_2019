<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_cph".
 *
 * @property int $book_id
 * @property string $book_user
 * @property string $book_guest
 * @property string $book_from
 * @property string $book_to
 * @property int $book_from_unix
 * @property int $book_to_unix
 */
class BookingCph extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_cph';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_user', 'book_guest', 'book_from', 'book_to'], 'required'], //, 'book_from_unix', 'book_to_unix'
            [['book_from_unix', 'book_to_unix'], 'integer'],
            [['book_user', 'book_guest'], 'string', 'max' => 77],
            [['book_from', 'book_to'], 'string', 'max' => 33],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'book_user' => 'User/Owner (You)',
            'book_guest' => 'Guest name u want to settle',
            'book_from' => 'Book From',
            'book_to' => 'Book To',
            'book_from_unix' => 'Book From Unix',
            'book_to_unix' => 'Book To Unix',
        ];
    }
	
	
	
	
	
	
	
	
//beforeSave(); //convert date to unixTime & assign to SQL db field
// **************************************************************************************
// **************************************************************************************
//                                                                                     **

//WORKS!!!!!!!!!!!!!!!!!!!! (wasn't  working  because  used $_POST['Mydbstart']['mydb_v_am'] instead of  $this->mydb_v_am )
public function beforeSave($insert)  //$insert
{
    if (parent::beforeSave(false)) {
 
        // Place your custom code here
		
        // $model = new Mydbstart(); // Instead of creating a New Model - u have to use {$this};
        //NEW
        //$curr = self::findByPk($this->id); //::find()->orderBy ('mydb_id DESC')  ->all(); //WON't  work  we  don't  needd  getting  old  value  from SQL
        //END NEW
		
             if (!empty($this->book_from) && !empty($this->book_to )){ 
                 $this->book_from_unix = strtotime($this->book_from);  //convert date to unixTime & assign to SQL db field
				 $this->book_to_unix = strtotime($this->book_to);  //convert date to unix & assign to SQL db field
             }// END if(!empty($this->mydb_v_am)) 
                 
   
        // End  Place your custom code her
        return true;
    } else {
        return false;
    }
} // END BEFORESAVE();
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************
//---------------------------------------------------------




}
