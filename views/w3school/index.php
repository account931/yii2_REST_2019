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
 
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!----------- Gallery slider -> Waze Chart/Term paper -----------------------> <!-- http://www.htmldrive.net/items/show/653/jQuery-Large-Thumb-Photo-Gallery -->
	<center><h3 class="text-primary">Gallery slider -> Chart/Term paper</h3></center>
	
	
	<!--start Waze gallery plugin-->
    <div id="wrapper">
        <div id="below">
		
<div id="slide1" class="slideshow">
	<div class="img_cont">
	
  <ul id="desc1" class="descriptions">
    <li>
      <p class="slider_add">PARTY HARD</p>
      <p></p>
    </li>
    <li>
      <p class="slider_add">Happy Hour.</p>
      <p>  </p>
    </li>
    <li>
      <p class="slider_add">Shults.</p>
      <p>  </p>
    </li>
    <li>
      <p class="slider_add">Waze drinking beer</p>
      <p> </p>
    </li>
    <li>
      <p class="slider_add">IGNITE</p>
      <p>  </p>
    </li>
    <li>
      <p class="slider_add">New-Year</p>
      <p> </p>
    </li>
    <li>
      <p class="slider_add">6.</p>
      <p> </p>
    </li>
   
      </ul>

	
				

  <ul class="main_images">
    <!-- Image in link -->
	<li><a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_6.jpg" class="cboxElement"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_6.jpg" alt="girl" /></a></li>
    <li><a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" class="cboxElement"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" alt="girl" /></a></li>
    <li><a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_4.jpg" class="cboxElement"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" alt="girl" /></a></li>
    <li><a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_5.jpg" class="cboxElement"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" alt="girl" /></a></li>
    <li><a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_6.jpg" class="cboxElement"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" alt="girl" /></a></li>
    <li><a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" class="cboxElement"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" alt="girl" /></a></li>

		
  	<!--<li><?php //echo Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_6.jpg'), [ 'view3', 'id' =>''], ['class'=>'cboxElement'] );?></li>
    <li><?php  //echo Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_2.jpg'), [ 'view3', 'id' =>''], ['class'=>'cboxElement'] );?></li>
    <li><?php //echo Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_4.jpg'), [ 'view3', 'id' =>''], ['class'=>'cboxElement'] );?></li>
    <li><?php //echo Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_5.jpg'), [ 'view3', 'id' =>''], ['class'=>'cboxElement'] );?></li>
	<li><?php //echo Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_6.jpg'), [ 'view3', 'id' =>''], ['class'=>'cboxElement'] );?></li>
    <li><?php //echo Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/sl_2.jpg'), [ 'view3', 'id' =>''], ['class'=>'cboxElement'] );?></li>    
  -->
  </ul>
  </div>



   <div class="prev_btn"><a href="#" class="prev"><img src="images/previous.png" alt="previous"/></a></div>
  <div class="thumb_holder">
    <ul class="thumbs">
      <li class="section">
        <ul class="sub_section">
          <li><a href="javascript:void(0);"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_6.jpg" alt="Waze" /></a></li>
          <li><a href="javascript:void(0);"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" alt="Waze" /></a></li>
          <li><a href="javascript:void(0);"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_5.jpg" alt="Waze" /></a></li>
          <li><a href="javascript:void(0);"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_4.jpg" alt="Waze" /></a></li>
          <li><a href="javascript:void(0);"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_6.jpg" alt="Waze" /></a></li>
          <li><a href="javascript:void(0);"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/sl_2.jpg" alt="Waze" /></a></li>		  
		  
          <!--<li><a href="javascript:void(0);"><img src="images/img2TH.jpg" alt="Waze" /></a></li>
          <li><a href="javascript:void(0);"><img src="images/img3TH.jpg" alt="bear" /></a></li>
          <li><a href="javascript:void(0);"><img src="images/img4TH.jpg" alt="smo" /></a></li>
          <li><a href="javascript:void(0);"><img src="images/img5TH.jpg" alt="Happy hour" /></a></li>-->
        </ul>


    <!-- LI HAS BEEN SHUT DOWN HERE -->
      <!--<li class="section">
        <ul class="sub_section">
          <li><a href="javascript:void(0);"><img src="images/track_chloe_thumb.jpg" alt="track" /></a></li>
      </ul>
      </li>
    </ul>  -->
  </div>
      <div class="next_btn">
	      <?php //echo Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/img_slide/wazeGalleryTools/next.png'), [ '#'], ['class'=>'next'] );?>
          <a href="javascript:void(0);" class="next"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/images/img_slide/wazeGalleryTools/next.png" alt="next"/></a>
	  </div>

