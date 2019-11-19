<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bot Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bot-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Bot Model'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'b_id',
            'b_category:ntext',
            'b_key',
            'b_reply',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
