<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bot\BotModel */

$this->title = Yii::t('app', 'Create Bot Model');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bot Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bot-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
