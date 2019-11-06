<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Wpress\WpressBlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wpress-blog-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wpBlog_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wpBlog_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wpBlog_author')->textInput() ?>

    <?= $form->field($model, 'wpBlog_created_at')->textInput() ?>

    <?= $form->field($model, 'wpBlog_category')->textInput() ?>

    <?= $form->field($model, 'wpBlog_status')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
