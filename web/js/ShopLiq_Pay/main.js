//Js for front SHOP, (main) part of the shop (page with products)
(function ($) {
    "use strict";
	
	//array productsJS (js array to contain all DB products) is passed php array with products (from DB) (from view/index.php)
	
	window.id;
	var temporaryJSCartArray; //temp array to hold in JS $_SESSION['cart']
	
	//check if $_SESSION['cart'] exists, i.e was passed from views/cart to Js var cartJS
	if (typeof cartJS != 'undefined') { 
	    temporaryJSCartArray = cartJS; 
		console.log(cartJS);
	} else {
		temporaryJSCartArray = [];
	}
	
	
	
	 /*==================================================================
    [  onClick "Quick View" Show modal1 & html clicked products details in modal, i.e onClick gets id of clicked that is equal to php $productsX[id]; and $productsX[id] is passed to JS from view/index.php]*/
    $('.js-show-modal1' /*, .my-one*/).on('click',function(e){ 
        e.preventDefault();
        $('.js-modal1').addClass('show-modal1');
		
		var idX = this.id; //id of clicked product
		window.id = idX;
		console.log(urlX);
		//var productsJS is passed php array with products (from view/index.php)
		//var urlX is passed php array with products (from view/index.php)

		$("#hiddenModal_Product").stop().fadeOut("slow",function(){ $(this).html(productsJS[idX].name)}).fadeIn(2000); //with animation
		$("#hiddenModal_Price").html(productsJS[idX].price + " ₴"); //html the price
		$("#hiddenModal_Description").html(productsJS[idX].description);  
		$("#hiddenModal_Image").attr("src", urlX + "/images/shopLiqPay/" + productsJS[idX].image); //with animation
		//$("#hiddenModal_Image").attr("src", urlX + "/images/shopLiqPay/" + productsJS[idX].image);
		//adding id to button
		 $(".assign-id").attr("id",productsJS[idX].id);
		 
		 //sets ID of product to <i> with minus -- (in modal window)
		 $(".my-minus").attr('data-idd', this.id);
		 
		 //return normal text, bg and attribute to "Add to cart" button if it was changed by -- for instance when you  -- last item in modal window
		 normalizeAddToCartButton();
		 
		//html the quanity/amount of product in modal pop-up window, based on $_SESSION['cart']. On success calculate and html Total price {Total for 4 items is 300.00 ₴}
		GetQuantity(idX);  
		
    });

	
	//Button to close the modal
    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });

	
	
	
	
	
	
	
	 /*==================================================================
    [ Adds product to cart via ajax, triggered onClick button in modal pop-up window]*/
    $('.js-addcart-detail').on('click',function(){ 
	    sendAjaxAddProduct($(this));
        
    });
	
	
	
	
	
	
	
	
	//NOT USED???????
    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){ alert(45);
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){ alert(46);
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){ alert(47);
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){ alert(48);
        $('.js-sidebar').removeClass('show-sidebar');
    });

	
	
	
	
	
    /*==================================================================
    [ +/- num product ]*/
	
	//Minus --
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
		
		if(numProduct == 1){ 
			if (typeof temporaryJSCartArray[ parseInt($(".my-minus").attr("data-idd")) ] != 'undefined'){ //if it is in cart
			    swal("Last item!", "Careful, you are about do delete this product from cart", "warning");
				$('.my-button-x').html('Remove from cart'); $('.my-button-x').css('background', 'red'); //change button style 
			} else {
				swal("Stop!", "Can't select zero items", "warning");
				return false;
			    //disableAddToCartButton();
				
			}
		}
		
		//if current quantity more than zero
        if(numProduct > 0){
		   $(this).next().val(numProduct - 1);
		   //mine
		   $('#quantX').html(numProduct - 1);
		   $('#totalX').html( ((numProduct - 1) * productsJS[window.id].price).toFixed(2)); //.toFixed(2) -> rounds 2.005 to 2.01 //Total for 2 items is 70.62 ₴
		}
		
		
    });
	
	
    
	//Plus ++
    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
		//mine
		
		$('.totalZ').html('Total for <span id="quantX">0</span> items is <span id="totalX">0</span> ₴');
		$('#quantX').html(numProduct + 1);
		$('#totalX').html(((numProduct + 1) * productsJS[window.id].price).toFixed(2));
		
		//return normal text, bg and attribute to "Add to cart" button if it was changed by --
		normalizeAddToCartButton();
		
    });

	
	
	
   
	
	
	
	
  //send ajax to add a selected product to $_SESSION['cart'], triggered in modal window 	     
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
	
	 function sendAjaxAddProduct(thisX){
          
		  var url = urlX + '/shop-liqpay/add-product-to-cart'; //url from view/admin-panel
	      alert(thisX.attr('id') + " " + $('#productQuantity').val() );
		   // send  data  to  PHP handler  ************ 
           $.ajax({
              url: url,
              type: 'POST',
			  dataType: 'JSON', 
			  data: {
				  serverID: thisX.attr('id'), //product ID
				  serverQuantity: $('#productQuantity').val() //product quantity
				  },
	
              success: function(data) {
				  if(parseInt($('#productQuantity').val()) > 0 ){ //if user selected 1 or more products in modal
				      swal("!", "Added to cart => " + productsJS[data.id].name + " => " + data.quantity + " items", "success"); //sweet alert
				  } else { //if user selected '0' products, which is only possible if this product was added to cart earlier, otherwise user can't decrement -- further than "1"
					  swal("!", "Removed from cart", "warning"); //sweet alert
					  $('.js-modal1').removeClass('show-modal1'); //hide the modal
					  
				  }
				  
				  //if php script {add-product-to-cart} returns length of Session['cart'] more than zero
				  if(data.count > 0){
			          $('.bb:eq(0)').attr('data-badge', data.count); //$('.badge1:eq(0)').stop().fadeOut("slow",function(){ $(this).attr('data-badge', data.count) }).fadeIn(2000);   
		         } else {
		             $('.bb:eq(0)').attr('data-badge', -0);
		         }
				 
				 
				 //!!!!!!Mega FIX HERE !!!!!!!!!!!!!!!!
				 //renew JS var temporaryJSCartArray (otherwise modal window displays old value)
				 if(parseInt($('#productQuantity').val()) > 0 ){ //if user selected 1 or more products in modal
				     temporaryJSCartArray[thisX.attr('id')] = $('#productQuantity').val();
				     $("#cartStatus").html('Product was already selected. You picked ' + $('#productQuantity').val() + ' items.');  //Don't need it??? => FALSE, WE NEED IT!!!!!  Should be used in GetQuantity(idX) only, when u click a single product and modal windows pop-up
				 } else { //if user selected '0' products, which is only possible if this product was added to cart earlier, otherwise user can't decrement -- further than "1"
				     delete temporaryJSCartArray[parseInt(thisX.attr('id'))]; //remove product from cart JS object
				 }
				 
              },  //end success
			  error: function (error) {
				   alert(JSON.stringify(error, null, 4));
				  alert('messages ajax failed');
				  //$(".all-6-month").stop().fadeOut("slow",function(){ $(this).html("Failed")}).fadeIn(2000);
              }	
          });
	 }
	
	
	
	
	
	
	
  //html the quanity in modal window, based on $_SESSION['cart']. On success calculate and html Total price {Total for 4 items is 300.00 ₴}
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
	
	 function GetQuantity(idX){
          
		  $('#productQuantity').val("");
		  
		  /*
		  var url = urlX + '/shop-liqpay/get-quantity-for-modal'; //url from view/admin-panel
	      //alert(url);
		   // send  data  to  PHP handler  ************ 
           $.ajax({
              url: url,
              type: 'POST',
			  dataType: 'JSON', 
			  data: {
                  serverID: idX, //product ID				  
				  },
	
              success: function(data) {
				  //alert(data.quantityX);
				  $("#productQuantity").stop().fadeOut(200, function(){ $(this).val(data.quantityX)}).fadeIn(400); //html quantity with animation

				  
				  //html Total price {Total for 4 items is 300.00 ₴}
		          var q = data.quantityX;
		          var amount =(data.quantityX * productsJS[idX].price).toFixed(2);
		          $('.totalZ').stop().fadeOut(200, function(){ $(this).html('Total for <span id="quantX">' + q + '</span> items is <span id="totalX">' + amount + '</span> ₴')}).fadeIn(400); //with animation
	 
	
	
              },  //end success
			  error: function (error) {
				   alert(JSON.stringify(error, null, 4));
				  alert('GetQuantity ajax failed');
				  //$(".all-6-month").stop().fadeOut("slow",function(){ $(this).html("Failed")}).fadeIn(2000);
              }	
          });
		  */
		  
		 //new version (without ajax)
         if (typeof temporaryJSCartArray[idX] != 'undefined'){
		     var quant = temporaryJSCartArray[idX]; //gets the quantity from $_SESSION
			 $("#cartStatus").html('Product was already selected. You picked ' + quant + ' items.');
         } else {
			 var quant = 1;
			  $("#cartStatus").html('New product, you did not select it prev');
		 }
		
         $("#productQuantity").stop().fadeOut(200, function(){ $(this).val( quant ) }).fadeIn(400); //html quantity with animation
		 
		 //html Total price in Modal{Total for 4 items is 300.00 ₴}
		 var q = quant;
		 var amount =(q * productsJS[idX].price).toFixed(2);
		 $('.totalZ').stop().fadeOut(200, function(){ $(this).html('Total for <span id="quantX">' + q + '</span> items is <span id="totalX">' + amount + '</span> ₴')}).fadeIn(400); //with animation
	 
		   
	 }
	
	
	
	
	
	
	   //onClick on product name do the same as on image hover  !!!! NOT WORKING
	    $('.my-trigger').on('click', function(event){
			event.preventDefault();
        /*
			var value = 1.1;
			
			//$('.hov-img0').find("img").css({   
			$(this).parent().find('img').css({
              '-webkit-transform' : 'scale(' + value + ')',
              '-moz-transform'    : 'scale(' + value + ')',
              '-ms-transform'     : 'scale(' + value + ')',
              '-o-transform'      : 'scale(' + value + ')',
              'transform'         : 'scale(' + value + ')'
            });
		*/

		});
	
	
	
	
	
	
	
	//return normal text, bg and attribute to "Add to cart" button if it was changed by -- for instance when you  -- last item in modal window
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
	function normalizeAddToCartButton(){
		$('.my-button-x').prop('disabled', false);
		$('.my-button-x').html('Add to cart');
		$('.my-button-x').css('background', '#717fe0');
    }
	
	
	
	
   //disable the  "Add to cart" button, for instance when you  -- last item in modal window
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
	function disableAddToCartButton(){
		$('.my-button-x').prop('disabled', true);
		$('.my-button-x').html('Disabled');
		$('.my-button-x').css('background', 'red');
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    /*[ Load page ]
    ===========================================================*/
    /*
	$(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });
	*/
    
    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }
    

    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0); 
    }  
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0); 
        }  
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
        } 
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });
                
        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });
        
    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

	
	
	
	
	
	
	
    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }    
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }    
    });




	
	
	
    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });
    
	
	



})(jQuery);