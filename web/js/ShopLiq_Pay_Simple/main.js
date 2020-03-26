//Js for front SHOP {Simple}, (main) part of the shop (page with products)
(function ($) {
    "use strict";
	
	
	
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
    });
	
	 

	 
	 
	 
	//*==================================================================
	//Minus --
    $('.button-minus').on('click', function(){
		var numProduct = Number($(this).closest('div').prev().find('input:eq(1)').val()); //gets current input quantity
		if(numProduct <= 1){
			swal("Stop!", "Can't select zero items", "warning");
			return false;
		}
		
		$(this).closest('div').prev().find('input:eq(1)').val(numProduct - 1); //html new value--
		
		//var price = $(this).parent().parent().siblings().find('.price-x').html(); //gets the price from modal, price-x. Working, but reassigned to {data-priceX}
		var price = this.getAttribute("data-priceX"); //gets price from {data-priceX}
		calcPrice((numProduct-1), price);
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
  
	  


})(jQuery);