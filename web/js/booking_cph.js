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
	
	
	
	
	
	
	 //clicking on any 1 one single  month (any of 6 month)
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	 $(document).on("click", '.my-month', function() {      //for newly generated 
	 
	 
		  get_1_single_month(this); //pass this to get this attributes
		  
		  //Scroll to results in Mobile only
		  /*if(screen.width <= 640){ 
	           scrollResults(".single-clicked-month"); //scroll to div
		  }*/
		  
	 });
	
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	//function that draw 6 month with badges //onLoad sends ajax request to BookingCphControler->function actionAjax_get_6_month()
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	function get_6_month(){
		$(".loader").show(200); //show the loader
		
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
				$(".loader").hide(3000); //hide the loader
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
	
	function getAjaxAnswer_andBuild_6_month(dataX){ //dataX is an ajax result from a BookingCphControler/public function actionAjax_get_6_month() //ajax
		//alert(dataX.array_All_CountDays);
		
		//HTML This 1 current month
		var finalText = '';//'<div class="col-sm-3 col-xs-5 my-month badge badge1" id="0"><span class="v">Current</div>';
		
		//HTML other 
		for(var i = 0; i < dataX.array_All_CountDays.length; i++){
			finalText+= '<div class="col-sm-3 col-xs-5 my-month badge badge1"' + 
			            'data-badge="' + dataX.array_All_CountDays[i] +  //data badge (amount of booked days in month (round red circle))
						'" data-myUnix=' + dataX.array_All_Unix[i][0] + '/' + dataX.array_All_Unix[i][1] + //additional "data-myUnix" to keep Unix time of the 1st and last days of the formed month, i.e = 43643483/3647634
						' id=' + i + '> <span class="v">' + dataX.allMonths[i]  + '</span></div>';
		}
		

		
		//$('.badge:eq('+ i +')').attr('data-badge', dataX.array_All_CountDays[i]);	//assign interger to badge
		
		$(".all-6-month").stop().fadeOut("slow",function(){ $(this).html(finalText)}).fadeIn(2000);
		
		
		
		
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	
	
	
	//Function to draw one single month
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	 function get_1_single_month(thisX){
		 $(".loader").show(200); //show the loader
		 
		 var Unix = thisX.getAttribute("data-myUnix");
		 var firstDayUnix = Unix.split("/")[0];
		 var lastDayUnix = Unix.split("/")[1];
		 //alert(firstDayUnix);
		 
		 //getting the path to current folder with JS to form url for ajax, i.e /yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/booking-cph/ajax_get_6_month
		 var loc = window.location.pathname;
         var dir = loc.substring(0, loc.lastIndexOf('/'));
		 var urlX = dir + '/ajax_get_1_month';
		  //alert(urlX);
		
		 // send  data  to  PHP handler  ************ 
         $.ajax({
            url: urlX,
            type: 'POST',
			dataType: 'text' ,//'JSON', // without this it returned string(that can be alerted), now it returns object
			//passing the city
            data: { 
			    serverFirstDayUnix:firstDayUnix,
				serverLastDayUnix: lastDayUnix,
			},
            success: function(data) {
                // do something;
                $(".single-clicked-month").stop().fadeOut("slow",function(){ $(this).html(data)}).fadeIn(2000);
				//getAjaxAnswer_andBuild_1_month(data);
				$(".loader").hide(5000); //hide the loader
				scrollResults(".single-clicked-month"/*, ".parent()."*/); /*.single-clicked-month*///scroll to div. Put it here to ensure, that the div has been html-es, so it scroll directly to it, + make sure loader will visible
            },  //end success
			error: function (error) {
				$(".single-clicked-month").stop().fadeOut("slow",function(){ $(this).html("Failed")}).fadeIn(2000);
            }	
        });
	 }
	
	
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	
	
	//Click on a booked date
	 $(document).on("click", '.taken', function() {//this click is used to react to newly generated cicles;
	    alert("Sorry, this date is already booked");
	});
	
	
	
//========================================================================================================================










	
	
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