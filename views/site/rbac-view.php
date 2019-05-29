<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'RBAC control';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Rbac access control page
    </p>

  
	<h4>This page to modify user RBAC roles </h4><br>
	
	
	<?php
	//check role, if current user doesn't have it, we assign it to current user
		if(Yii::$app->user->can('adminX')){
            echo '<h5>You have role <b>adminX</b> and can view current page</h5>';
			echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/unlocked.png' , $options = ["id"=>"unlck","margin-left"=>"3%","class"=>"cl-mine","width"=>"14%","title"=>"access granted"] );
        } else {
			echo "<h5> You have no <b>adminX</b> role and <b>CAN NOT</b> view this page</h5>";
			echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/locked.png' , $options = ["id"=>"unlck","margin-left"=>"3%","class"=>"cl-mine","width"=>"14%","title"=>"access granted"] );

		}
	?>
</div>
