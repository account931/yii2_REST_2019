<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wpress Articles Admin Part');
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

            //'wpBlog_id',
            'wpBlog_title',
            //'wpBlog_text:ntext',
            ['attribute' =>'wpBlog_author', 'label'=>'Author', 'value' => 'usernames.username'], //{'value' => 'usernames.username'} uses hasOne relation from models\Wpress\WpressBlogPost. {usernames.username} means => function getUsernames()/table field name
            ['attribute' => 'wpBlog_created_at',  'label'=>'Создано',  'format'=> 'date', 'headerOptions' => ['width' => '150']],  //datetime //HH:mm:ss dd.MM.YYYY
            ['attribute' => 'wpBlog_category','label'=>'Category', 'value' => 'categories.wpCategory_name'],  //{'value' => 'categories.wpCategory_name'} uses hasOne relation from models\Wpress\WpressBlogPost => function getCategories()/table field name
			['attribute'=>'wpBlog_status', 'label'=>'Status_','filter'=>array(0=>"OK", "1"=>"NO"),], //'wpBlog_status',
			
			

            ['class' => 'yii\grid\ActionColumn'],
			

			
        ],
		
		//adding odd/even class
		 'rowOptions'=>function ($model, $key, $index, $grid){
             $class=$index%2?'bg-primary':'admin-even';
             return [
               'key'=>$key,
               'index'=>$index,
               'class'=>$class
             ];
         },
		//adding odd/even class
		
        
		
		

		
		
		
    ]); ?>
</div>
