<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sms Api';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?> <i class="fa fa-envelope-o" style="font-size:1.5em;"></i></h1>

   


	
	 <div class="alert alert-success">
        <?= nl2br("<h4><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span> This page is Sms Api</h4>" .
		             "<p><b></b></p>" .
		             "<hr>" .
					 $text .
					 "<br>"); 
		?>
     </div>
	
	
	
	
	
   <!------ FLASH Success from SmsApiController/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('successX') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH Successfrom SmsApiController/actionIndex() ----->
  
  
  <!------ FLASH FAIL from SmsApiController/actionIndex() Sms not send----->
   <?php if( Yii::$app->session->hasFlash('failX') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('failX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH FAIL from SmsApiController/actionIndex()) ----->
  
  
  
  
  <!-----------------------------Form --------------------------->
  <?php $form = ActiveForm::begin([
        'id' => 'sendsms',
        'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            //'labelOptions' => ['class' => 'col-lg-1 control-label shadowX lavender'],
        ],
    ]); ?>


        <?= $form->field($model, 'cellNumber')->textInput(['autofocus' => true, 'value'=> '+380976641342','placeholder' => 'Phone in format 38097********']) ?>
        <?= $form->field($model, 'smsText')->textarea(['rows' => '6', 'maxlength' => 60, 'value'=>'Hello. Eng version. Русская версия', 'placeholder' => 'sms text....' ]) ?> 

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
  
  <!------------------------ END Form --------------------------->
  
  
  
  
  

</div>
