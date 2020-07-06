<?php
//to display variouse css/js tips/tricks from W3school and other sources, like Full screen Overlay Navigation, Off-Canvas Menu, etc

use yii\helpers\Html;

use app\assets\W3school_AssertOnly;   // use your custom asset
W3school_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name of Class)


$this->title = 'W3schools tips and tricks';
?>


<div class="w3school-div">
   

    <h1>
	<?php //  echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/chat.png' , $options = ["id"=>"","margin-left"=>"23%","class"=>"","width"=>"12%","title"=>"click to add a new one"]); ?>
	<?= Html::encode($this->title); ?>
	
	
	<!-- Social Media Buttons  https://www.w3schools.com/howto/howto_css_social_media_buttons.asp -->
	<a href="#" class="fa fa-skype"></a>
    <a href="#" class="fa fa-android"></a>
	<!-- Social Media Buttons -->
	</h1>

	
	
	<div class="col-lg-12 col-md-12 col-sm-12 my-samples " >
	
        <a href="https://www.w3schools.com/howto/"><button class="btn btn-lg btn-fade-my">W3school How Guide</button></a>
		
		<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>

		
		
		
		
		
		<!----------- Blagosvet Gallery image sliders ----------------------->
		<center><h3 class="text-primary">Blg_svet gallery (no JS, speed is set in CSS)</h3></center>
	
        <div id="container_slide">

            <!-- Each image is 350px by 233px -->
            <div class="photobanner">
    	       <img class="first" src="image-1.html" alt="" /> <!-- MUST BE TO SLIDE -->
			   
			    <!--<img src="images/img_slide/sl_2.jpg" alt="" />-->
			    <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_2.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
			    <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_6.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
				<?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_4.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
				<?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_5.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_8.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
                <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_9.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>

    
		     
	    
    	         <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_2.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
    	         <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_6.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
    	         <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_4.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
			     <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_5.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"Cph"]); ?>
            </div>
    </div>
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
   	<!----------- Blagosvet Gallery image sliders ----------------------->
 
	

	
	
	
	
	
	
	

		


		
		
	

    <!----------- W3school Horizontal Scroll Menu =>  https://www.w3schools.com/howto/howto_css_menu_horizontal_scroll.asp -->
	 <center><h3 class="text-primary">Horizontal Scroll Menu</h3></center>
	 
	 <div class="scrollmenu">
         <a href="#home">Home</a>
         <a href="#news">News</a>
         <a href="#contact">Contact</a>
         <a href="#about">About</a>
         <a href="#support">Support</a>
         <a href="#blog">Blog</a>
         <a href="#tools">Tools</a>  
         <a href="#base">Base</a>
         <a href="#custom">Custom</a>
         <a href="#more">More</a>
         <a href="#logo">Logo</a>
         <a href="#friends">Friends</a>
         <a href="#partners">Partners</a>
         <a href="#people">People</a>
         <a href="#work">Work</a>
		 <a href="#home">Home</a>
         <a href="#news">News</a>
         <a href="#contact">Contact</a>
         <a href="#about">About</a>
         <a href="#support">Support</a>
         <a href="#blog">Blog</a>
         <a href="#tools">Tools</a>  
         <a href="#base">Base</a>
         <a href="#custom">Custom</a>
     </div>

	 <br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
     <!----------- End W3school Horizontal Scroll Menu =>  https://www.w3schools.com/howto/howto_css_menu_horizontal_scroll.asp -->
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	<!----------- W3school Multi Step Form =>  https://www.w3schools.com/howto/howto_js_form_steps.asp ----------------------->
	<center><h3 class="text-primary">Multi Step Form</h3></center>
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- End W3school Multi Step Form =>  https://www.w3schools.com/howto/howto_js_form_steps.asp ----------------------->


	
	
	
	
	
	
	
	<!----------- W3school  Full screen Overlay Navigation =>  https://www.w3schools.com/howto/howto_js_fullscreen_overlay.asp ----------------------->
	<center><h3 class="text-primary"> Full screen Overlay Navigation Menu</h3></center>
	
	<a href="https://www.w3schools.com/howto/howto_js_fullscreen_overlay.asp"><button class="btn btn-lg btn-fade-my">Full screen Overlay Navigation</button></a>
	<a href="https://www.w3schools.com/howto/howto_js_off-canvas.asp"><button class="btn btn-lg btn-fade-my">Off-Canvas Menu</button></a>
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br> 
	<!----------- End W3school  Full screen Overlay Navigation =>  https://www.w3schools.com/howto/howto_js_fullscreen_overlay.asp ----------------------->


    
	
	
	
	
	
	
	<!----------- JQ Surver Builder ----------------------->
	<center><h3 class="text-primary">JQ Surver Builder</h3></center>
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- End JQ Surver Builder ----------------------->
	
	
	
	
	<!----------- XXXXX ----------------------->
	<center><h3 class="text-primary">XXXX</h3></center>
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- End XXXX ----------------------->
	
	
	
	
	
		
		
    </div> <!-- End .my-samples -->
	
</div>