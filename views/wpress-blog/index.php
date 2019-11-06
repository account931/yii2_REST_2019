<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wpress Blog Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wpress-blog-post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wpress Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'wpBlog_id',
            'wpBlog_title',
            'wpBlog_text:ntext',
            'wpBlog_author',
            'wpBlog_created_at',
            //'wpBlog_category',
            //'wpBlog_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
