<?php



use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\assets\Shop_LiqPay_Simple_AssertOnly;   // use your custom asset
Shop_LiqPay_Simple_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name
?>


	
	
<?php	
	


$this->title = 'Cart {Simple Version}';
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
	       echo \app\componentsX\views_components\LiqPay\ShopTimelineProgress::showProgress("Cart");
	?>
	
	<!--------------  END  Progress Status Icons by component ----------------->
	
	
	
	<hr>
	<p class="text-danger">LiqPay Shop => Simple version, more simple version of ShopLiqpay but without ajax, just php operating</p>
	<hr>

 <?php 
  //all products array, as if we get from DB
  $productsX = [
      ['id'=> 0, 'name'=> 'Canon camera', 'price' => 16.64, 'image' => 'canon.jpg', 'description' => '30 Mpx, 5kg'],
      ['id'=> 1, 'name'=> 'HP notebook',     'price' => 35.31, 'image' => 'hp.jpg', 'description' => '8Gb Ram, 500Gb SSD'],
	  ['id'=> 2, 'name'=> 'Iphone 3', 'price' => 75.00, 'image' => 'iphone_3.jpg', 'description' => 'TFT capacitive touchscreen, 3.5 inches, 16M colors, 2 Mpx '],
	  ['id'=> 3, 'name'=> 'Iphone 5', 'price' => 75.00, 'image' => 'iphone_5.jpg', 'description' => 'Front Pocket Jumper.....some description'],
	  
	  ['id'=> 4, 'name'=> 'Shirt in Stretch Cotton', 'price' => 2.66,  'image' => 'ipod_classic_3.jpg', 'description' => 'some description'],
	  ['id'=> 5, 'name'=> 'Pieces Metallic Printed', 'price' => 18.96, 'image' => 'samsung_sync.jpg', 'description' => 'some description'],
	  ['id'=> 6, 'name'=> 'Femme T-Shirt In Stripe', 'price' => 25.85, 'image' => 'samsung_tab_5.jpg', 'description' => 'some description'],
	  ['id'=> 7, 'name'=> 'T-Shirt with Sleeve',     'price' => 18.49, 'image' => 'sony_vaio_1.jpg', 'description' => 'some description'],
  ];
 
  
  $_SESSION['productCatalogue'] = $productsX; //all products from DB to session
  
  
  if ( !isset($_SESSION['cart-simple-931t']) || (count($_SESSION['cart-simple-931t']) == 0) ){
		echo "<h2> So far the cart is empty  <i class='fa fa-cart-arrow-down' aria-hidden='true'></i></h2>";
		echo "<i class='fa fa-question-circle-o' style='font-size:78px;color:red'></i>";
	} else {
  ?>
  
   
  
      <div class="row shop-items">
	     <div class="col-sm-12 col-xs-12 shadowX"><h3>You have <?=count($_SESSION['cart-simple-931t']);?> items in your cart </h3></div>
		 
		 <!-- THEAD -->
		 <div class="col-sm-12 col-xs-12  list-group-item shadowX">
		    <div class="col-sm-4 col-xs-3">Name</div>
			<div class="col-sm-2 col-xs-2">Image</div>
			<div class="col-sm-2 col-xs-2">Price</div>
			<div class="col-sm-2 col-xs-2">Quant</div>
			<div class="col-sm-2 col-xs-3">Sum</div>
		 </div>
		 <!-- End THEAD -->
	      
		  <!-------------------------------------- Foreach $_SESSION['cart'] to dispaly all cart products --------------------------------------------->
		  <?php
		  $i = 0;	
          $totalSum = 0;
		  
		  foreach($_SESSION['cart-simple-931t'] as $key => $value){
		      $i++;
			  
			  //find in $_SESSION['productCatalogue'] index the product by id
			  $keyN = array_search($key, array_keys($_SESSION['productCatalogue'])); //find in $_SESSION['productCatalogue'] index the product by id
										    						

			   	
			echo '<div id="' . $_SESSION['productCatalogue'][$keyN]['id'] . '" class="col-sm-12 col-xs-12  list-group-item bg-success cursorX" data-toggle="modal" data-target="#myModal' . $i . '">' .  //data-toggle="modal" data-target="#myModal' . $i .   for modal
			       '<div class="col-sm-4 col-xs-3">' . $_SESSION['productCatalogue'][$keyN]['name'] . '</div>' . //name
				   '<div class="col-sm-2 col-xs-2 word-breakX">'. 
				       Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay_Simple/' . $_SESSION['productCatalogue'][$keyN]['image'] , $options = ["id"=>"","margin-left"=>"","class"=>"my-one","width"=>"","title"=>"product"]).
                   '</div>' . 
				   '<div class="col-sm-2 col-xs-2 word-breakX">' . $_SESSION['productCatalogue'][$keyN]['price']. '₴</div>' .
				   '<div class="col-sm-2 col-xs-2">' . $_SESSION['cart-simple-931t'][$keyN] .  '</div>' .   //quantity	
				   '<div class="col-sm-2 col-xs-3">' . ($_SESSION['cart-simple-931t'][$keyN]*$_SESSION['productCatalogue'][$keyN]['price']) .  '₴</div>' .   //total sum for this product, price*quantity
				     
				 '</div>';
				 
			$totalSum+= $_SESSION['cart-simple-931t'][$keyN]*$_SESSION['productCatalogue'][$keyN]['price']; //Total sum for all products
		  }
		  ?>
	  </div> <!-- row shop-items -->
	  
	  
	  <!-- Total sum for all products -->
	  <div class="col-sm-12 col-xs-12 shadowX">
	      <h3>Total: </h3>
		  <h2><?=$totalSum;?> ₴</h2>
	  </div>
  
  
       <div class="col-sm-12 col-xs-12">
	     <hr>
	     <button class="btn btn-info btn-lg shadowX">Check-out</button>
	  </div>
  
  <?php
	} //end if Session Cart is not empty
  ?>
  
  </div>
  
   