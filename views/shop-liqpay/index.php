<?php

/* @var $this yii\web\View */
// shop uses 2 $_SESSION vars =>  
//    a.) $_SESSION['productCatalogue'] => contains array of all products (extracted from DB table) (see example at viws/shop-liqpay/index)
//    b.) $_SESSION['cart'] => contains all products a user selected to buy (in format of assoc array('PRODUCR_ID1'=> 5, 'PRODUCR_ID2'=> 3, ))

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\assets\Shop_LiqPay_AssertOnly;   // use your custom asset
Shop_LiqPay_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name
?>


<!-- <div class="panel panel-primary">
      <div class="panel-heading">Panel with panel-primary class</div>
 </div>-->
	
	
	
<?php	
	


$this->title = 'Shop Liq E-pay';
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
		if (isset($_SESSION['cart'])) { 
		    $c = count($_SESSION['cart']); 
		} else { 
			    $c = 0; 
		} ?>
		
		<div class="col-sm-2 col-xs-2 badge1 bb" data-badge="<?php echo $c; ?> ">
		    <?php echo Html::a( '<i class="fa fa-cart-plus fa-4x" aria-hidden="true"></i>', ["/shop-liqpay/cart"], $options = ["title" => "Cart"]); ?>

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
	<p class="text-danger">Stopped: to continue with do => </p>
	<p class="text-danger">#onModal window click - add product to Session Cart</p>
	<p class="text-danger">#implement Cart (amado template), check-out and LiqPay billing + add lazyLoad</p>
	<hr>

 <?php 
  //all products array, as if we get from DB
  $productsX = [
      ['id'=> 0, 'name'=> 'Esprit Ruffle Shirt', 'price' => 16.64, 'image' => 'product-01.jpg', 'description' => 'Esprit Ruffle Shirt.....some description'],
      ['id'=> 1, 'name'=> 'Herschel supply',     'price' => 35.31, 'image' => 'product-02.jpg', 'description' => 'Herschel supply.........some description'],
	  ['id'=> 2, 'name'=> 'Classic Trench Coat', 'price' => 75.00, 'image' => 'product-03.jpg', 'description' => 'Classic Trench Coat.....some description'],
	  ['id'=> 3, 'name'=> 'Front Pocket Jumper', 'price' => 75.00, 'image' => 'product-05.jpg', 'description' => 'Front Pocket Jumper.....some description'],
	  
	  ['id'=> 4, 'name'=> 'Shirt in Stretch Cotton', 'price' => 2.66,  'image' => 'product-04.jpg', 'description' => 'some description'],
	  ['id'=> 5, 'name'=> 'Pieces Metallic Printed', 'price' => 18.96, 'image' => 'product-06.jpg', 'description' => 'some description'],
	  ['id'=> 6, 'name'=> 'Femme T-Shirt In Stripe', 'price' => 25.85, 'image' => 'product-07.jpg', 'description' => 'some description'],
	  ['id'=> 7, 'name'=> 'T-Shirt with Sleeve',     'price' => 18.49, 'image' => 'product-08.jpg', 'description' => 'some description'],
  ];
 
  
  $_SESSION['productCatalogue'] = $productsX; //all products from DB to session
  
  
  
  //passing PHP variable {$productsX } to javascript -> 
        use yii\helpers\Json; 
		 $this->registerJs(
            "var productsJS = ". Json::encode($productsX).";",  
             yii\web\View::POS_HEAD, 
            'myproduct-events-script'
     );
	 
	   //passing PHP variable {currentURL} to javascript ->  
	     $urll = Yii::$app->getUrlManager()->getBaseUrl();
		 $this->registerJs(
            "var urlX = ". Json::encode($urll).";",  
             yii\web\View::POS_HEAD, 
            'myproduct2-events-script'
     );
	 
	 if (isset($_SESSION['cart'])){
	     //passing PHP variable {$_SESSION['cart']} to javascript -> 
		 $this->registerJs(
            "var cartJS = ". Json::encode($_SESSION['cart']).";",  
             yii\web\View::POS_HEAD, 
            'myproduct-events-script55'
         ); 
	 }
  ?>
  
  
  
  
   <div class="row isotope-grid">
    <?php
	  //generate shop products, Loop ----------------------------------------------------------
	  for($i = 0; $i < count($productsX); $i++){
    ?>
	
	     	
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
						
							<!--<img src="images/shopLiqPay/product-01.jpg" alt="IMG-PRODUCT">-->
							<?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay/' . $productsX[$i]['image'] , $options = ["id"=>"","margin-left"=>"","class"=>"my-one","width"=>"","title"=>"product"]); ?>

							<!--  Quick view on hover only -->
							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 my-for-desktop" id= <?=$productsX[$i]['id']?> >
								Quick View
							</a>
							
							<!-- Constant Quick view, to use more smooth, comment onHover "Quick View" () -->
							<!--<a href="#" style="position:absolute;bottom:20px" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 my-for-mobile" id= <?=$productsX[$i]['id']?> >
								Quick View(cell)
							</a>-->
							
		
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 my-trigger">
								
									<!--Esprit Ruffle Shirt-->
									<?=$productsX[$i]['name']?>
									
								</a>

								<span class="stext-105 cl3">
									<!--$16.64-->
									<?=$productsX[$i]['price'] ."₴"?>
									
								</span>
							</div>
							

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<!--<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">-->
									<!--<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">-->
									<?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay/icons/icon-heart-01.png' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"product"]); ?>
									<?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay/icons/icon-heart-02.png' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"product"]); ?>
								</a>
							</div>
							
							
						</div>
					</div>
				</div>
	      
	<?php
	  }  //end for
	?>
	 </div>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


