//Lazy Load (to use: 1.download js=> <script src="jquery.lazyload.js"></script> 2. use in html=> <img class="lazy" data-original="img/example1.jpg"; 3. use code below in js
//https://vash-webmaster.ru/2017/08/11/lazyload-js/
$(function() {
	
    $("img.lazy").lazyload({
		 effect : "fadeIn", //appear effect
         threshold : 10 //content will load only on scrolling down 10px
    });

});
//Lazy Load




//Js for front SHOP {Simple}, (main) part of the shop (page with products)
(function ($) {
    "use strict";
	
	
   
	
	 //==============================================
	 //on opening a modal pop-up (when u click a product), do reset any changes if they were applied early (e.g <button> css was changed)
	 $('.modal-trigger').on('click', function(){
		normalizeAddToCartButton();
	 });
	 
	 
	 
	 
	
	 //==================================================================
     //[ +/- num product ]*/
	
	//Plus ++
    $('.button-plus').on('click', function(){
		
		var numProduct = Number($(this).closest('div').next().find('input:eq(1)').val()); //gets current input quantity
		$(this).closest('div').next().find('input:eq(1)').val(Number(numProduct) + 1); //html new value++
		
		//var price = $(this).parent().parent().siblings().find('.price-x').html(); //gets price-x. Working, but reassigned to {data-priceX}
		var price = this.getAttribute("data-priceX"); //gets price from {data-priceX}
		console.log(price);
		calcPrice(numProduct+1, price);
		
		normalizeAddToCartButton()
    });
	
	 

	 
	  
	 
	//*==================================================================
	//Minus --
    $('.button-minus').on('click', function(){
		var numProduct = Number($(this).closest('div').prev().find('input:eq(1)').val()); //gets current input quantity
		
		if(numProduct == 0){
			return fallse;
		}
		
		if(numProduct <= 1){
			if(this.getAttribute("data-cartFlag")=="true"){ //if product was prev selected and now is in cartFlag
			    $('.submitX').html('Remove from cart?'); 
				$('.submitX').css('background', 'red'); //change button style 
			} else {
			    swal("Stop!", "Can't select zero items", "warning");
			    return false;
			}
		}
		
		$(this).closest('div').prev().find('input:eq(1)').val(numProduct - 1); //html new value--
		
		//var price = $(this).parent().parent().siblings().find('.price-x').html(); //gets the price from modal, price-x. Working, but reassigned to {data-priceX}
		var price = this.getAttribute("data-priceX"); //gets price from {data-priceX}
		
		
		
		calcPrice((numProduct-1), price); //quantity*price
    });
	
	
	 
	 //==================================================================
	 //calcs & html the amount of sum for all items, i,e 2x16.66 = N
	 function calcPrice(quant, itemPrice){
		//$('.sum').html(Number(quant) + ' item x ' + itemPrice + '₴ = ' + (quant*itemPrice).toFixed(2) + '₴' );
		  $('.sum').stop().hide(100,function(){ $(this).html( Number(quant) + ' item x ' + itemPrice + '₴ = ' + (quant*itemPrice).toFixed(2) + '₴'  )}).fadeIn(200);

	 }

	 
	
	//*==================================================================
	//on change the input, do recalculating
	//$('.item-quantity').on('change', function() {alert( "Handler." );});
	//$('.item-quantity').on('input', function(){ alert('changed input ') }); 
	//DOES NOT WORK!!!!!!!!
	$("body").on('DOMSubtreeModified', ".item-quantity", function() {
        alert('changed');
    });
	
	





	
	
	// Allow input digits only, using a RegExp. Actually id does not allow to print eaither int orstring
	  $('.item-quantity').keydown(function(e) { alert('OK2');
        //this.value = this.value.replace(/[^0-9]/g, '');
		
		var digits = /\D/g;		
		 if (digits.test(Number(this.value))){
              // Filter non-digits from input value.
              this.value = this.value.replace(/\D/g, ''); alert('Ok int');
          } else {
			  alert("NaN");
			  e.preventDefault();
		  }
    });
	
	
  //return normal text, bg and attribute to "Add to cart" button if it was changed by -- for instance when you  -- last item in modal window
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
	function normalizeAddToCartButton(){
		//$('.my-button-x').prop('disabled', false);
		$('.submitX').html('Add to cart');
		$('.submitX').css('background', '#717fe0');
    }
	
  
	  


})(jQuery);