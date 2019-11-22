#RestFul API and RBAC Yii2 application & so on....
#This YIi2 Basic template uses stack: RESTful API, custom REST action (with WHERE statement), 
   RBAC roles (if(Yii::$app->user->can('adminX') ), 
   SQL DB registration/authentication (check login credential), 
   multilanguage, token generator, 
   bookingCPH, edit password, password reset by email.
   
#Yii2 uses SQL database  => yii2-rest

To get necessary DB table for this project, apply migration:
 #for Users(see Readme_YII2_mine_Common_Comands.txt ->5.Yii2 basic. Registration, login via db.)
 #for Rbac (see Readme_YII2_mine_Common_Comands.txt -> 8.Yii RBAC)

TABLE OF CONTENT:
1.HOW TO TEST REST API from non-Yii2 file.
2.Rbac access management table + collapsed form to add a new Rbac to all rbac roles, i.e to auth_items DB.
3.Automatically become an {adminX} (i.e gets adminX role) by going to link (actionAddAdmin).
4.RestFul Api.
5.Booking CPH
5.6 Margin months Fix, when booking include magrin months, i.e 28 Aug - 3 Sept) 
7. How to validate dates input in form in Booking CPH
8. Why should we use {error_reporting(E_ALL & ~E_NOTICE);} on 000web.com hosting //JUST TO FIX 000web HOSTING!!!!!!!!!!!!!!!
9. Bot Yii
10. Yii2 Wordpress analogue

-------------------------------------------------------------
1.HOW TO TEST REST API from non-Yii2 file. 
See more details at:
   a.)Readme_YII2_mine_Common_Comands.txt ->7.Yii Restful API 
   b.)Readme_YII2_mine_Common_Comands.txt ->7.1 Yii Restful API(control token authorization(access available with token only)).
   
Folder {____my_rest_js_ajax_test} is to test Yii2 RestFul Api. You may (but not obligatory) copy this folder outside the Yii2 folder and run. In this case, change the folder order in jax url (i.e url: '../web/rest', )
Consider the folder order, ajax url is : '../yii-basic-app-2.0.15/basic/web/rest',
#To test non_Yii2 go "folderName" + ____my_rest_js_ajax_test/index.php
#To test Rest in Yii, just go to site/rest.






--------------------------------------------------------------
2.Rbac access management table + form to add a new Rbac to all rbac roles, i.e to auth_items DB.

How it works:
1.Rbac works using 2 tables: {auth_items} DB (keeps all rbac roles & descriptions) and {auth_assignment} DB (keeps pairs: rbac role - userID, who has this role).
1.1.Rbac managements table is created via php, updated via ajax.A collapsed form to add a new role uses php only.
2. Rbac management table (created in siteController/actionRbac)  displays all users from DB {users}, even those who are not in {auth_assignment } due to InnerRight. 
#Access to {siteController/actionRbac} is granted for those who has {adminX} rbac role (in auth_asdignment DB.)Checked with if(Yii::$app->user->can('adminX')){}

#Rbac management table is built on $query that uses 3 InnerJoin to get data from DB {users}(gets userNames) + DB {auth_item}(gets roleDescription) + DB {auth_assign}(gets pairs Rbac role/uesrID).
3. When you go to controller Site/actionRbac, this action:
 #makes 3 tables InnerJoin Sql queries.
# selects all RBAc roles from table auth_item(to form <select><option> in view)
#create Instance/model of DB table {auth_item} to pass to view (to render yii form "Add new Rbac role ").
# if the Form to add a new RBAC role to {auth_item} DB is trigered---

4.Render section (in site/rbac) passes to /views/site/rbac-view.php following objects: 

'query' => $query, //Inner Join result	
'rbacRoleList' => $rbacRoleList, //all RBAc roles from table auth_item(for <select><option>)	
'authItem_Model' => $authItem_Model,//Instance/model of DB table {auth_item} to pass to view (to render yii form "Add new Rbac role ")


5.1.View /views/site/rbac-view.php uses ajax when updating users" rbac roles in auth_assignment DB.
#This view (views/site/rbac-view.php) creates rbac management table using $query from controller Site/rbac + creates a form to add a new role to auth_items DB.

#When creating rbac management table, we assign userID(from $query) to every button id (to be used in ajax to send userID to php).

#When u change a user role (in <select>) in Rbac management table and click OK, ajax is sent to Site/actionAjaxRbacInsertUpdate (ajax sends user ID (which user's role to change) and selected role (what role to assign).

#actionAjaxRbacInsertUpdate checks if user ID is already in auth_assignment DB, i.e if this user has already been asdign any role previously. If TRUE, it checks if user selected role is not the same already assigned in auth_assignment DB, then uses so-called UPDATE: as standart yii update does not work here for this table, so we firstly  revokeAll(id) this user from any previous roles and then assign him a new role (which came via ajax data.) 
If user ID does not exist in auth_assignment DB,( i.e user has never been assigned any role previously), then we assign him this user selected role, i.e we use so-called INSERT: as for this table we cant use standard yii INSERT, we use this code, which inserts new record to auth_assignment DB:

