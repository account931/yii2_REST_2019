<?php

//Used in PasswordResetController to reset your forgotten password. 
//This is a page to change finally your password
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please choose your new password:</p>
    <div class="row">
        <div class="col-lg-5">
 
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
				<?= $form->field($model, 'password_confirm')->passwordInput() ?> 
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>