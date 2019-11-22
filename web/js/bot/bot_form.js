(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
	
	

	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	
	   //when u click OK in form
      $(document).on("click", '#sayButton', function() {   // this  click  is  used  to   react  to  newly generated cicles; //#myForm
     //$("#myForm").on("beforeSubmit", function (event, messages) {
      
	   //append your text to chat flow
	   youSay();
	   
       //Checking validation
       var form = $(this);
	   if (form.find('.has-error').length ) {  //if validation failed
	   
	       alert("Validate failed"); 
		   return false;  //prevent submitting and reload
	   
       //if validation is OK	   
	   } else { 
	   
	        //alert("Validate OK");  /*alert(<?php echo Yii::$app->request->baseUrl?> +"/products/getajaxorderdata" );*/
		    // runs ajax here

			
			// Start AJAX $URL = Yii::$app->request->baseUrl . "/site/ajax-rbac-insert-update";   //WORKING,  gets the url to send ajax, defining it in  $ajax causes routing to 404, Not found, as the url address does not render correctly
            $.ajax({
		        url: urlXX,  //WORKING. Passed from views/bot/bot-view.php
				//url: form.attr('getajaxorderdata'),
                
                type: 'post',
				// dataType : "html",
				dataType:'json', // use JSON
               
			    //passing the data to ajax
				data: {
					serverMessageX : $("#txtMsg").val(),
                    //controller : '$Controller ',
				    //_csrf : '<?= Yii::$app->request->csrfToken; ?>',
				    //selectValue : $(this).closest("form").find(":selected").val(), // $(this).find(":selected").val(),  //value of nearest <select> to clicked button
					//userID: $(this).attr('id'), //$(this).find("input[type=submit]").attr('id'),  //user ID
                },
				
				//if send was successful
                success: function(res){
                    console.log(res);
					console.log(res.botreply);
				    //alert(res.result_status);
			       
				     //append bot answer to chat flow
				     botReply(res, null);
					
					
                },
                error: function(errX){
                     //alert(JSON.stringify(errX, null, 4));//alert('Error from actionAjaxReply()!' + errX);   //alert(JSON.stringify(errX, null, 4)
					//swal("Sorry!", "Server crashed!", "error"); //sweet alert
					botReply(null, "Sorry, the server crashed, try again in 1 minute.");
                }
            });
			// END runs AJAX here
		    return false; //prevent reloading/submitting the form
		  
	   } // end else
  });


	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************

	   
	   
	
	
	
	
	
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function scroll_toBottom() 
	{
	    //$("#allMsg").animate({ scrollBottom: 0 }, "slow");
        var objDiv = document.getElementById("allMsg");
        objDiv.scrollTop = objDiv.scrollHeight;		
	}
	
	
	
	
	
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	
	 function getCurrentTime(){
		var time = "<span class='time'>" + new Date().getHours() + ":" + new Date().getMinutes() + ":" + new Date().getSeconds() + "</span> ";  //current time
		return time;
	 }
	
	
	
	
	
	
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function youSay(){
	  //appends your text to chat 
	   var tt =  getCurrentTime() + "<span class='youText'><i class='fa fa-address-book-o'></i> You: " + $("#txtMsg").val() + "</span><hr>";
	   //$("#allMsg").stop().fadeOut("slow",function(){$(this).append(tt)}).fadeIn(1000);
	   $("#allMsg").append(tt);
	} 
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************

	
	
	
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	function botReply(resss, textX){
		if(textX == null){ //if 2nd arg is not given, meaning that ajax was performed OK-> just give an naswer from BotController/actionAjaxReply()
	        //append bot answers to chat => time/bot/answer
		    var tt =  $( getCurrentTime() + "<span class='botText'><i class='fa fa-graduation-cap'></i> Bot: "  + resss.botreply + "</span><hr>").hide(); //to append with animation, firstly hide it 
		    //$("#allMsg").stop().fadeOut("slow",function(){$(this).append(tt)}).fadeIn();
		} else { //if 2nd arg is given, meaning that ajax crashed & this funct is called from  error: function(errX){ => show error message
			var tt =  $( getCurrentTime() + "<span class='botText'><i class='fa fa-graduation-cap'></i> Bot: <i class='	fa fa-warning'></i> "  + textX + "</span><hr>").hide(); //to append with animation, firstly hide it 
		}

        $("#allMsg").append(tt); //to append with animation
        tt.show(1000); //to append with animation
					
		setTimeout(scroll_toBottom, 0); 
        $("#txtMsg").val('');//reset the input
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)