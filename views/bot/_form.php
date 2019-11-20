<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bot\BotModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bot-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'b_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'b_key')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'b_reply')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
