//used in cart operations (++/--)
 
//MEGA FIX_1 must be applied => should change counting OBJECT length style from {temporaryJSCartArray.length} to {Object.keys(temporaryJSCartArray).length} as we count OBJECT not ARRAY;
//MEGA FIX_2 must be applied => in function calcAllSum() => To get values (price, quantity) should use not HTML tages ($(".priceX"), $(".my-quantity-field")) but JS OBJECT temporaryJSCartArray
	
(function ($) {
    "use strict";
	
	var temporaryJSCartArray; //temp array to hold in JS $_SESSION['cart']
	
	//check if $_SESSION['cart'] exists, i.e was passed from views/cart to Js var cartJS, cartJS type is OBJECT
	if (typeof cartJS != 'undefined') { 
	    temporaryJSCartArray = cartJS; 
		console.log(cartJS);
	} else {
		temporaryJSCartArray = []; //must be = {} // anyway it will never fire & will never be array type, as if $_SESSION['cart'] does not exist, it will display "So far, no products in cart"
	}	
	
    //calc and html the general amount of all cart products
	calcAllSum();	
	
	console.log(typeof temporaryJSCartArray); //it is objetc
	
	console.log('length ' + temporaryJSCartArray.length);
	console.log('Count JS Object ' + Object.keys(temporaryJSCartArray).length);
	
	
   // on click on ++ button in cart => sum all amount. 
   //Increment of quantity is performed in views/cart.php in in-line JS => FALSE. It was there, but no more => <span class="qty-plus  my-cart-plus" onclick='var effect = document.getElementById("qty<?=$i?>"); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;'><i class="fa fa-plus" aria-hidden="true"></i></span>
     
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
	 $('.my-cart-plus' ).on('click',function(e){    
	     var thisID = $(this).parent().attr('id'); //id of clicked, equals to id in $_SESSION['productCatalogue'] 
		 var curentInput  = $(this).prev(".qtyXX").val(); //gets the quantity of input value
		 //alert(curentInput);
		 //plus the quantity value ++
		 $(this).prev(".qtyXX").val( parseInt(curentInput) + 1); 
		 
		 //inject
		 var parentX = $(this).closest('tr'); //gets the parent <tr> to hide if click more than 0
		 var index = parentX.attr('id');
		 index = parseInt(index);
	     temporaryJSCartArray[index] =  parseInt(curentInput) + 1;
			
			
		 //change temporaryJSCartArray
		 //temporaryJSCartArray[parseInt(thisID)] =  parseInt(curentInput) + 1;
		 //console.log(temporaryJSCartArray);
		 
		 //re-calc all sum amount
	     calcAllSum();	
		 console.log(typeof temporaryJSCartArray);
	 });		 
	 
	
	

    
  // on click on -- button in cart => sum all amount. 
  //Decrement of quantity is performed in views/cart.php in in-line JS => FALSE. It was there, but no more => <span class="qty-plus  my-cart-plus" onclick='var effect = document.getElementById("qty<?=$i?>"); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) effect.value--;return false;'><i class="fa fa-plus" aria-hidden="true"></i></span>
        
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
	 $('.my-cart-minus' ).on('click',function(e){
	
	
		var curentInput  = parseInt($(this).next(".qtyXX").val()); //gets the quantity input value
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
				    //parentX.remove(); //remove closest('tr') from DOM
					
					//show sw alert with delay (in order for user to see remoning the <tr> from DOM firstly)
					//setTimeout(function(){  
                       swal("Shortlisted!", "1 Item is removed from your cart", "success");
					 //}, 4000);
					 
				   //re-Count quantity of products in cart in header
				   $("#countCart").html($(".priceX").length);
				   
				   //change temporaryJSCartArray
		           //temporaryJSCartArray[parseInt($(this).parent().attr('id')) ] =  parseInt(curentInput) - 1; //MEGA FIX here
				   console.log(typeof temporaryJSCartArray);
				   // temporaryJSCartArray.splice(parseInt($(this).parent().attr('id')), 1);
				   var index = parentX.attr('id'); //gets the <tr> id
				   index = parseInt(index);
                   alert(index + " " + temporaryJSCartArray[index]); 
					
				   delete temporaryJSCartArray[index] ; //temporaryJSCartArray is object
				   //mega fix
				   if(temporaryJSCartArray.length == 1){
					   temporaryJSCartArray = {};
				   }
				   
				   //delete temporaryJSCartArray['0'];
				   
				   //temporaryJSCartArray[index] = 0;
				  //temporaryJSCartArray.splice(0,1);
				  //temporaryJSCartArray.0 = undefined;
              
			       parentX.remove(); //remove closest('tr') from DOM
				   
		           console.log(temporaryJSCartArray);
				   console.log(temporaryJSCartArray.length);
				   console.log('Count JS Object ' + Object.keys(temporaryJSCartArray).length);
		 
				   
				   //re-calc all sum amount
		           calcAllSum(); //do here as swal is async
				   
				   //sendAjaxToRenewCart();
				   
				   
               } else {
                   swal("Cancelled", "You cancelled.", "error");
                   //e.preventDefault();
				   return false;
               }
            });	 
		} else {
		
		    //minus the quantity value --
		    $(this).next(".qtyXX").val( parseInt(curentInput) - 1); 
			
			var index = parentX.attr('id');
		    index = parseInt(index);
			temporaryJSCartArray[index] =  parseInt(curentInput) - 1;
			
			//change temporaryJSCartArray
		    //temporaryJSCartArray[parseInt( $(this).parent().attr('id')) ] =  parseInt(curentInput) - 1;
		    console.log(temporaryJSCartArray);
		 
		}
		
		
		 
		 
		//re-calc all sum amount
		calcAllSum();	
	 });		 
	 
	 
	



  //FALSE =>on closing the window or redirecting to check-out => save the cart to SESSION (in /shop-liqpay/cart only)
  //TRUE =>on clicking "Check-out button" => save the cart to SESSION (in /shop-liqpay/cart only)
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
   
    //$(window).on('beforeunload', function(){  
	 $('.my-check-out' ).on('click',function(e){
	   
	   e.preventDefault();
	   
	   var href = location.href;
	   
	   //make sure this js works in /shop-liqpay/cart only
	   if(href.split("/")[ href.split("/").length -1 ] == "cart"){  //gets the text after the last "/" in URL
	       swal("Leave the browser, going to check-out", "Redirecting", "error");
	       //save js cart to $_SESSION here.....
		   
		   sendAjaxToRenewCart();
	   }
    });
	


	
		 
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **     
      function sendAjaxToRenewCart(){
		   //ajax
		   var url = urlX + '/shop-liqpay/ajax-merge-js-cart-with-session'; //url from view/admin-panel
	      alert(JSON.stringify( temporaryJSCartArray));
		   // send  data  to  PHP handler  ************ 
           $.ajax({
              url: url,
              type: 'POST',
			  dataType: 'JSON', 
			  data: {
				  serverJSCart: JSON.stringify( temporaryJSCartArray) , //temporaryJSCartArray
				  },
	
              success: function(data) {
				   //console.log(data.final);
				   window.location.href = urlX + '/shop-liqpay/check-out'
				 
              },  //end success
			  error: function (error) {
				   alert(JSON.stringify(error, null, 4));
				   alert('merging JS cart with SEssion["cart"] failed');
				  //$(".all-6-month").stop().fadeOut("slow",function(){ $(this).html("Failed")}).fadeIn(2000);
              }	
          });
		   //ajax
	  }
	  
	  
	  
	  
	
  //calculates/sum all products price. To get values (price, quantity) should use not HTML tages ($(".priceX"), $(".my-quantity-field")) but JS OBJECT temporaryJSCartArray
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
	 
	 
	 
	 //!!!!!!! STOPPED HERE
	 //Don't let  cart quantity input change from keyboard pressing, only by ++/--
	 /*
	$('input[type="text"]#productQuantity').keydown(function(e) {
        e.preventDefault();
    });
	*/
	
	 

})(jQuery);