</div>
</div>
<!--end plugin-->


 
	
	
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- END Gallery slider {Chart/Term paper} ----------------------->
	
	
	
	
	

		


		
		
	

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
	<center><h3 class="text-primary">W3school Multi Step Form</h3></center>
	<a href="https://www.w3schools.com/howto/howto_js_form_steps.asp"><button class="btn btn-lg btn-fade-my">Multi Step Form</button></a>
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- End W3school Multi Step Form =>  https://www.w3schools.com/howto/howto_js_form_steps.asp ----------------------->


	
	
	
	
	<!-----------  Multi Step Form with JQ Validation Plug-in and Progress Bar     ----------------------->
	<!----------- https://www.phpflow.com/php/multi-step-form-using-php-bootstrap-jquery/ + https://djaodjin.com/blog/jquery-multi-step-validation.blog  -------->
	<center><h3 class="text-primary">Multi Step Form with JQ Validation Plug-in and Progress Bar </h3></center>
	
	<div class="progress">
	    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
     </div>
	 
     <form id="regiration_form" novalidate action=""  method="post">
	 
     <fieldset>
        <h2>Step 1: Create your account</h2>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
		<div class="form-group">
            <label for="exampleConfirmInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Confirm Password">
        </div>
        <input type="button" name="next" class="next btn btn-info" value="Next" />
     </fieldset>
	 
     <fieldset>
         <h2> Step 2: Add Personnel Details</h2>
         <div class="form-group">
             <label for="fName">First Name</label>
             <input type="text" class="form-control" name="fName" id="fName" placeholder="First Name">
         </div>
         <div class="form-group">
             <label for="lName">Last Name</label>
             <input type="text" class="form-control" name="lName" id="lName" placeholder="Last Name">
         </div>
         <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
         <input type="button" name="next" class="next btn btn-info" value="Next" />
     </fieldset>
	 
     <fieldset>
        <h2>Step 3: Contact Information</h2>
        <div class="form-group">
            <label for="mob">Mobile Number</label>
            <input type="text" class="form-control" id="mob" name="ph_number" placeholder="Mobile Number">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea  class="form-control" name="address" placeholder="Communication Address"></textarea>
         </div>
         <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
         <input type="submit" id="submitBtn" name="submit" class="submit btn btn-success" value="Submit" />
     </fieldset>
  </form>
	
	
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- End Multi Step Form with JQ Validation Plug-in and Progress Bar  ----------------------->
	
	
	
	
	
	
	<!----------- W3school  Full screen Overlay Navigation =>  https://www.w3schools.com/howto/howto_js_fullscreen_overlay.asp ----------------------->
	<center><h3 class="text-primary"> Full screen Overlay Navigation Menu</h3></center>
	
	<a href="https://www.w3schools.com/howto/howto_js_fullscreen_overlay.asp"><button class="btn btn-lg btn-fade-my">Full screen Overlay Navigation</button></a>
	<a href="https://www.w3schools.com/howto/howto_js_off-canvas.asp"><button class="btn btn-lg btn-fade-my">Off-Canvas Menu</button></a>
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br> 
	<!----------- End W3school  Full screen Overlay Navigation =>  https://www.w3schools.com/howto/howto_js_fullscreen_overlay.asp ----------------------->


    
	
	
	
	
	
	
	<!----------- JQ Surver Builder ----------------------->
	<center><h3 class="text-primary">JQ Dynamic-Survey-Generator-jQuery-renderSurvey</h3></center>
	
	https://www.jqueryscript.net/other/Dynamic-Survey-Generator-jQuery-renderSurvey.html
	
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- End JQ Surver Builder ----------------------->
	
	

	
	<!----------- XXXXX ----------------------->
	<center><h3 class="text-primary">XXXX</h3></center>
	<br><hr style="width: 90%; color: black; height: 2px; background-color:black;"><br>
	<!----------- End XXXX ----------------------->
	
	
	
	
	
		
		
    </div> <!-- End .my-samples -->
	
</div>