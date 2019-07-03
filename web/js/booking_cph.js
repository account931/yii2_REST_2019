$(document).ready(function(){

    //just for test
    for(i = 0; i < $('.badge').length; i++){
		var iter = (1 + i) * 7;
		var b = i;
        $('.badge:eq('+ b +')').attr('data-badge', iter);	//assign interger to badge
	}
	
	
	
	
	 //clicking on any month
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	 $(document).on("click", '.my-month', function() {      //for newly generated 
	 
	     //Scroll to results in Mobile only
		  if(screen.width <= 640){ 
	           scrollResults(".single-clicked-month"); //scroll to div
		  }
		  
		  
	      //alert(this.id);
		  var idX = this.id;
		  $(".single-clicked-month").stop().fadeOut("slow",function(){  $(this).html( idX ) }).fadeIn(2000);
	 });
	
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// Advanced Scroll the page to results  #resultFinal
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	function scrollResults(divName, parent)  //arg(DivID, levels to go up from DivID)
	{   //if 2nd arg is not provided while calling the function with one arg
		if (typeof(parent)==='undefined') {
		
            $('html, body').animate({
                scrollTop: $(divName).offset().top
                //scrollTop: $('.your-class').offset().top
             }, 'slow'); 
		     // END Scroll the page to results
		} else {
			//if 2nd argument is provided
			var stringX = "$(divName)" + parent + "offset().top";  //i.e constructs -> $("#divID").parent().parent().offset().top
			$('html, body').animate({
                scrollTop: eval(stringX)         //eval is must-have, crashes without it
                }, 'slow'); 
		}
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	 // **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	
	function scroll_toTop() 
	{
	    $("html, body").animate({ scrollTop: 0 }, "slow");	
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
});
// end ready	
	