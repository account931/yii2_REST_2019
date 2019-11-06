<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'All Wpress Blog Posts <hasMany/hasOne relations>');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wpress-blog-post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wpress Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', ' Go to admin panel '), ['index'], ['class' => 'btn btn-danger']) ?>
    </p>

    
	
	
	
	<?php
	//DISPLAY ALL BLOG POSTS-----------------------
	echo "<br><p class='list-group-item'><b>We have  ". count($queryX) . " posts</b></p><br>";  //display quantity of posts
	 
	$i = 0;
	//var_dump($modelPageLinker);
	//echo '<pre>'; var_dump($queryX); echo '</pre>';
	
	
	//testing has many
	/*foreach($modelPageLinker as $vv){
		    foreach ($vv->tokens as $f){ //call hasMany action //Token is a function getTokens
		    echo $f->wpCategory_name;
			}
		}
	*/
	
	//display all posts using hasMany relation from table {user} and table {wpress_category}
    foreach ($modelPageLinker as $model) {
		//echo Html::a( $i ."." . $v->name, ["/site/view-one", "id"=> $v->id, "period" => "",   ] /* $url = null*/, $options = ["title" => "more  info", "class"=>"list-group-item"] ); 
		
        echo "<div class='list-group-item'>";
		     echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/article.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"articleX","width"=>"","title"=>"post"] ); 
      		 echo "<p><b>Post " . ++$i . "<br>" .  $model->wpBlog_title . "</b></p>";  //display: Post Number + Titile
		     echo "<p>" .  $model->wpBlog_text  . "</p>";                              //display: post text
             echo "<hr>";
			 
			 //getting has many relation for category (table {wpress_category})
			 foreach ($model->tokens as $b){
			     echo "<p class='smallX'> category: " .    $b->wpCategory_name  . "</p>";   //display: category, using has many relations, from table {wpress_category}
			 }
			 
			 //getting has ONE relation for username(table {user})
			 //foreach ($model->usernames as $b){
			     echo "<p class='smallX'>by user: " .    $model->usernames->username  . "</p>";   //display: username, using has ONE relations //i.e $model->getUsernames()->username
			 //}
			 
			 echo "<p class='smallX'> created at: " .  $model->wpBlog_created_at  . "</p>"; //display: created at
			 //See more Link
			 echo  Html::a( "read full article", ["/wpress-blog/view", "period" => "", "id"=>$model->wpBlog_id  ] /* $url = null*/, $options = ["title" => "more  info",]); 
		echo "</div><hr>";
     }
	 //END display all posts using hasMany relation from table {user} and table {wpress_category}
	 

    // display LinkPager navigation
    echo LinkPager::widget([
        'pagination' => $pages,
    ]); 
   ?>

</div>
