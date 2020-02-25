<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use app\assets\Shop_LiqPay_AssertOnly;   // use your custom asset
Shop_LiqPay_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the na

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	<?php
	if (isset($_SESSION['cart'])){
        echo "<p>Cart contains <b>" . count($_SESSION['cart']) . "</b>products</p>";
		var_dump($_SESSION['cart']);
	}
    ?>
	
	<?php
	
	//var_dump($_SESSION['productCatalogue']);
	
	

	
	if (!isset($_SESSION['cart'])){
		echo "<h2> So far the cart is empty  <i class='fa fa-cart-arrow-down' aria-hidden='true'></i></h2>";
	} else {
	?>

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

      

       

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
								
								
								    <!------------------- Foreach ------------>
									<?php
									$i = 0;
									//for ($i = 0; $i < count($_SESSION['cart']); $i++) {
									foreach($_SESSION['cart'] as $key => $value){
									    $i++;
									?>
									
                                    <tr>
                                        <td class="cart_product_img">
                                            <a href="#"><img src="img/bg-img/cart1.jpg" alt="Product"></a>
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5> 
											    <?php
												$keyN = array_search($key, array_keys($_SESSION['productCatalogue'])); //find in $_SESSION['productCatalogue'] index the product by id
											    //echo "=> " .$keyN . " --- ";
											    echo $_SESSION['productCatalogue'][$keyN]['name'];
											    ?> 
											</h5>
                                        </td>
                                        <td class="price">
                                            <span> <?=$_SESSION['productCatalogue'][$keyN]['price'];?> </span>
                                        </td>
                                        <td class="qty">
                                            <div class="qty-btn d-flex">
                                                <p>Qty</p>
                                                <div class="quantity">
                                                    <span class="qty-minus" onclick='var effect = document.getElementById("qty<?=$i?>"); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;'><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                    <input type="number" class="qty-text" id="qty<?=$i?>" step="1" min="1" max="300" name="quantity" value="<?=$value;?>" />
                                                    
                                                     <span class="qty-plus" onclick='var effect = document.getElementById("qty<?=$i?>"); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;'><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
									<!--------------- END Foreach ------------------>
									<?php
									}
									?>
									
                                    
								
                                </tbody>
                            </table>
                        </div>
                    </div>
					
					
					<!-- fianl cart -->
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>$140.00</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>$140.00</span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="cart.html" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
					
					
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
	
	
	

<?php
	} //end else (if $_SESSION['productCatalogue'] is SET) of {if (!isset($_SESSION['productCatalogue']}
?>






	

</div>
