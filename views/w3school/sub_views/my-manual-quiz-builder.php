<?php

use yii\helpers\Html;
?>

<div class="col-lg-12 col-md-12 col-sm-12 ">
	<center>
	    <h3 class="text-primary">My manual Quiz Builder</h3>
	    
		<!---- progress Bar --> 
		<div class="progress">
	        <div class="progress-barQ progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
		
		
		<!---- just CPH image ----> 
		<div class="">
		<?php echo \yii\helpers\Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/w3school/copenHeight.jpg' , $options = ["id"=>"","margin-left"=>"3%","class"=>"img-quiz","width"=>"32%","title"=>"CPH"] ); ?>
        </div>
		
	 
		<!---- here goes JS ajax generated quiz --> 
		<!-- Multi steps quiz form content is loaded to <div id="quizDiv"> by JS ajax in (my-manual-quiz-builder.js.js). List of questions is in W3schoolController/actionAjaxQuizQuestionsList(). See details => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/web/js/W3school/my-manual-quiz-builder.js-->
		<div id="quizDiv" class="col-lg-12 col-md-12 col-sm-12">
		    <div id='loaderQuiz'><!-- Loader gif, always visible, erased by ajax success -->
			<?=\yii\helpers\Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/w3school/load.gif' , $options = ["id"=>"","margin-left"=>"","class"=>"loaderQuiz","width"=>"","title"=>"click to add a  new  one"] ); ?>
			</div><!-- End Loader gif -->
		</div>
	
	
   </center>
</div>