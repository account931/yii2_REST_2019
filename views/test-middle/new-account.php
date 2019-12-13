<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Continue to register your account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       Continue to register your account
    </p>


	
	 <div class="alert alert-success">
        <?= nl2br("<h4><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span> Your email was new to us. But you successfully confirmed your registration. Continue to register your account</h4><br>"); ?>
    </div>
	
	
	
	
	
   <!------ FLASH Success from BookingCpg/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('successX') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH Successfrom BookingCpg/actionIndex() ----->
  
  
  
    <?php 
	    echo "<p class='alert-success'>Email:  <i class='fa fa-coffee' style='font-size:1.3em;'></i> <b>" . Yii::$app->request->get('emailZ')  ." </b></p>"; 
	    echo "<p class='alert-success'>Token:  <i class='fa fa-coffee' style='font-size:1.3em;'></i> <b>" . $token  ." </b></p>";
	?>

	
	
	<!----------------- FORM  ---------------------->
	<div class="col-sm-6 col-xs-12">

          
			 <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
				<?= $form->field($model, 'password_confirm')->passwordInput() ?> 
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
			
	</div>
	<!----------------- FORM  ---------------------->
	
	

</div>
