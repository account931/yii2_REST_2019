<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


use app\assets\Wpress_AssertOnly;   // use your custom asset
Wpress_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name of Class)

$this->title = Yii::t('app', 'All Wpress Blog Posts <hasMany/hasOne relations>');
$this->params['breadcrumbs'][] = $this->title;
?>

  
  
<div id="all" class="wpress-blog-post-index animate-bottom">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wpress Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', ' Go to admin panel '), ['index'], ['class' => 'btn btn-danger']) ?>
    </p>

    
	
	
	
	<?php
	//NOT WORKING DROPDOWN-------
	//array_unshift($categories,"blue=>dd");
	$c =  ArrayHelper::map($categories, 'wpCategory_id', 'wpCategory_name'    );
	//$c['8'] = 'nnnn';
	//array_unshift($c,'"blue" =>"dd"');
	$c = array_merge(array('0' => 'All articles'), $c);
	
	
	//DropDown List
	      echo Html::dropDownList('dropName', null,
             $c, 
			         [
                      //'multiple' => 'multiple',
                      'options' => [ 'id' => 'sxx',
                           'value' => [ 'class' => 'sx', 'style'=> 'color:red;',  ],
                           'value2' => ['label' => 'value 2'], ], ]
			);
	//END NOT WORKING DROPDOWN-------


		
	  
	  //MOST WORKING!!!!!!!!!!!!!!!!
	  //Hand made Dropdown as can't inject <a href> in Html::dropDownList. JAVASCRIPT!!!!!!!!!
      echo  '<select id="dropdownnn" style="border:1px solid red;">';
          foreach($c as $idd=>$n){  //foreach($categories as $a){ 
		      $link = yii\helpers\Url::to(['/wpress-blog/show-all-blogs',  "category" => $idd,]);// Html::a($n , ["/wpress-blog/show-all-blogs", "category" => $a,], $options = ["title" => "more  info", "class" => "categorMenu"]);
		     //echo '<a href="www.retrter.com">';
			 
			 //gets to know what select <option> to make selected according to $_GET['']
			 if(isset($_GET['category']) && $_GET['category'] == $idd){
				 $selectStatus = 'selected="selected"';
			 } else {
					 $selectStatus = '';}
			 
		     echo '<option value="' . $link . '"' . $selectStatus . '>' .   $n .' </option>';          //echo '<option value='. $a->wpCategory_id . '>' .   $a->wpCategory_name .' </option>';
			 //echo '</a>';
		     //echo Html::a( $a->wpCategory_name, ["/site/about", "period" => "",], $options = ["title" => "more  info",] );
            //echo '<option value='. $a->wpCategory_id . '>'. $a->wpCategory_name . '</option>';   
			 //echo '</option>';
		  }
	  echo  '</select>';	

	  
	  
	  
	  
	  
	  
	  //NOT WORKING DROPDOWN-------
	  //echo $_SERVER['HTTP_HOST'] ; //localhost
	  //var_dump($c );
	  
     //kostil!!!!!!!
	 $categories = ArrayHelper::map($categories, 'wpCategory_id', 'wpCategory_name'); //turns object to array, i.e array("1"=> "general", "2"=> "Science")
	 $categories = array_merge(array('0' => 'All articles'), $categories); //adds in the begging of array a new value
	 //var_dump($categories);
	 //echo Html::a( "All Category", ["/wpress-blog/show-all-blogs", "category" => $a->wpCategory_id,], $options = ["title" => "more  info",]) . "&nbsp;&nbsp;";
     
	 echo  '<select>';
	 foreach($categories as $idX=>$nameX){ 
	     //echo Html::a( $a->wpCategory_name, ["/wpress-blog/show-all-blogs", "category" => $a->wpCategory_id,], $options = ["title" => "more  info",]) . "&nbsp;&nbsp;";
	     echo "<option value='v'>";
		 echo Html::a( $nameX , ["/wpress-blog/show-all-blogs", "category" => $idX,], $options = ["title" => "more  info", "class" => "categorMenu"]);
	     echo "</option>";
	 }
     echo  '</select>';
	//END NOT WORKING DROPDOWN-------
	
	
	
	
	
	
	//echo  Html::encode("<script>alert(2);</script>");  //will display the text as it without alerting
	//echo  \yii\helpers\HtmlPurifier::process("<script>alert(2);</script>"); //won't display anything unless it is a simple text
	
	
	
	
	
	//DISPLAY ALL BLOG POSTS-----------------------
	echo "<br><p class='list-group-item'><b>We have  ". /*counr($queryX)*/ $queryX->count() . " posts</b></p><br>";  //display quantity of posts
	if(!$modelPageLinker){
		echo "<p> No Records are found</p>";
	}
	//var_dump($queryX);
	
    //calculatin the correct number of articles, regadless whta page u are on for Post 1, Post 2. If u are on page 2 of pagination, your post should not be Post 1
	if(Yii::$app->getRequest()->getQueryParam('page')== 1 || !Yii::$app->getRequest()->getQueryParam('page')== 1){
		$b = 0; //iterator to display number of articles, i.e Post 2, Post 3
	} else {
        $b = (Yii::$app->getRequest()->getQueryParam('page') * Yii::$app->getRequest()->getQueryParam('per-page')) - Yii::$app->getRequest()->getQueryParam('page')-1;	
	}
	$i = $b;// 0; //iterator to display number of articles, i.e Post 2, Post 3
	
	
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
		     echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/iconX.png' , $options = ["id"=>"","margin-left"=>"","class"=>"articleX","width"=>"","title"=>"post"] ); 
      		 echo "<p><b>Post " . ++$i . "<br>" .  $model->wpBlog_title . "</b></p>";  //display: Post Number + Titile
		     echo "<p class='text-truncated iphoneX' title='click to expand' onClick=''>" .  $model->wpBlog_text  . "</p>";       //display: post text, text of the article is cut with JS
			 echo "<p class='text-hidden iphoneX' title='click to minimize' onClick=''>" .  $model->wpBlog_text  . "</p>";       //display: post text, hidden by default, visible on click
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
			 echo  Html::a( "read full article", ["/wpress-blog/my-single-view", "period" => "", "id"=>$model->wpBlog_id  ] /* $url = null*/, $options = ["title" => "more  info",]); 
		echo "</div><hr>";
     }
	 //END display all posts using hasMany relation from table {user} and table {wpress_category}
	 

    // display LinkPager navigation
    echo LinkPager::widget([
        'pagination' => $pages,
    ]); 
   ?>

</div>
