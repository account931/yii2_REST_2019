(function(){ //START IIFE (Immediately Invoked Function Expression)
$(document).ready(function(){

    //just for test, fillbadges with random numbers
	/*
    for(i = 0; i < $('.badge').length; i++){
		var iter = (1 + i) * 7;
		var b = i;
        $('.badge:eq('+ b +')').attr('data-badge', iter);	//assign interger to badge
	}
	*/
	
	
	
	//onLoad sends ajax request to BookingCphControler->function actionAjax_get_6_month()
	get_6_month();
	
	
	
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
	
	
	
	
	
	
	
	//function that draw 6 month with badges //onLoad sends ajax request to BookingCphControler->function actionAjax_get_6_month()
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	function get_6_month(){
		
		//getting the path to current folder with JS to form url for ajax, i.e /yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/booking-cph/ajax_get_6_month
		var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/'));
		var urlX = dir + '/ajax_get_6_month';
		//alert(urlX);
		
		// send  data  to  PHP handler  ************ 
        $.ajax({
            url: urlX,
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
			//passing the city
            data: { 
			    //serverCity:window.cityX
			},
            success: function(data) {
                // do something;
                //$(".all-6-month").stop().fadeOut("slow",function(){ $(this).html("OK")}).fadeIn(2000);
				getAjaxAnswer_andBuild_6_month(data);
            },  //end success
			error: function (error) {
				$(".all-6-month").stop().fadeOut("slow",function(){ $(this).html("Failed")}).fadeIn(2000);
            }	
        });
                                       
	}
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	
	//Function to use in ajax SUCCESS section in function get_6_month(){
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function getAjaxAnswer_andBuild_6_month(dataX){
		//alert(dataX.array_All_CountDays);
		
		//HTML This 1 current month
		var finalText = '';//'<div class="col-sm-3 col-xs-5 my-month badge badge1" id="0"><span class="v">Current</div>';
		
		//HTML other 
		for(var i = 0; i < dataX.array_All_CountDays.length; i++){
			finalText+= '<div class="col-sm-3 col-xs-5 my-month badge badge1" data-badge="' + dataX.array_All_CountDays[i] + '" id='+ i + '> <span class="v">' + dataX.allMonths[i]  + '</span></div>';
		}
		

		
		//$('.badge:eq('+ i +')').attr('data-badge', dataX.array_All_CountDays[i]);	//assign interger to badge
		
		$(".all-6-month").stop().fadeOut("slow",function(){ $(this).html(finalText)}).fadeIn(2000);
		
		
		
		
	}
	
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
	
	
}()); //END IIFE (Immediately Invoked Function Expression)