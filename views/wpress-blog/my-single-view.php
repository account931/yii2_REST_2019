<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Wpress\WpressBlogPost */

$this->title = "My-single-view of post number " . $model->wpBlog_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wpress Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wpress-blog-post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> 
        <?php /*echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->wpBlog_id], ['class' => 'btn btn-primary']);
              echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->wpBlog_id], [
              'class' => 'btn btn-danger',
              'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]);*/ ?>
    </p>

    <?php
	    //Display 1 single post 
	    echo "<div class='list-group-item'>";
		   
	        echo "<br>" .Html::a( '<i class="fa fa-angle-double-left" style="font-size:19px"></i> Go back', ["/wpress-blog/show-all-blogs", "period" => "",   ] /* $url = null*/, $options = ["title" => "go back",]);//go back nav
			echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/iconX.png' , $options = ["id"=>"","margin-left"=>"","class"=>"articleX","width"=>"","title"=>"post"] ); 
			echo "<hr><p><b>" . $model->wpBlog_title . "</b></p><hr>"; //title
			echo "<p>" . $model->wpBlog_text . "</p>";         //text
			echo "<hr>";
			
			
			echo "<p class='smallX'>Author:<b> " . $model->usernames->username . "</b></p>"; //getting has ONE relation for username(table {user})
			
			foreach ($model->tokens as $b){
			    echo "<p class='smallX'>Category:<b> " .  $b->wpCategory_name . "</b></p>"; //getting has many relation for category (table {wpress_category})
			}
			
			echo "<p class='smallX'> created at: " .  $model->wpBlog_created_at  . "</p>"; //display: created at
		echo "<div>";
	?> 
</div>