$userRole = Yii::$app->authManager->getRole($_POST['selectValue']); //gets the role (from auth_assignment DB)
 Yii::$app->authManager->assign($userRole, $_POST['userID']);// assign a DB role to user ID.

#If ajax (from views/site/ rbac-view.php) is successfull, we use JQ html() to change html in rbac management table for a certain user only (the one for which we changed rbac role.)
//CHANGE dynamically text in User Role. {$(this)} or {$(this).prevAll(".rdescr")} does not work, so we get userID {res.userIDX} from ajax, which is the same as button-> <input type="submit" value="Do" class="formzz", and from that button we find prev <td> for description and prev-prev for role name
$("#" + res.userIDX).closest('td').prev('td').prev('td').stop().fadeOut("slow",function(){ $(this).html(res.roleNew)}).fadeIn(2000);







---------------------------------------------------------

3.Automatically become an {adminX} (i.e gets adminX role) by going to link (actionAddAdmin).
Currently, any user, who visits this page wil get adminX rbac role.

------------------------



//============================================================================
4.RestFul Api.
RestFull Api-> see {Readme_YII2_mine_Common_Comands.txt}










//===========================================================================
5.Booking CPH
How Booking CPH works (booking a flat for any day in further 6 month)
How to:
This application provides booking a flat during the next 6 month (duration of months is configurable in Controllers/ BookingCphController, in function  actionAjax_get_6_month().

-----------

5.1. General overview:
  5.1.)One and the only view for displaying Booking CPH is views/booking-cph/index( + additionally thus view is filled with ajax 6-month & 1-month divs)
  5.2.)6-months view is created by: onLoad  Js functiob get_6_month();} is triggered, sends ajax to BookingCphController/ajax_get_6_month(), gets a JSON as a response and in SUCCESS ajax section constructs 6 months, then html () it.
  5.3.) When u click on any of 6 month, JS { js/bookingcph.js/function get_1_single_month(this) }   detects it, get data-unix attribute of clicked Div and sends ajax to with data (start/end day in Unix of this month)  to BookingCphController /actionAjax_get_1_month(). 

PHP {BookingCphController /actionAjax_get_1_month} does construct the 1 month calendar to one php variable and rerurn it (as long as php echo in Controller causes crash). JS gets a response and html() the whole response (html (data)).
Booking CPH 2


---------------------- ----------------------

5.2. Creating 6-month view. Detailed overview  (step-by-step):
5.2.1. When u run  BookingCphController/actionIndex, it renders view/index.php. This view/index.php register custom asset CPH_AssertOnly  with JS file booking_cph.js.
 OnLoad (when u run   BookingCphController/actionIndex), js function {get_6_month();} sends ajax to BookingCphController/ajax_get_6_month(). 

This php action in {for()} loop gets the current year and month ($current=Jun-2019), pushes it to $array_All_Month, then gets current month in digits(i.e  $monthZZZ=2	), then  gets the first day of the current month( $first="2019-05-01"), then gets week day  of 1st day($first), (i.e   $dayofweek_first=3, 3 means Wed), then gets last day of the month and its weekday ($last="2019-05-31"; $dayofweek_last), then gets UnixStamp for the 1st and last days of this month and push these values to $array_All_Unix.

Then makes SQL request to find all records in Table Booking CPH . {andWhere(['between', 'book_from_unix', strtotime($first), strtotime($last) ])}, saves results to $monthData
and push  $monthData  to  $array_All_sqlData. Then additionally makes foreach ($monthData) to count amount of booked days for this month (to be used to be displayed in round red badges).

5.2.4. Then in for loop, it does the same but for the next i (6) month (rest $i). In the end php script echoes json with several arrays.

JS gets the json_encoded from   BookingCphController/function get_6_month()  and in success  ajax section runs function    getAjaxAnswer_andBuild_6_month(dataX), that builds html of 6 future month with month names and round badges (which display amount of booked days in this month).

---------------------- ----------------------

5.3. Creating 1-month view. Detailed overview  (step-by-step):
5.3.1. One month is ajax created while clicking on any of 6 months divs.
5.3.2 OnClick on any of 6 months divs, JS gets the data-unix of this div, which is in format  {unix stamp of 1st day in given month/unix last days}, i.e {46888/56788}, then sends ajax to BookingCphController /actionAjax_get_1_month(), passing these unix start/end. Php script DOESN'T JSON ECHO some json vars, but it returns the whole result (all html with created calendar in one variable, so in Ajax success u'll just html(dataX) of the whole data).

5.4. New booking (Inserting new Booking).
When the form is submitted, model {BookingCph} checks if selected dates are not past time and if input1 !> input2. If validation is OK, the script make SELECT to see if the dates are not in SQL DB yet (if dates are not booked yet).

