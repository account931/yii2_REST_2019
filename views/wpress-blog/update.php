<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Wpress\WpressBlogPost */

$this->title = Yii::t('app', 'Update Wpress Blog Post: {nameAttribute}', [
    'nameAttribute' => $model->wpBlog_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wpress Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->wpBlog_id, 'url' => ['view', 'id' => $model->wpBlog_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="wpress-blog-post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
