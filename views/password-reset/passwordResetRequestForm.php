<?php

//Used in PasswordResetController to reset your forgotten password. 
//page to enter your email to get an email letter with link to reset your forgotten password

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="site-request-password-reset">
    <h1>
	    <?= Html::encode($this->title); 
		    echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/forget.jpg' , $options = ["id"=>"sx","margin-left"=>"3%","class"=>"","width"=>"12%","title"=>"forget"] ); ?>
    </h1>
    <p>Please fill out your email. A link to reset password will be sent there.</p>
	<p style ="font-size:0.7em;"><i>Used to reset your forgotten password if you have forgotten it.
    When u request resetting, firstly you input your email, then check your email box and follow the link with token to reset your forgotten password.</i></p> 
	
	<div class="row">
        <div class="col-lg-5">
 
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
				
				<!-- Captcha -->
				<?= $form->field($model, 'captcha')->hiddenInput()->label(false) ?>
                <div class="form-group">
                    Captcha: <mark><b><?= $model->captcha ?></b></mark>                    
                 </div>
                 <?= $form->field($model, 'recaptcha')->textInput(['placeholder' => 'Enter Captcha'])->label(false) ?>
				<!-- Captcha -->
				
                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
			
			
 
        </div>
    </div>
</div>

<div>
<?php
   if(!Yii::$app->user->isGuest){ 
       echo "<br> <p class='red'>*You see this message cause you you visited this page from test link (not from Login page). 
	         <br>Because u are already logged and logged users are not supposed to be able to visit this reset form, 
			 <br>only those who have forgotten theit password</p>";
   }
   ?>
</div>