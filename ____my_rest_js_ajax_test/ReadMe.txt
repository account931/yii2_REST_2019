This index.php is to test Yii2 Rest API,requesting from non-Yii2 file.

-------------------------------------------------------------
1.HOW TO TEST REST API from non-Yii2 file. 
See more details at  
  a.)Readme_YII2_mine_Common_Comands.txt -> 7.Yii Restful API +  
  b.)Readme_YII2_mine_This_Project_itself.txt -> 1.HOW TO TEST REST API from non-Yii2 file. 
  
Folder {____my_rest_js_ajax_test} is to test Yii2 RestFul Api. You may (but not obligatory) copy this folder outside the Yii2 folder and run. In this case, change the folder order in jax url (i.e url: '../web/rest', )
Consider the folder order, ajax url is : '../yii-basic-app-2.0.15/basic/web/rest',
#To test non_Yii2 go "folderName" + ____my_rest_js_ajax_test/index.php
#To test Rest in Yii, just go to site/rest.

#If 'authenticator' => is Enabled in controllers/RestController (meaning user token is required), ajax(from non-Yii) or Yii2 URL must contain user token (from SQL rest_access_tokens)  
  i.e => url: '../web/rest?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b</p>
