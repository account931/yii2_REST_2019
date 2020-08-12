<?php

use yii\helpers\Html;

use app\assets\Manual_Auto_Quiz_AssertOnly;   // use your custom asset
Manual_Auto_Quiz_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name of Class)


$this->title = 'Manual Auto Quiz Builder';
?>


<div class="manual-div">
   

    <h1>
	<?php //  echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/chat.png' , $options = ["id"=>"","margin-left"=>"23%","class"=>"","width"=>"12%","title"=>"click to add a new one"]); ?>
	<?= Html::encode($this->title); ?>
	
	
	
	<!-- Social Media Buttons  https://www.w3schools.com/howto/howto_css_social_media_buttons.asp -->
	<a href="#" class="fa fa-empire fa-my"></a>
    <a href="#" class="fa fa-eercast fa-my"></a>
	<!-- Social Media Buttons -->
	</h1>

	 <!-- Link to admin panel -->
     <?=Html::a('Admin Panel', ['#'], ['class'=>'btn btn-lg btn-info']);?>
	
	<div class="col-lg-12 col-md-12 col-sm-12 my-samples " >
	
	
	
	
	
	
	
    <!----------- My manual multi steps Quiz Builder with JQ Validation and RadioButtons in form of buttons  ----------------------->
	<!-- Multi steps quiz form content is loaded to <div id="quizDiv"> by JS ajax in (my-manual-quiz-builder.js.js). List of questions is in W3schoolController/actionAjaxQuizQuestionsList(). See details => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/web/js/W3school/my-manual-quiz-builder.js-->
	<center><h3 class="text-primary">My manual Quiz Builder with JQ Validation and RadioButtons in form of buttons</h3></center>
	
	<?php //render sub file ?>
	<?= $this->render('@app/views/manual-auto-quiz/sub_views/my-manual-quiz-builder') ?>
	
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- End My manual Quiz Builder with JQ Validation and RadioButtons in form of buttons----------------------->
	
	
	
	
	
	
		
		
    </div> <!-- End .my-samples -->
	
</div>