<?php
/*

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->


	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
*/
	?>

	
	
	
	
	
	
</div><!-- ENF of View div-->
















<!-- Hidden Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
				    
					<!--<img src="images/icons/icon-close.png" alt="CLOSE">-->
					<?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay/icons/icon-close.png' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"product"]); ?>
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
								
								
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
									    
										<!-- My Cart status ()was selected prev/was nor selected prev -->
										<span class="text-danger small" id="cartStatus"></span>
										<!-- My Cart status -->
										
										<div class="wrap-pic-w pos-relative">
										    
											<!-- Core modal image!!!!! -->
											<!--<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">-->
											<?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay/product-05.jpg' , $options = ["id"=>"hiddenModal_Image","margin-left"=>"","class"=>"s","width"=>"","title"=>"product"]); ?>

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
										
										    <!--  modal sub detail image -->
											<!--<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">-->
											<?php //echoHtml::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay/product-detail-02.jpg' , $options = ["id"=>"","margin-left"=>"","class"=>"","width"=>"","title"=>"product"]); ?>

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="#"> <!-- images/product-detail-02.jpg -->
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<!--<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">-->

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="#"> <!-- images/product-detail-03.jpg -->
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14" id="hiddenModal_Product">
								Lightweight Jacket <!-- changes with JS -->
							</h4>

							<span class="mtext-106 cl2" id="hiddenModal_Price">
								$58.79  <!-- changes with JS -->
							</span>

							<p class="stext-102 cl3 p-t-23" id="hiddenModal_Description">
							    <!-- changes with JS -->
								Any text, will be changed with JS on modal click.
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								
								
								
								<!----------------------- ++/-- buttons ------------------------>
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										
										    <!-- minus button -->
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus my-minus" >-</i>
											</div>

											<?php
											/*
											// Description is FALSE, all is dine in main.js
											//check if product already exist in $_SESSION['cart'], i.e was selected previously, so html quanity from $_SESSION['cart']
											$keyN = array_key_exists(0, $_SESSION['cart']); //array_search($i, $_SESSION['cart']);
											if($keyN){
												$valueX = $_SESSION['cart'][0];
											} else {
											    $valueX = 1;
											}
                                            */
											?>
											
											<!----------------------- Quantity ------------------------>
											<input class="mtext-104 cl3 txt-center num-product" id="productQuantity" type="number" name="num-product" value="">
                                            
											
											<!-- + button -->
											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus">+</i>
											</div>
										</div>

										
										
										
										
										<!-------------------  Mine => Totall for {4} items is {457 UAH}, htmled in main.js ----------------------->
								        <div class="totalZ col-sm-12">
								            <!--Total for <span id="quantX">0</span> items is <span id="totalX">0</span> ₴-->
								        </div><br>
										<!---------------- END Mine => Totall for {4} items is {457 UAH}, htmled in main.js ----------------------->
										
										
										
										
										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail assign-id my-button-x" >
											Add to cart
										</button>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Hidden Modal1 -->
