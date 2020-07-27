<?php
//Documentations => https://fotorama.io/#eaaee377-f1b5-49d7-a7db-d7a1f86b2805
use yii\helpers\Html;
?>

<div class="col-lg-12 col-md-12 col-sm-12 ">
	<center>
	    <h3 class="text-primary">fotorama-gallery</h3>
	
	
	
	
            <!-- Add images to <div class="fotorama"></div> -->
            <div class="fotorama" 
                        data-nav="thumbs" data-width="50%" data-ratio="600/400">  
						<!-- {data-nav="thumbs" }=>to add thumbnail navigation below the image -->
			            <!-- {data-width="100%" data-ratio="800/600"}=> responsive image size -->
			
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_6.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
	            <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_4.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
	            <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_5.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_8.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_9.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?> 	         
            </div>
	
	
   </center>
</div>