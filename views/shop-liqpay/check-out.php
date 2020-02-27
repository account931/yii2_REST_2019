<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use app\assets\Shop_LiqPay_AssertOnly;   // use your custom asset
Shop_LiqPay_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the na

$this->title = 'Check-out';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	<?php
	if (isset($_SESSION['cart'])){
        echo "<p>Cart contains <b>" . count($_SESSION['cart']) . "</b> products</p>";
		var_dump($_SESSION['cart']);
		
		
	}
    ?>
	
	<?php
	

	
	

	
	if (!isset($_SESSION['cart'])){
		echo "<h2> So far the cart is empty, nothing to check-out <i class='fa fa-cart-arrow-down' aria-hidden='true'></i></h2>";
	} else {

	} //end else (if $_SESSION['productCatalogue'] is SET) of {if (!isset($_SESSION['productCatalogue']}
?>






	

</div>
