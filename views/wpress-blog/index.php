<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wpress Articles Admin Part');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wpress-blog-post-index my-adminX">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wpress Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<?php
	//just a test to echo $eventStatus, that was set as EVENT in models/WpressBlogPost.php
	echo  "<p class='text-danger'>EVENT_NEW_MY_TRIGGER_X Status=>  {$eventStatus} </p><hr>";
	?>
	
	
	<!-------- gridview -------->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
			//here go SQl Table fields to show
            //'wpBlog_id',
            'wpBlog_title',  //article title
            //'wpBlog_text:ntext',
			
			//article text => truncated text that is cut via anonymous function // from start was {//'wpBlog_text:ntext',}
			['attribute' =>'wpBlog_text', 'label'=>'Text', /*'value' => '',*/ 'content'=>function($data){
				               $length = 15; $text = $data->wpBlog_text; 
							   if(strlen($text) > $length){
								   $text = substr($text, 0, $length) . "...";
							   } 
							   return $text;} ], 
							   
            ['attribute' =>'wpBlog_author', 'label'=>'Author', 'value' => 'usernames.username'], //{'value' => 'usernames.username'} uses hasOne relation from models\Wpress\WpressBlogPost. {usernames.username} means => function getUsernames()/table field name
            ['attribute' => 'wpBlog_created_at',  'label'=>'Создано',  'format'=> 'date', 'headerOptions' => ['width' => '150']],  //datetime //HH:mm:ss dd.MM.YYYY
            ['attribute' => 'wpBlog_category','label'=>'Category', 'value' => 'categories.wpCategory_name'],  //{'value' => 'categories.wpCategory_name'} uses hasOne relation from models\Wpress\WpressBlogPost => function getCategories()/table field name
			['attribute'=>'wpBlog_status', 'label'=>'Status_','filter'=>array(0=>"OK", "1"=>"NO"),], //'wpBlog_status',
			//END here go SQl Table fields to show
			
            //settings for actions, i.e delete, update, view
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Do', 'headerOptions' => ['width' => '80'],'template' => '{view} {update} {delete}{link}',   
			    'buttons' => [ //change image for "Update Button"
                'update' => function ($url,$model) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-edit"></span>', // '<button class="btn btn-primary"><span style="color:black;" class="glyphicon glyphicon-edit"></span></button>',
                    $url);
                },  ] , //'options'=>['style'=>'background:red'],
				
				
				],
			 //settings for actions, i.e delete, update, view
			
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
		
        
		
		

		
		
	//end GridView	
    ]); ?>
</div>
