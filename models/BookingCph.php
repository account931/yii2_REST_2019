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
            [[/*'book_user',*/ 'book_guest', 'book_from', 'book_to'], 'required'], //, 'book_from_unix', 'book_to_unix'
            [['book_from_unix', 'book_to_unix'], 'integer'],
            [['book_user', 'book_guest'], 'string', 'max' => 77],
            [['book_from', 'book_to'], 'string', 'max' => 33],
			
			// проверяет, что возраст больше или равен 30
            //['book_from', 'compare', 'compareValue' => date("U")/*30*/, 'operator' => '>=', 'type' => 'number'],    //date("U")
			
			['book_from','validateDatesX'], //my custom validation function. ['fromDate', 'compare', 'compareAttribute'=> 'toDate', 'operator' => '<', 
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
	
	
	
//your custom validation rule, checks if start/end time is not PAST, and if Start in Unix in smaller than End in Unix. Used in model in function rules()
// **************************************************************************************
// **************************************************************************************
//                                                                                     **	
	public function validateDatesX(){
        if(strtotime($this->book_from) <= date("U")){//if start date is Past //  date("U") is a today in UnixTime
            $this->addError('book_from','Can"t be past!!! Please give correct Start Day');
        }
		
		 if(strtotime($this->book_to) <= date("U")){//if End date is Past 
            $this->addError('book_to','Can"t be past!!! Please give correct End Day');
        }
		
		 if(strtotime($this->book_to) <= strtotime($this->book_from)){ //if Start Unix Time bigger then End
            $this->addError('book_from','Dates range is reversed!!!!! Check start/end dates.');
			$this->addError('book_to',  'Dates range is reversed!!!!! Check start/end dates.');
        }
    }
	
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************




	
	
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










 /**
  * Method description
  *
  * @return mixed The return value
  */
