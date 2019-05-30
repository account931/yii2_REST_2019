<?php
//access to this page have only users with RBAC role {adminX}
//access to this page is checked in site/rbac with => if(Yii::$app->user->can('adminX')){
/* @var $this yii\web\View */

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
		 $select1 = '<form action="#"><p><select size="" name="rbacrole">;<option selected>Select</option>';
		 
		 //loop through all Rbac roles() to build <select><option>
		 foreach($rbacRoleList as $rbList){
			 if($rbList->name == $innerj['item_name'] ){ //if foreach iteration roleName{$rbList->name} the same as a user has {$innerj['item_name']}, make that <option> SELECTED
				 $select1 = $select1 .'<option selected value="t1">' . $rbList->name .'</option>'; 
			 } else {
				 $select1 = $select1 .'<option value="t1">' . $rbList->name .'</option>'; //not selected
			 }        
		 }
			 
		 $select1 = $select1 . '</select></p><p><input type="submit" value="Do"></p></form>';
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
