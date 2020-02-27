//used in cart operations (++/--)
 
	 
(function ($) {
    "use strict";
	

	calcAllSum();	
	
	
   // on click on ++ button in cart => sum all amount. 
   //Increment of quantity is performed in views/cart.php in in-line JS => FALSE. It was there, but no more => <span class="qty-plus  my-cart-plus" onclick='var effect = document.getElementById("qty<?=$i?>"); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;'><i class="fa fa-plus" aria-hidden="true"></i></span>
     
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
	 $('.my-cart-plus' ).on('click',function(e){
		 var curentInput  = $(this).prev(".qtyXX").val(); //gets the quantity input value
		 //alert(curentInput);
		 //plus the quantity value ++
		 $(this).prev(".qtyXX").val( parseInt(curentInput) + 1); 
		 
		 //re-calc all sum amount
	     calcAllSum();	
	 });		 
	 
	
	

    
  // on click on -- button in cart => sum all amount. 
  //Decrement of quantity is performed in views/cart.php in in-line JS => FALSE. It was there, but no more => <span class="qty-plus  my-cart-plus" onclick='var effect = document.getElementById("qty<?=$i?>"); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) effect.value--;return false;'><i class="fa fa-plus" aria-hidden="true"></i></span>
        
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
	 $('.my-cart-minus' ).on('click',function(e){
	
	
		var curentInput  = $(this).next(".qtyXX").val(); //gets the quantity input value
		var parentX = $(this).closest('tr'); //gets the parent <tr> to hide if click more than 0
		if(curentInput == 0 ){return false;} //don't go futher than 0
		
		//if user clicks when quantity value is 1 
		if(curentInput == 1 ){
			
			swal({
                title: "Are you sure to delete this product from cart?",
                text: "The product will be removed from your cart!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
           },
           function(isConfirm){
               if (isConfirm){
				    parentX.remove(); //closest('tr')
                   swal("Shortlisted!", "Item is removed from your cart", "success");
				   //re-calc all sum amount
		           calcAllSum(); //do here as swal is async
               } else {
                   swal("Cancelled", "You cancelled.", "error");
                   //e.preventDefault();
				   return false;
               }
            });	 
		} else {
		
		    //minus the quantity value --
		    $(this).next(".qtyXX").val( parseInt(curentInput) - 1); 
		}
		
		//re-calc all sum amount
		calcAllSum();	
	 });		 
	 
	 
	




  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
    //on closing the window or redirecting to check-out => save the cart to SESSION
    $(window).on('beforeunload', function(){
	   alert ('Bye now');
	   swal("Leave the browser", "Redirecting", "error");
	   //save js cart to $_SESSION here.....
    });
	


	
	 
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
	 function calcAllSum(){
		 //setTimeout(function(){  
		 
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
		$("#finalSum").stop().fadeOut(100, function(){ $(this).html(sum + "₴")}).fadeIn(100); //with animation
		
		
		//}, 200);
		
		
	 }
	 

})(jQuery);