// **************************************************************************************
// **************************************************************************************
//                                                                                     **
 public function beforeValidate()
 {
     //$this->book_from
	 
     return parent::beforeValidate();
 }
 
 
 
 
 
 //NOT USED NOW!!!! SPLITTED TO MULTIPLE SMALL FUNCTIONS
 // Start Methods used in BookingCphController/actionAjax_get_6_month()---------------------------------------------------------------------------------------
 //It gets data for all 6 months and draw 6 month calendar
 
 // **************************************************************************************
 // **************************************************************************************
 //                                                                                     **
 public function draw_6_month_calendar(){  //NOT USED NOW!!!! SPLITTED TO MULTIPLE SMALL FUNCTIONS
	 
	    error_reporting(E_ALL & ~E_NOTICE); //JUST TO FIX 000wen HOSTING, Hosting wants this only for Ajax Actions!!!!!!!!!!!!!!!
		date_default_timezone_set('UTC');  //use ('UTC') to avoid -1 day result    //('europe/kiev')	('UTC')
		
		
		$array_All_sqlData = array();//will store all sql results
		$array_All_Unix = array();//will store all Unix start & stop time for all 6 month, will be in format [[CurrentStart, Currentend], [start-1, end-1], [start-2, end-2]]
		$array_All_CountDays = array();//will store counts of booked days for every month (for badges)
		
		
		$MonthList= array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"); //General array for all click actions
       //General arrayweek days for all click actions
        $weekdays = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
       
		//------------------
		

		 
		 
		 
		 
		 
		 //var with year, used for creating Unix for next years, must be declared out of for loop, to save its value for further iteration, in case if($may == 1 )
		 $yearX = date("Y"); //gets the current year, i.e 2019
	     
	 
		
		 //-------------------- This one current month + Next 6 month ---------------------------------
	     //FIND SQL DATA for This one current month + ALL Future 6-MONTHS IN FOR LOOP. To use it fot months incl current, changed $i=0 (was $i=1)
         for ($i = 0; $i < 9; $i++){  //($i=1; $i<4; $i++)  // $i < 6 means for 5 future month //YOU CAN CHANGE THE AMOUNT OF FUTURE MONTH TO DISPLAY in $i = YOUR Unlimited amount
		    
			//if it is Zero iteration, ie it is this current month
		    //if($i == 0){	}
			
            //Start DATE for NEXT months  ONLY (+ this current month in first iteration)----------------------------
            $PrevMonth = date('M', strtotime(date('Y-m'). " + " .$i. " month")); //i.e Jul  //$PrevMonth=date('M', strtotime(date('Y-m')." -1 month"));         
            $PrevYear =  date('Y', strtotime(date('Y-m')." + " .$i. " month"));  //i.e 2019 // $PrevYear=date('Y', strtotime(date('Y-m')." -1 month"));// getting Next  month  and  year;
        
		    ${'current'.$i} = $PrevMonth . " " . $PrevYear; //i.e Jul 2019
			array_push($array_All_Month, ${'current'.$i}); //adds next months to array in a loop
			
			
			//!!!!!!!
			
			$may =  array_search($PrevMonth , $MonthList); //search the index of $PrevMonth  in array, i.e index of Jul = 6
			$may = $may + 1;
			
			//if current month in loop is 1 (i.e January), for this & next months we use the next year. As it is loop, January here could NOT BE EVER here the current month, if($may == 1 ) it can only be the next or next+1, etc, so the current is always the past year & January is the next
			
			if($may == 1 ){
				//$yearX must be declared out of for loop, to save its value for further iteration, in case if($may == 1 )
				$yearX++ ; //was = (int)date("Y") + 1; Fix for unlimited future years// gets the current year & adds +1 to get the next year, ie. 2019 + 1 = 2020
			    //$yearX = (string)$yearX;
			} 
			
			
			
		
			
			$first1 = date("Y-m-d", mktime(0, 0, 0, $may , 1 ,$yearX)); //gets the first day of the current month, returns  "2019-05-01"
		    $last1 = date("Y-m-d",  mktime(0, 0, 0, $may+1, 0, $yearX)); //gets the last day of the current month,returns "2019-05-31"
			
			//gets Unix Start Time & Unix End Time of the current month (+ this current month in first iteration) (i.e Unix of the 1st & last day)
		    $array_tempo = array(strtotime($first1), strtotime($last1)); //push current month unix stamp start/stop Unix time to subarray // returns [1556654400,1559246400]
		    array_push($array_All_Unix, $array_tempo); //push subarray to array in order to have structure [[35, 57], [35, 57], [35, 57],]
		   
		
	
			
		    //Find SQL data for a specific NEXT month (+ this current month in first iteration) (from 6-months range) one by one in a loop
           //creating array {SmonthData1,SmonthData2,}
            ${'monthData'.$i} = BookingCph::find()   ->orderBy ('book_id DESC')  /*->limit('5')*/ 
			    ->where([ 'book_user' => Yii::$app->user->identity->username, /*'mydb_id'=>1*/]) //if this line uncommented, each user has its own private booking(many users-> each user has own private booking appartment, other users cannot book it). Comment this if u want that booking is general, ie many users->one booking appartment(many users can book 1 general appartment)  
			    ->andWhere(['between', 'book_from_unix', strtotime($first1), strtotime($last1) ])   /*->andFilterWhere(['like', 'supp_date', $PrevMonth])  ->andFilterWhere(['like', 'supp_date', $PrevYear])*/    
				->orWhere (['between', 'book_to_unix',   strtotime($first1), strtotime($last1) ])  //(MARGIN MONTHS fix, when booking include margin months, i.e 28 Aug - 3 Sept) //strtotime("12-Aug-2019") returns unixstamp
				->all(); 
				  
            array_push($array_All_sqlData, ${'monthData'.$i}); //adds current month booking data to array $array_All_sqlData
			//END DATE for Previous month  ONLY (+ this current month in first iteration)-------------------------------
			
			
			
			//Badges:count amount of booked days for for a specific NEXT month (from 6-months range) (+ this current month in first iteration) one by one in a loop. Unix book_to_unix & book_from_unix are from DB results
		    $countX = 0;
		    foreach (${'monthData'.$i} as $a){
				
				//Start MARGIN MONTHS fix, when booking include margin months, i.e 28 Aug - 3 Sept)*********************   
				//fix for 1nd margin month, i.e for {28 Aug-31 Aug}  from (28 Aug - 3 Sept) (i.e we take only 28 Aug - 31 Aug) 
				if($a->book_to_unix > strtotime($last1)){ //if last booked day UnixStamp in this month is bigger than this month last day UnixStamp (i.e it means that this current loop booking is margin & last date of it ends in the next month )
				    $number = (strtotime($last1) - $a->book_from_unix )/60/60/24; //i.e This month last day minus this loop DB booked start day
				}
				
				//fix for 2nd margin month, i.e for {1 Sept-3 Sept}  from (28 Aug - 3 Sept) (i.e we take only 1 Sept - 3 Sept) 
				 else if($a->book_from_unix < strtotime($first1)){    //if 1st booked day UnixStamp in this month is smaller than this month 1st day UnixStamp (i.e it means that this current loop booking is margin & start date of it begun in past month )
			         $number = ($a->book_to_unix - strtotime($first1))/60/60/24; //i.e This loop DB booked end day minus This month first day 
					
                 //if booking is normal, without margin month, i.e 12 Aug - 25 aug					
				 } else {
		             $number = ($a->book_to_unix - $a->book_from_unix)/60/60/24;
				  } 
				//END MARGIN MONTHS fix, when booking include margin months, i.e 28 Aug - 3 Sept)********************* 
				
				
				
				 $number = $number + 1; //if u want to count from 5 aug to 6 aug as 2 days , not as one 
		         //$from = strtotime($last); $to = strtotime($first); $diff = $from - $to;   $countX = $diff;///60/60/24;
			     $countX = $countX + $number; //sum all booked days
		     }
			
	
			
		    array_push($array_All_CountDays, $countX); //adds this current month booked days (in numbers, i.e 22) to array 
		   //END count amount of booked days for for a specific next month one by one in a loop. Unix from & to are from DB results
			
		
         } // END FOR(++)
    //END  FIND SQL DATA for ALL NEXT MONTHS (+ this current month in first iteration) IN FOR LOOP
		
		//return everything to be used in actionAjax_get_6_month
		return array( 
		    array('array_All_Month'=> $array_All_Month),
			array('first'=> $first), //returns empty as not used
			array('weekdays'=> array('dayofweek_first'=> $dayofweek_first)), //$weekdays[$dayofweek_first] //returns empty as not used
			$weekdays[$dayofweek_last], //returns empty as not used
			array('array_All_sqlData'=> $array_All_sqlData), 
			array('array_All_Unix'=> $array_All_Unix), 
			$array_All_CountDays
			);
 }
 
 
 // **                                                                                  **
 // **************************************************************************************
 // **************************************************************************************
 
 
 
 
   
 // **************************************************************************************
 // **************************************************************************************
 //                                                                                     **
     function get_All_Next_Months_List($i){ //pass {$i} as arg is a must
		    //$array_All_Month = array();//will store all 6 month data
		    //Start DATE for NEXT months  ONLY (+ this current month in first iteration)----------------------------
            $PrevMonth = date('M', strtotime(date('Y-m'). " + " .$i. " month")); //i.e Jul  //$PrevMonth=date('M', strtotime(date('Y-m')." -1 month"));         
            $PrevYear =  date('Y', strtotime(date('Y-m')." + " .$i. " month"));  //i.e 2019 // $PrevYear=date('Y', strtotime(date('Y-m')." -1 month"));// getting Next  month  and  year;
        
		    /*${'current'.$i}*/ $b = $PrevMonth . " " . $PrevYear; //i.e Jul 2019
			//array_push($array_All_Month, ${'current'.$i}); //adds next months to array in a loop
			return array($b, $PrevMonth) ; //$b=>"Nov 2019"   //$PrevMonth=> "Jun"
	 }
	 
	 
	 
	 
	 
	 

 // **************************************************************************************
 // **************************************************************************************
 //                                                                                     **
    function correctYear($PrevMonth){
		 //var with year, used for creating Unix for next years, must be declared out of for loop, to save its value for further iteration, in case if($may == 1 )
		 $MonthList= array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"); //General array for all click actions
		 
		 static $y = 0; //Mega Fix, cast static type 
		 
		 
		 $yearX = date("Y"); //gets the current year, i.e 2019
	     $may =  array_search($PrevMonth , $MonthList); //search the index of $PrevMonth  in array, i.e index of Jul = 6
		 $may = $may + 1;
			
		 //if current month in loop is 1 (i.e January), for this & next months we use the next year. As it is loop, January here could NOT BE EVER here the current month, if($may == 1 ) it can only be the next or next+1, etc, so the current is always the past year & January is the next	
		 if($may == 1 ){
			 $y++;
		     //$yearX must be declared out of for loop, to save its value for further iteration, in case if($may == 1 )
		    // $yearX++ ; //was = (int)date("Y") + 1; Fix for unlimited future years// gets the current year & adds +1 to get the next year, ie. 2019 + 1 = 2020
			 //$yearX = (string)$yearX;
			
		 }
		 
		 $yearX = $yearX + $y; //encrease year
		 return array('may'=> $may, 'yearX'=> $yearX); //
	}
 
 
   
 
 // **************************************************************************************
 // **************************************************************************************
 //                                                                                     **
     function get_Next_Months_Unix($may, $yearX){
		 $first1 = date("Y-m-d", mktime(0, 0, 0, $may , 1 ,$yearX)); //gets the first day of the current month, returns  "2019-05-01"
		 $last1 = date("Y-m-d",  mktime(0, 0, 0, $may+1, 0, $yearX)); //gets the last day of the current month,returns "2019-05-31"
			
	     //gets Unix Start Time & Unix End Time of the current month (+ this current month in first iteration) (i.e Unix of the 1st & last day)
		 $array_tempo = array(strtotime($first1), strtotime($last1)); //push current month unix stamp start/stop Unix time to subarray // returns [1556654400,1559246400]
		 //array_push($array_All_Unix, $array_tempo); //push subarray to array in order to have structure [[35, 57], [35, 57], [35, 57],]
		 return array('array_tempo'=> $array_tempo, 'first1'=> $first1, 'last1'=> $last1);
	 }
 
 
 
  
 // **************************************************************************************
 // **************************************************************************************
 //                                                                                     **
 
    function findBooked_Dates_In_Month($i, $first1, $last1 ){
		//Find SQL data for a specific NEXT month (+ this current month in first iteration) (from 6-months range) one by one in a loop
         //creating array {SmonthData1,SmonthData2,}
         ${'monthData'.$i} = BookingCph::find()   ->orderBy ('book_id DESC')  /*->limit('5')*/ 
			    ->where([ 'book_user' => Yii::$app->user->identity->username, /*'mydb_id'=>1*/]) //if this line uncommented, each user has its own private booking(many users-> each user has own private booking appartment, other users cannot book it). Comment this if u want that booking is general, ie many users->one booking appartment(many users can book 1 general appartment)  
			    ->andWhere(['between', 'book_from_unix', strtotime($first1), strtotime($last1) ])   /*->andFilterWhere(['like', 'supp_date', $PrevMonth])  ->andFilterWhere(['like', 'supp_date', $PrevYear])*/    
				->orWhere (['between', 'book_to_unix',   strtotime($first1), strtotime($last1) ])  //(MARGIN MONTHS fix, when booking include margin months, i.e 28 Aug - 3 Sept) //strtotime("12-Aug-2019") returns unixstamp
				->all(); 
		return ${'monthData'.$i};	  
          //array_push($array_All_sqlData, ${'monthData'.$i}); //adds current month booking data to array $array_All_sqlData
		  //END DATE for Previous month  ONLY (+ this current month in first iteration)-------------------------------
	}
	
	
	
	
 // **************************************************************************************
 // **************************************************************************************
 //                                                                                     **
	
	function getCount_OfBooked_Days_For_Badges_and_FixMargins($monthData, $first1, $last1){
	        //Badges:count amount of booked days for for a specific NEXT month (from 6-months range) (+ this current month in first iteration) one by one in a loop. Unix book_to_unix & book_from_unix are from DB results
		    $countX = 0;
		    foreach ($monthData/*${'monthData'.$i}*/ as $a){
				
				//Start MARGIN MONTHS fix, when booking include margin months, i.e 28 Aug - 3 Sept)*********************   
				//fix for 1nd margin month, i.e for {28 Aug-31 Aug}  from (28 Aug - 3 Sept) (i.e we take only 28 Aug - 31 Aug) 
				if($a->book_to_unix > strtotime($last1)){ //if last booked day UnixStamp in this month is bigger than this month last day UnixStamp (i.e it means that this current loop booking is margin & last date of it ends in the next month )
				    $number = (strtotime($last1) - $a->book_from_unix )/60/60/24; //i.e This month last day minus this loop DB booked start day
				}
				
				//fix for 2nd margin month, i.e for {1 Sept-3 Sept}  from (28 Aug - 3 Sept) (i.e we take only 1 Sept - 3 Sept) 
				 else if($a->book_from_unix < strtotime($first1)){    //if 1st booked day UnixStamp in this month is smaller than this month 1st day UnixStamp (i.e it means that this current loop booking is margin & start date of it begun in past month )
			         $number = ($a->book_to_unix - strtotime($first1))/60/60/24; //i.e This loop DB booked end day minus This month first day 
					
                 //if booking is normal, without margin month, i.e 12 Aug - 25 aug					
				 } else {
		             $number = ($a->book_to_unix - $a->book_from_unix)/60/60/24;
				  } 
				//END MARGIN MONTHS fix, when booking include margin months, i.e 28 Aug - 3 Sept)********************* 
				
				
				
				 $number = $number + 1; //if u want to count from 5 aug to 6 aug as 2 days , not as one 
		         //$from = strtotime($last); $to = strtotime($first); $diff = $from - $to;   $countX = $diff;///60/60/24;
			     $countX = $countX + $number; //sum all booked days
		     }
			
	
			return $countX;
		    //array_push($array_All_CountDays, $countX); //adds this current month booked days (in numbers, i.e 22) to array 
		   //END count amount of booked days for for a specific next month one by one in a loop. Unix from & to are from DB results	
	}
	
	
	
	
	
	
 
 // END Methods used in BookingCphController/actionAjax_get_6_month()--------------------------------------------------------------------------------------



 
 
 
 
 
 
 
 

 // Methods used in BookingCphController/actionAjax_get_1_month(). ---------------------------------------------------------------------------------------
 //It gets data from SQL for 1 single clicked month and build a calendar 
 

 // Methods used in BookingCphController/aactionAjax_get_1_month() ---------------------------------------------------------------------------------------
 
 
 
 
 
 
 
 

}
