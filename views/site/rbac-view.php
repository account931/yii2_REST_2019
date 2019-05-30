<?php
//access to this page have only users with RBAC role {adminX}
//access to this page is checked in site/rbac with => if(Yii::$app->user->can('adminX')){
/* @var $this yii\web\View */
//THIS page displays RBAC management table(based on 3table INNERJOIN). Rendered in site/actionRbac .In table u can select and assign a specific RBAC role to a certain user. When u this, an ajax with userID & RBAC roleName are sent to site/AjaxRbacInsertUpdate

use yii\helpers\Html;

$this->title = 'RBAC control';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <h4>RBAC access control page
    </h4>

  
	<p>This page is designed to moderate user RBAC roles (InnerJoin) </p><br>
	
	
	<?php
	//check if user  has RBAC role adminX
		
     echo '<h5>You have role <b>adminX</b> and can view current page</h5>';
	 echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/unlocked.png' , $options = ["id"=>"un", "margin-left"=>"3%","class"=>"cl-mine","width"=>"14%","title"=>"access granted"] );

	 
	 
	 
	 
	 //add new RBAC role to auth_items section
	 echo "<p style='position:absolute; top:320px; right:50px;border:1px solid black;padding:3px;'> Add a new RBAC role to auth_items </p>";
	 //END add new RBAC role to auth_items section
	 
	 
	 
	 
	 
	 //BUILDING A TABLE WITH RBAC management
	 //INNER JOIN RESULTS (3 tables) (user->rbac role)----------------------------

	 echo "<table id='rbResult'>"; //start table
	 echo "<tr><th>User Name</th><th>Rbac role</th><th>Descr</th><th>Action</th></tr>"; //create headers of table
	 
	 foreach($query as $innerj){
		 
		  //Building <select><option>---------------
		 //short val for select/option
		 $select1 = '<form id ="myForm" action="#"><p><select size="" name="rbacrole" id="">;<option selected>Select</option>';
		 
		 //loop through all Rbac roles() to build <select><option>
		 foreach($rbacRoleList as $rbList){
			 if($rbList->name == $innerj['item_name'] ){ //if foreach iteration roleName{$rbList->name} the same as a user has {$innerj['item_name']}, make that <option> SELECTED
				 $select1 = $select1 .'<option selected value="' . $rbList->name . '">' . $rbList->name .'</option>'; //$rbList->name is an DB->db field "name" //I.E, this line returns => <option selected value="adminX">adminX</option>
			 } else {
				 $select1 = $select1 .'<option value="' . $rbList->name . '">' . $rbList->name .'</option>'; //not selected //I.E, this line returns => <option value="adminX">adminX</option>
			 }        
		 }
		
         //final part of <select> + <button id="userID">		
		 $select1 = $select1 . '</select></p><p><input type="submit" value="Do" id="' .$innerj['id'].  '"></p></form>';
		 //END Building <select><option>------------
		 
		 //assign user rbac role var. Ternary operator is used
		 $userRole = $innerj['item_name']?$innerj['item_name']:"not set"; //if in foreach iteration {$innerj['item_name']} exists, take it. Otherwise use "not set"
		 
		 //echo finsl table row : username-> his current role-> select/option
		 echo "<tr><td>" . $innerj['username'] . "</td><td>" . $userRole . "</td><td>" .   $innerj['description']   . "</td><td>" . $select1 ." </td></tr>";
	 }
	 echo "</table>";
	 //END INNER JOIN-----------------------------------------------------------------
     //END BUILDING A TABLE WITH RBAC management  
	?>
</div>



















<?php 
//START AJAX
    $URL = Yii::$app->request->baseUrl . "/site/ajax-rbac-insert-update";   //WORKING,  gets the url to send ajax, defining it in  $ajax causes routing to 404, Not found, as the url address does not render correctly
    //url: 'http://localhost/iShop_yii/yii-basic-app-2.0.15/basic/web/index.php?r=products/getajaxorderdata',  // the correct address sample for ajax
    $Controller = Yii::$app->controller->id; // to pass in ajax
	
	//echo $URL;
	
	//My working JS Register
	//Checks in JS if the Validation runs fine 
	$this->registerJs( <<< EOT_JS_CODE
	// JS code here   //afterValidate
	

  
   $(document).on("click", '#myForm', function() {   // this  click  is  used  to   react  to  newly generated cicles;
   //$("#myForm").on("beforeSubmit", function (event, messages) {
       // Now you can work with messages by accessing messages variable
       //var attributes = $(this).data().attributes; // to get the list of attributes that has been passed in attributes property
       //var settings = $(this).data().settings; // to get the settings
       //alert (attributes);
	   
	   //alert($(this).find("input[type=submit]").attr('id'));
 
       var form = $(this);
	   if (form.find('.has-error').length ) {  //if validation failed
	   
	       alert("Validate failed"); 
		   return false;  //prevent submitting and reload
	   
       //if validation is OK	   
	   } else { 
	   
	        alert("Validate OK");  //alert(<?php echo Yii::$app->request->baseUrl?> +"/products/getajaxorderdata" );
		    // runs ajax here
			//var userInput = $(this).serialize();  //user form input-FAILS
			//alert("form " + userInput);
			
			
			
			// Start AJAX
            $.ajax({
			    //url      : '<?php echo Yii::app()->createUrl("products/getajaxorderdata");?>',
		        url: '$URL',  //WORKING
				//url: form.attr('getajaxorderdata'),
                
                type: 'post',
				// dataType : "html",
				dataType:'json', // use JSON
               
			    //passing the data to ajax
				data: {
                    controller : '$Controller ',
				    //_csrf : '<?= Yii::$app->request->csrfToken; ?>',
				    selectValue : $(this).find(":selected").val(),  //value of nearest <select> toclicked button
					userID: $(this).find("input[type=submit]").attr('id'),

                },
				
				//if send was successful
                success: function(res){
                    console.log(res);
				    alert(res.result_status);
			        //modify the html of upadted user.....
                },
                error: function(errX){
                    alert('Error from view/rbac-view.php View!' + errX);
                }
            });
			// END runs AJAX here
		    return false; //prevent reloading/submitting the form
		  
	   } // end else
  });
  
  
  
  // END JS code here		
  
EOT_JS_CODE
);
  ////any spaces before EOT_JS_CODE will cause the crash
	?>