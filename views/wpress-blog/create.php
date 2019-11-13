<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Wpress\WpressBlogPost */

$this->title = Yii::t('app', 'Create Wpress Blog Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wpress Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wpress-blog-post-create">

    <h1>
	<?= Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/article.jpg' , $options = ["id"=>"","margin-left"=>"23%","class"=>"","width"=>"12%","title"=>"click to add a new one"]); ?>
	<?= Html::encode($this->title) ?><i class="fa fa-folder-open-o" style="font-size:36px; margin-left:0.4em;"></i>
	</h1>
	
	<?php
	//FLASH MESSAGE
	$nn = Yii::$app->session->getFlash('addedSuccess'); //or directly <?= Yii::$app->session->getFlash('savedItem');
    if (Yii::$app->session->hasFlash('addedSuccess'))
    {
	    echo Alert::widget([
		    'options' => [
				'class' => 'alert alert-success'
			],
			'body' => "$nn"
		]); 
   }
   //FLASH MESSAGE
   ?>

   
   
   
    <?= $this->render('_form', [
        'model' => $model,
		'allCategories' => $allCategories
    ]) ?>

</div>
