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
        <?= nl2br("<h4><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span></h4>Account with email <b>" . Yii::$app->request->get('emailZ') . "</b> exists. Sign in using your password."); ?>
   </div>
	
	
	
   <!------NOT USED!!!! FLASH Success from BookingCpg/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('successX') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH Successfrom BookingCpg/actionIndex() ----->
  
  
  
    <?php echo "<p class='alert-success'>Email:  <i class='fa fa-coffee' style='font-size:1.3em;'></i> <b>" . Yii::$app->request->get('emailZ')  ." </b></p>"; ?>
	
	
	
	<!----------------- FORM  ---------------------->
	<div class="col-sm-6 col-xs-12">

         <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
        ]); ?>

        <?= $form->field($model, 'email')->hiddenInput([ 'value'=> Yii::$app->request->get('emailZ') ])->label(false) ?>  

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
				<?=Html::a('&#60;&#60; Go back', ['test-middle/index'], ['class'=>'btn btn-small btn-success']);?>
				
            </div>
        </div>

    <?php ActiveForm::end(); ?>
	
	
	</div>
	<!----------------- FORM  ---------------------->
	
	
	
	

</div>
