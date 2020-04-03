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
		if (isset($_SESSION['cart-simple-931t'])) { 
		    $c = count($_SESSION['cart-simple-931t']); 
		} else { 
			    $c = 0; 
		} ?>
		
		<div class="col-sm-2 col-xs-2 badge1 bb" data-badge="<?php echo $c; ?> ">
		    <?php echo Html::a( '<i class="fa fa-cart-plus fa-4x" aria-hidden="true"></i>', ["/shop-liqpay-simple/cart"], $options = ["title" => "Cart Simple"]); ?>

		</div>
        <!-------- Cart icon with badge ----------->	
		
   </div>
	
	
	
	<!------ FLASH Success from BookingCpg/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('successX') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH Successfrom BookingCpg/actionIndex() ----->
  
  
	
	
	<!-------------------- Progress Status Icons by component ----------------->
	<?php
	       //display shop timeline progress => Progress Status Icons
	       echo \app\componentsX\views_components\LiqPay_Simple\ShopTimelineProgress2::showProgress2("Shop");
	?>
	
	<!--------------  END  Progress Status Icons by component ----------------->
	
	
	
	<hr>
	<p class="text-danger">LiqPay Shop => Simple version, more simple version of ShopLiqpay but without ajax, just php operating</p>
	<hr>

 <?php 
  //all products hardcoded artificial array, as if we get from DB. Now it is commented as we use real DB data, table {liqpay_shop_simple}
  /*
  $productsX = [
      ['id'=> 0, 'name'=> 'Canon camera', 'price' => 16.64, 'image' => 'canon.jpg', 'description' => '30 Mpx, 5kg'],
      ['id'=> 1, 'name'=> 'HP notebook',     'price' => 35.31, 'image' => 'hp.jpg', 'description' => '8Gb Ram, 500Gb SSD'],
	  ['id'=> 2, 'name'=> 'Iphone 3', 'price' => 75.55, 'image' => 'iphone_3.jpg', 'description' => 'TFT capacitive touchscreen, 3.5 inches, 16M colors, 2 Mpx '],
	  ['id'=> 3, 'name'=> 'Iphone 5', 'price' => 45.00, 'image' => 'iphone_5.jpg', 'description' => 'Iphone 5 description......'],
	  
	  ['id'=> 4, 'name'=> 'Ipod', 'price' => 2.66,  'image' => 'ipod_classic_3.jpg', 'description' => 'Ipod description....'],
	  ['id'=> 5, 'name'=> 'Samsung Sync', 'price' => 18.96, 'image' => 'samsung_sync.jpg', 'description' => 'Samsung Sync description...'],
	  ['id'=> 6, 'name'=> 'Samsung Tab 5', 'price' => 25.85, 'image' => 'samsung_tab_5.jpg', 'description' => 'Samsung Tab 5 description..'],
	  ['id'=> 7, 'name'=> 'Sony Vaio',     'price' => 18.49, 'image' => 'sony_vaio_1.jpg', 'description' => 'Sony Vaio description...'],
  ];
  */
  
  $productsX = array(); // array to store formatted results from DB (from controller)
  
  //getting results from DB to array in format => [ ['id'=>0, 'name'=> 'canon'], [], ]
  //We get from DB an array of object {$allDBProducts} and here convert to array of arrays[$productsX]. It is just another variation, we could use direct referring to array of object {$allDBProducts} like {$allDBProducts->l_name}, but in this case we have to rewrite the code below, as it was originally designed for array of arrays[$productsX] (as firstly I created artificial hardcoded array of arrays[$productsX]) 
  foreach($allDBProducts as $a){ 
	  $tempo = array();
	  $tempo['id'] = $a->l_id;
	  $tempo['name'] = $a->l_name;
	  $tempo['price'] = $a->l_price;
	  $tempo['image'] = $a->l_image;
	  $tempo['description'] = $a->l_descript;
	 // array_push($tempo['description'], $a->l_descript);
	  
	  array_push($productsX, $tempo ); //adds to final array
  }
  
  //var_dump($productsX);
  
  $_SESSION['productCatalogue'] = $productsX; //all products from DB to session
  
  ?>
  
  
  
      <div class="row shop-items">
	      <?php
		  //generate shop products, Loop ----------------------------------------------------------
	      for($i = 0; $i < count($productsX); $i++){
          
		       
			
		       
			   	
			echo '<div id="' . $productsX[$i]['id'] . '" class="col-sm-5 col-xs-12  list-group-item bg-success cursorX shadowX modal-trigger" data-toggle="modal" data-target="#myModal' . $i . '">' .  //data-toggle="modal" data-target="#myModal' . $i .   for modal
			       '<div class="col-sm-4 col-xs-3">' . $productsX[$i]['name'] . '</div>' . 
				   '<div class="col-sm-2 col-xs-2 word-breakX">' . $productsX[$i]['price']. '₴</div>' .
				   '<div class="col-sm-2 col-xs-3">' . $myInputModel->truncateTextProcessor($productsX[$i]['description'], 8) .  '</div>' .  	
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
						   <?php
						    //checks if this product already in the cart
						    if (isset($_SESSION['cart-simple-931t']) && isset($_SESSION['cart-simple-931t'][$productsX[$i]['id']])){
								echo "<p class='text-danger'>Already " . $_SESSION['cart-simple-931t'][$productsX[$i]['id']] . " items was added to the cart.</p>";
							} else {
							}
						   ?>
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
						  
						  <!--- Total product sum calculation (2x16.64=N) -->
						   <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Total</div>
						      <div class="col-sm-4 col-xs-9 shadowX"><span class="sum"></span></div> 
						  </div>
						  
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Image</div>
						      <div class="col-sm-8 col-xs-9"><?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay_Simple/' . $productsX[$i]['image'] , $options = ["id"=>"","margin-left"=>"","class"=>"my-one-modal","width"=>"","title"=>"product"]);?></div>
						  </div>  
					 
                     </div>
					 
					 <!--- Dublicate: Total product sum calculation (2x16.64=N) -->
					  <!--<div class="col-sm-12 col-xs-12">
					      <div class="col-sm-5 col-xs-2 shadowX"></div> 
						  
					      <div class="col-sm-3 col-xs-6 list-group-item ">
						      <span class="sum"></span>
						  </div>
					  </div>-->
						 
						 
						 
					 <!---------- Section ++button /form input/--button ------->
					 <div class="row">
					 
					     <!--- Empty div to keep distance -->
					     <div class="col-sm-4 col-xs-2"> 
						 </div>
					    
						
						<!--- Plus button -->
					     <div class="col-sm-1 col-xs-2"> 
						     <button type="button" class="btn btn-primary button-plus" data-priceX="<?=$productsX[$i]['price'];?>">+</button>
						 </div>
						 
						 
						
						 <!-- form with input -->
						 <div class="col-sm-2 col-xs-3">
					         <?php 
							 
							 //check if product already in cart, if Yes-> get its quantity, if no-. sets to 1
							 if (isset($_SESSION['cart-simple-931t']) && isset($_SESSION['cart-simple-931t'][$productsX[$i]['id']])){
							     $quantityX = $_SESSION['cart-simple-931t'][$productsX[$i]['id']]; //gets the quantity from cart
							 } else {
								 $quantityX = 1;
		                     }
							 
							 //Form with quantity input
					         $form = ActiveForm::begin(['action' => ['shop-liqpay-simple/add-to-cart'],'options' => ['method' => 'post', 'id' => 'formX'],]); 
                                 echo $form->field($myInputModel, 'yourInputValue')->textInput(['maxlength' => true,'value' => $quantityX, 'class' => 'item-quantity form-control'])->label(false); //product quantity input
                                 echo $form->field($myInputModel, 'productID')->hiddenInput(['value' => $productsX[$i]['id'],])->label(false); //product ID hidden input

							 ?>
								 
 	                             <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', 'Add to cart'), ['class' => 'btn btn-primary shadowX submitX rounded' , 'id'=>'']) ?>
                                 </div>
                             <?php ActiveForm::end(); ?>
						  </div>
						  
						  <!-- End form with input -->
						  
						  
						  <!--- Minus button -->
						  <?php
						  //getting flag, used to detect if product is already in cart
						  if (isset($_SESSION['cart-simple-931t']) && isset($_SESSION['cart-simple-931t'][$productsX[$i]['id']])){
							  $ifInCartFlag = " data-cartFlag ='true'";
						  } else {
							  $ifInCartFlag = " data-cartFlag ='false' ";
						  }
						  ?>
						  <div class="col-sm-1 col-xs-2"> 
						     <button type="button" class="btn btn-danger button-minus" data-priceX="<?php echo $productsX[$i]['price'].'"'; echo $ifInCartFlag; ?>>-</button>
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
  
   