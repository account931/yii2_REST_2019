<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Wpress\WpressBlogPost */

$this->title = Yii::t('app', 'Create Wpress Blog Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wpress Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wpress-blog-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
