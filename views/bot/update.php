<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bot\BotModel */

$this->title = Yii::t('app', 'Update Bot Model: {nameAttribute}', [
    'nameAttribute' => $model->b_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bot Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->b_id, 'url' => ['view', 'id' => $model->b_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bot-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
