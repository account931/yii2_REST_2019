<?php



use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\assets\Shop_LiqPay_Simple_AssertOnly;   // use your custom asset
Shop_LiqPay_Simple_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name
?>


	
	
<?php	
	


$this->title = 'Shop Liq E-pay {Simple Version}';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <div class="row">
	
	    <div class="col-sm-10 col-xs-10">
            <h1><?= Html::encode($this->title) ?></h1>
		</div>	
		
		
		<!-------- Cart icon with badge ----------->
		<?php 
		//get the car quantity
		if (isset($_SESSION['car-simple-931t'])) { 
		    $c = count($_SESSION['car-simple-931t']); 
		} else { 
			    $c = 0; 
		} ?>
		
		<div class="col-sm-2 col-xs-2 badge1 bb" data-badge="<?php echo $c; ?> ">
		    <?php echo Html::a( '<i class="fa fa-cart-plus fa-4x" aria-hidden="true"></i>', ["/shop-liqpay-simple/cart"], $options = ["title" => "Cart Simple"]); ?>

		</div>
        <!-------- Cart icon with badge ----------->	
		
   </div>
	
	
	<!-------------------- Progress Status Icons by component ----------------->
	<?php
	       //display shop timeline progress => Progress Status Icons
	       echo \app\componentsX\views_components\LiqPay\ShopTimelineProgress::showProgress("Shop");
	?>
	
	<!--------------  END  Progress Status Icons by component ----------------->
	
	
	
	<hr>
	<p class="text-danger">LiqPay Shop => Simple version, more simple version of ShopLiqpay but without ajax, just php operating</p>
	<hr>

 <?php 
  //all products array, as if we get from DB
  $productsX = [
      ['id'=> 0, 'name'=> 'Esprit Ruffle Shirt', 'price' => 16.64, 'image' => 'canon.jpg', 'description' => 'Esprit Ruffle Shirt.....some description'],
      ['id'=> 1, 'name'=> 'Herschel supply',     'price' => 35.31, 'image' => 'hp.jpg', 'description' => 'Herschel supply.........some description'],
	  ['id'=> 2, 'name'=> 'Classic Trench Coat', 'price' => 75.00, 'image' => 'iphone_3.jpg', 'description' => 'Classic Trench Coat.....some description'],
	  ['id'=> 3, 'name'=> 'Front Pocket Jumper', 'price' => 75.00, 'image' => 'iphone_5.jpg', 'description' => 'Front Pocket Jumper.....some description'],
	  
	  ['id'=> 4, 'name'=> 'Shirt in Stretch Cotton', 'price' => 2.66,  'image' => 'ipod_classic_3.jpg', 'description' => 'some description'],
	  ['id'=> 5, 'name'=> 'Pieces Metallic Printed', 'price' => 18.96, 'image' => 'samsung_sync.jpg', 'description' => 'some description'],
	  ['id'=> 6, 'name'=> 'Femme T-Shirt In Stripe', 'price' => 25.85, 'image' => 'samsung_tab_5.jpg', 'description' => 'some description'],
	  ['id'=> 7, 'name'=> 'T-Shirt with Sleeve',     'price' => 18.49, 'image' => 'sony_vaio_1.jpg', 'description' => 'some description'],
  ];
 
  
  $_SESSION['productCatalogue'] = $productsX; //all products from DB to session
  
  ?>
  
  
  
      <div class="row shop-items">
	      <?php
		  //generate shop products, Loop ----------------------------------------------------------
	      for($i = 0; $i < count($productsX); $i++){
          
		       
			
		       
			   	
			echo '<div id="' . $productsX[$i]['id'] . '" class="col-sm-5 col-xs-12  list-group-item bg-success cursorX" data-toggle="modal" data-target="#myModal' . $i . '">' .  //data-toggle="modal" data-target="#myModal' . $i .   for modal
			       '<div class="col-sm-2 col-xs-3">' . $productsX[$i]['name'] . '</div>' . 
				   '<div class="col-sm-4 col-xs-2 word-breakX">' . $productsX[$i]['price']. '</div>' .
				   '<div class="col-sm-2 col-xs-3">' . $productsX[$i]['name'] .  '</div>' .  	
				   '<div class="col-sm-4 col-xs-4 word-breakX">'. 
				       Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay_Simple/' . $productsX[$i]['image'] , $options = ["id"=>"","margin-left"=>"","class"=>"my-one","width"=>"","title"=>"product"]).
                   '</div>' .   
				 '</div>';
				 
			
			//adds vertical space after 2 divs with goods
			if($i%2 != 0 ){ 
			    echo '<div class="col-sm-12 col-xs-12">even</div>';
			} else { //add horizontal space between 2 goods
				echo '<div class="col-sm-1 col-xs-1">s</div>';
			}
		    ?>


		
		 <!--------- Hidden Modal ---------->
           <div class="modal fade" id="myModal<?php echo $i;?>" role="dialog">
               <div class="modal-dialog modal-lg">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title"><i class="fa fa-delicious" style="font-size:3em; color: navy;"></i> <b> Product</b> </h4>
                       </div>
					   
                      <div class="modal-body">
                          <p><b> <?=$productsX[$i]['name'];?></b></p>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Price</div>
						      <div class="col-sm-4 col-xs-9"><span class="price-x"><?=$productsX[$i]['price'];?></span> ₴</div> 
						  </div>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Info</div>
						      <div class="col-sm-4 col-xs-9"><?=$productsX[$i]['description'];?></div> 
						  </div>
						  
						   <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Total</div>
						      <div class="col-sm-4 col-xs-9 shadowX"><span class="sum"></span></div> 
						  </div>
						  
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Image</div>
						      <div class="col-sm-8 col-xs-9"><?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay_Simple/' . $productsX[$i]['image'] , $options = ["id"=>"","margin-left"=>"","class"=>"my-one-modal","width"=>"","title"=>"product"]);?></div>
						  </div>  
					 
                     </div>
					 
					 <!---------- Section ++button /form input/--button ------->
					 <div class="row">
					 
					     <!--- Empty div to keep distance -->
					     <div class="col-sm-4 col-xs-2"> 
						 </div>
					    
						
						<!--- Plus button -->
					     <div class="col-sm-1 col-xs-2"> 
						     <button type="button" class="btn btn-primary button-plus">+</button>
						 </div>
						 
						 
						 <!-- form with input -->
						 <div class="col-sm-2 col-xs-3">
					         <?php 
					         $form = ActiveForm::begin(['action' => ['shop-liqpay-simple/add-to-cart'],'options' => ['method' => 'post', 'id' => 'formX'],]); 
                                 echo $form->field($myInputModel, 'yourInputValue')->textInput(['maxlength' => true,'value' => 4, 'class' => 'item-quantity form-control'])->label(false); //product quantity input
                                 echo $form->field($myInputModel, 'productID')->hiddenInput(['value' => $productsX[$i]['id'],])->label(false); //product ID hidden input

							 ?>
								 
 	                             <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', 'Add to cart'), ['class' => 'btn btn-primary shadowX' , 'id'=>'']) ?>
                                 </div>
                             <?php ActiveForm::end(); ?>
						  </div>
						  
						  <!-- End form with input -->
						  
						  
						  <!--- Minus button -->
						  <div class="col-sm-1 col-xs-2"> 
						     <button type="button" class="btn btn-danger button-minus">-</button>
						 </div>
						 
                         <!--- Empty div to keep distance -->						 
						 <div class="col-sm-3 col-xs-3">
						 </div>
						  
					 </div>
					 <!---------- END Section ++button /form input/--button ------->
					 
					 
					  
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
           </div>
          <!------------ End Modal ---------------> 
		  
		  <?php
		  }
		  ?>
	  </div> <!-- row shop-items -->
  
  </div>
  
   