5.6 Margin months Fix
This is a special fix/check used while creating  a single one month calendar in case if booking dates are margining 2 months, i.e 28Aug - 3Sept.

 This Fix checks if the END Unix date of this month booking is bigger than this month last day Unix, meaning that this  booking ends in the next month(and days from next month must not be included to this month calendar graphic display. 
Then additionally checks if this month bookings's START Unix date is smaller than this month 1st day in Unix, meaning that this booking begins in previous month and days from previous month must not be included to this month calendar graphic display.

---

5.7 Building a calendar for a single month.
How to build a Calendar for this one month:
# on clicking on a single month, js/bookingcph.js/function get_1_single_month(this) 
sends ajax to with data (start/end day in Unix of this month)  to BookingCphController /actionAjax_get_1_month()

Action gets passed from js ajax start/end day in Unix of this month:
$start = (int)$_POST['serverFirstDayUnix'];  $end = (int)$_POST['serverLastDayUnix']; 

and makes request to DB base with SELECT where records between this month first day Unix time and last day.

$thisMonthData = BookingCph::find()->..someElse..->andWhere(['between', 'book_from_unix', $start, $end ]) ->orWhere (['between', 'book_to_unix', $start, $end ]).

Then, it runs foreach ($thisMonthData) to get var {$diff }(i.e amount of booked days in this month).

Then, it runs for($i = 0; $i < $diff+1; $i++){} to get array  { $array_1_Month_days} with booked days, i.e [7,8,9,12,13]

Then, run  for($i = 1; $i < $dayofweek; $i++)
to build blanks days, it is used only in case if the 1st day of month(in numeric, i.e Tue means 2) is not the first day of the week, i.e not Monday.

Then, runs for($j = 1; $j < (int)$lastDay[2]+1; $j++) to 
 build the calendar with free/taken days	.$lastDay[2]+1 is a quantity of days in this month(i.e last day in this month).

Then it returns to js ajax var {$text} with whole calendar, which ajax Success section htmls to div ( html(data)).
//END 5.Booking CPH



















=========================================================================
7. How to validate dates input in form in Booking CPH
SEE DETAILS at {Readme_YII2_mine_Common_Comands.tx-> 17. Yii2 my custom validation}
https://www.yiiframework.com/doc/guide/2.0/ru/tutorial-core-validators

#To make sure that user selects a date that in not a past date, or make sure that start date is not bigger that end date we apply validation:
 #We could use JS validation like this=>   $("#myForm").on("beforeSubmit", function (event, messages) { 
 , but we use here Yii2 my custom validation. SEE DETAILS at {Readme_YII2_mine_Common_Comands.tx-> 17. Yii2 my custom validation}
 
 
 =========================================================================
 8. Why should we use {error_reporting(E_ALL & ~E_NOTICE);} on 000web.com hosting //JUST TO FIX 000web HOSTING!!!!!!!!!!!!!!!
 
 
 
 
 
 
 ==========================================================================
 9. Bot Yii
 Bot that auoreplies your messages. 
 Uses cURL for Api requests(like weather/news) as file_get_contents() is not supported on hosting (though it works on localhost). cUrl is supported both on local & 000web.com hosting
 #It uses SQL DB table  -> {bot}. Values in this table fields {b_autocomplete, b_reply} must be separated by "//". Field {b_key} does not requre that.
  i.e"//" is a limiter to covert string to array => split() in js/bot/autocomplete.js and for explode() in BotController/actionAjaxReply()
 
 # Main action is {BotController/function actionBotChat()} that sends ajax requests with your text to {BotController/function actionAjaxReply()}
 
 #Php Array(b_autocomplete) for js autocomplete is passed to from PHP in views/bot/bot-view.php. PHP URL for JS ajax is passed there too.
  
  
  
  
  
  
  
  
  
  
  
  
  ===============================================================
  10. Yii2 Wordpress analogue
  Wpress read me
#Yii2 equivalent of Wordpress blogging.
#Uses 2 tables-> blogs {WpressBlogPost} and category{WpressCategory}.

#Page with all articles (blogs) is => {WpressBlogController -> actionShowAllBlogs}. 
It displays all articles from table {WpressBlogPost} using hasOne and hasMany relations from table {Users} and {WpressCategory}.
On load article text is truncated with {js/ wpress.js} and comes in first <p>.
Full text comes in next sibling <p> with css {display: none;}. On click, we switch visibility of two <p>.

# Page displaying all Articles uses dropdown <select> with all categories selected from Db table {WpressCategory}.
and on change redirects to same page, but with different $_Get ['category']. 
In action {actionShowAllBlogs} we check $_Get ['category'] and make Active Record SQL query with WHERE statement.
#Single article view {views/site/my-single-view.php} and Admin GridView {views/site/index}

#Views of {WpressBlogController/actionShowAllBlogs & actionMySingleView($id)} use hasMany and hasOne relations.
#Admin GridView uses hasMany and hasOne relations as well.
 