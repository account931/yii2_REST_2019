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
        <?= nl2br("<h4><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span> This page is .....</h4><br>"); ?>
    </div>
	
	
	
	
	

  
  
  
	
	
	
	<!----------------- FORM  ---------------------->
	<div class="col-sm-6 col-xs-12">

           <?php 
			
			echo "<p class='alert-success'>Yoy mail  <i class='fa fa-hotel' style='font-size:1.3em;'></i> <b></b></p>"; 
		
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
