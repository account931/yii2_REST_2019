<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Wpress\WpressBlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wpress-blog-post-form">

    <?php $form = ActiveForm::begin(); 

     echo $form->field($model, 'wpBlog_title')->textInput(['maxlength' => true]);

     echo $form->field($model, 'wpBlog_text')->textarea(['rows' => 6]);

     //echo $form->field($model, 'wpBlog_author')->textInput();
	 //echo $form->field($model, 'wpBlog_author')->hiddenInput(['value'=> Yii::$app->user->identity->id])->label(false); //sets author (current user ID) to this hidden field

     //echo $form->field($model, 'wpBlog_created_at')->textInput(); 

     //echo $form->field($model, 'wpBlog_category')->textInput(); 
     echo $form->field($model, 'wpBlog_category')->dropDownList(ArrayHelper::map($allCategories,'wpCategory_id','wpCategory_name'), ['prompt' => 'Select category']); 

     echo $form->field($model, 'wpBlog_status')->dropDownList([ '0'=>'Not_Published', '1'=>'Published', ], ['prompt' => '',  'options'=>['1'=>['Selected'=>true]]] ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
