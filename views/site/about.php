<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <!--<code><?= __FILE__ ?></code>-->
	
	 <div class="alert alert-danger">
        <?= nl2br("<h4><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span> This page is available for users with <b>adminX</b> access roles only </h4><br>"); ?>
    </div>
	
	
	
	
	<?php
	//check role, if current user doesn't have it, we assign it to current user
		if(Yii::$app->user->can('adminX')){
            echo '<h5>You have role <b>adminX</b> and can view current page</h5>';
			echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/unlocked.png' , $options = ["id"=>"unlck","margin-left"=>"3%","class"=>"cl-mine","width"=>"14%","title"=>"access granted"] );
        } else {
			echo "<h5> You have no <b>adminX</b> role and <b>CAN NOT</b> view this page</h5>";
			echo "<p>Access to this page is Limited in views/site/about.php with RBAC <b>{ if(Yii::$app->user->can('adminX'))} </b></p>";
			echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/locked.png' , $options = ["id"=>"unlck","margin-left"=>"3%","class"=>"cl-mine","width"=>"14%","title"=>"access granted"] );

		}
	?>
</div>
