//used in cart operations
(function ($) {
    "use strict";
	

	calcAllSum();	
	
	
   // on click on ++ button in cart => sum all amount. Increment of quantity is performed in views/cart.php in in-line JS      
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
	 $('.my-cart-plus' ).on('click',function(e){
	     calcAllSum();	
	 });		 
	 
	
	

    
  // on click on -- button in cart => sum all amount. Decrement of quantity is performed in views/cart.php in in-line JS      
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
	 $('.my-cart-minus' ).on('click',function(e){
		calcAllSum();	
	 });		 
	 
	 
	 
	 
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
	 function calcAllSum(){
		 setTimeout(function(){  
		 
		 //set classes to var 
		var priceSpan = $(".priceX");
		var quantSpan = $(".my-quantity-field");
		
		 var sum = 0;
		
		for(var i = 0; i < priceSpan.length; i++){
			//alert( priceSpan[i].innerHTML);
			//alert(   $(quantSpan[i]).val());	
			var s = priceSpan[i].innerHTML * $(quantSpan[i]).val();
			sum+= s;
		}
		 sum = sum.toFixed(2);
		$("#finalSum").stop().fadeOut(200, function(){ $(this).html(sum + "₴")}).fadeIn(300); //with animation
		
		
		}, 200);
		
		
	 }
	 

})(jQuery);