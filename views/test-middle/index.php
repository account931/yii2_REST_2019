<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Test for middle';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is a middle test
    </p>


	
	 <div class="alert alert-success">
        <?= nl2br("<h4><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span> This page is .....</h4>" .
		             "<p>Pease enter your email and we will check if you a new or already registered user.</p>" .
					 "<p>If you are in our DB, you'll be redirected to login page, otherwise you will get an activation letter to your email address.</p>" .
					 "<br>"); 
		?>
    </div>
	
	
	
	
	
   <!------ FLASH Success from BookingCpg/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('successX') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH Successfrom BookingCpg/actionIndex() ----->
  
  
  <?="<p class='alert-success'>Yoy mail  <i class='fa fa-laptop' style='font-size:1.3em;'></i> <b></b></p>";?>
	
	
	
	<!----------------- FORM  ---------------------->
	<div class="col-sm-6 col-xs-12">

           <?php  
		
		    $form = ActiveForm::begin (); 
			echo $form->field($model, 'emailX' )->input('email');
			?>
			<div class="form-group">
            <?= Html::submitButton('Go', ['class' => 'btn btn-primary']) ?>
           </div>
           <?php ActiveForm::end(); ?>	
	
	</div>
	<!----------------- FORM  ---------------------->
	
	

</div>
