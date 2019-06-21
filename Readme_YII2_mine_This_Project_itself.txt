#RestFul API and RBAC Yii2 application.
#This YIi2 Basic template uses stack: RESTful API, RBAC roles, SLQ DB registration/login, 
#Yii2 uses SQL database  => yii2-rest

To get necessary DB table for this project, apply migration:
 #for Users(see Readme_YII2_mine_Common_Comands.txt ->5.Yii2 basic. Registration, login via db.)
 #for Rbac (see Readme_YII2_mine_Common_Comands.txt -> 8.Yii RBAC)

1.HOW TO TEST REST API from non-Yii2 file.
2.Rbac access management table + collapsed form to add a new Rbac to all rbac roles, i.e to auth_items DB.
3.Automatically become an {adminX} (i.e gets adminX role) by going to link (actionAddAdmin).
4.RestFul Api.



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




4.RestFul Api.
RestFull Api-> see {Readme_YII2_mine_Common_Comands.txt}
