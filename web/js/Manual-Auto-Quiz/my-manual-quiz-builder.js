//used in my-manual-quiz-builder

//ReadMe
//Multi steps quiz form content is loaded to <div id="quizDiv"> by JS ajax in (my-manual-quiz-builder.js.js). List of questions is in W3schoolController/actionAjaxQuizQuestionsList().
//Ajax gets list of qiestions from W3schoolController/actionAjaxQuizQuestion and builds/constructs form content in success ajax callback (uses Promise).
//Multisteps of form is done by splitting form to <fieldset>, one is visible, other are hidden.
//Questions in form are constructed automatically based on array $quizQuestionList_Initial in W3schoolController/actionAjaxQuizQuestion
//if you want to add some new array element to be displayed in quiz, i.e image, etc, after adding this el to $quizQuestionList_Initial, process it in next step {//filtering $quizQuestionList_Initial to $$quizQuestionList} where we specify what is returned to client, e.g {'correctAnswer'} is not ruturned for security reson


$(document).ready(function(){
	
	if(screen.width <= 640){ 
	    scrollResults(".scroll-my"); //scroll the page down to certain div
	}
	
	$("#loaderQuiz").show(200); //show the loader
	
	//getting the path to current folder with JS to form url for ajax, i.e /yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/booking-cph/ajax_get_6_month
		var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/'));  ///yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/manual-auto-quiz
		var urlX = dir + '/ajax-quiz-questions-list';
	
   // send ajax onLoad to PHP handler action to get list of questions  ************ 
        $.ajax({
            url: urlX ,
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
            data: { 
			    //serverCity:window.cityX
			},
            success: function(data) {
                // do something;			    
				//alert(JSON.stringify(data));
				//alert(data.questionList[0].questions);
				
				//Promise, otherwise proccessFiledset() does not see loaded by ajax new DOM elemnets. UPDATE => Promise is not necessary????
				constructQuestionsList(data)
				.then(
				   proccessFiledset()
                 ).then(
				   setProgressBarQ(currentQ)
				 );
				
            },  //end success
			
				
			error: function (error) {
				$("#quizDiv").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Quiz failed" + JSON.stringify(error) + "</h4>")}).fadeIn(2000);
            }	
        });
                                               
       //  END AJAXed  part 
	   
	   
	   
	   //constructs ajax success answer, i.e builds questions list
	   function constructQuestionsList(data){
		 return new Promise((resolve, reject) => {  //Promise, otherwise proccessFiledset() does not see loaded by ajax new DOM elemnets. UPDATE => Promise is not necessary????
           
		   //if data.result_status not OK, stop further, e.g if $quizQuestionList_Initial[['name_id_attr']] in function W3schoolController/actionAjaxQuizQuestionactionAjaxQuizQuestionsList() has duplicate values
		   if (data.result_status != "OK"){
			   	$("#quizDiv").stop().fadeOut("slow",function(){ $(this).html("<span class='text-danger'> " + data.error + "</span>") }).fadeIn(2000); //Error, you have duplicate key value in your array
				return ;
		   }
		   
		   
		   //If (data.result_status == "OK"), go further building multisteps form 
		   var finalText = '<form id="quiz_form" novalidate action=""  method="post">';
		   
		   for(var i = 0; i < data.questionList.length; i++){
			   
			   finalText+= '<fieldset class="q-fields">' +
			               '<p>Question ' + (i+1) + '</p>' +
			               '<p>' + data.questionList[i].questions + '</p>' +  //display the quiz question
			               '<div class="form-group">';
			   
			   
			   //finalText+= '<p>' + data.questionList[i].questions + '</p>';
			   
			   //built/display variants of quiz answers 
			   for(var j = 0; j < data.questionList[i].answer.length; j++){ 
				   
				   finalText+=  '<div class="form_radio_btn_quiz">' + 
			   '<input type="radio" name="' + data.questionList[i].name_id_attr +  '"' + //input name, i.e {question9311}, the same for each fieldset, i.e the same for all radiobtn of one question, next question has other 
			                        'value="' + data.questionList[i].answer[j] + '" ' + //Norrebro
									'id="' + data.questionList[i].name_id_attr + j + '"/>' +  //input id  //MEga Fix => click on RadioButton was not working due to missing {id}. ID must be unique, so we add {j} to {name_id_attr} which the same for all radiobtn of one question, e.g we recieve {question93110}, next radiobtn of the same question is {question93111}									'<label for="' + data.questionList[i].name_id_attr + j + '"> ' + data.questionList[i].answer[j]  + '</label>' + //Norrebro
                                    '<label for="' + data.questionList[i].name_id_attr + j + '"> ' + data.questionList[i].answer[j]  + '</label>' +
								'</div>';
			   }
			   
			   finalText+=  '</div><br>' +
			                '<input type="button" name="previousQ" class="previousQ btn btn-info' + (i == 0 ? ' hidden-btn':'') + '" value="Prev" />&nbsp;' +  //hidden on 1st page/fieldset
			                '<input type="button" name="nextQ" class="nextQ btn btn-info' + (i == (data.questionList.length-1) ? ' hidden-btn':'') + '" value="Next" />' +   //hidden on last page/fieldset
                            '<input type="submit" id="submitBtnQ" name="submitBtnQ" class="submit btn btn-success' + (i != (data.questionList.length-1) ? ' hidden-btn':'') + '" value="Submit" />' + //hidden everywhere, except for on last page/fieldset

							'</fieldset>';
							
		
			  
			  
		   }
		   
		   finalText+= '</form>';
		   
		   //setTimeout(function(){
		       $("#loaderQuiz").hide(900); //show the loader
			   $("#quizDiv").html(finalText).fadeOut();
		       $("#quizDiv").stop().fadeOut("slow",function(){ $(this).html(finalText) }).fadeIn(2000);
		   //},2000);
		   
		  /* setTimeout(function(){
		      proccessFiledset(); //because ajax succes is async 
		   },3000); */
		   
		 }); //end promise

	   }
	   
	   
	   
	   
	   
	   
	   
	   
//*************************************************************************************************************************	   
//Multi Step Form proccess, show next/prev fieldset of quiz-------------------------
var currentQ = 1, current_stepQ, next_stepQ, stepsQ;
  //stepsQ = $("#quiz_form fieldset").length;
  //alert('q2 ' + stepsQ );
//setProgressBarQ(currentQ);


//gets the quantioty of questions/fieldsets	   
function proccessFiledset(){	
  stepsQ = $("#quiz_form fieldset").length;
  //alert('Quantity of questions in My manual Quiz builder ' + stepsQ );
}   
  
  
  
  
  /*
  |--------------------------------------------------------------------------
  | when user clicks NEXT button
  |--------------------------------------------------------------------------
  |
  |
  */
  //click "Next" button
  $(document).on("click", '.nextQ', function() {  //for newly generated 
	  
	 // First goes JQ Validation Plugin function, vaidation works on NAME attributes, i.e  <input type="password" class="form-control" name="password">
	 //JQ_Validate_Plugin_checking_fields(); 
	 
	   //append child-div with Loader animation, it is 1stly added in html(views/../my-manual-quiz-builder.php) but erased by JW html()
	   var rootPath = loc.substring(0, dir.lastIndexOf('/')); // turns path {/yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/manual-auto-quiz} to {/yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web}
	   //alert(rootPath);
	   $("#quizDiv").append("<div class='col-lg-12 col-md-12 col-sm-12 child-div'> <img class='loaderQuiz' src='" + rootPath + "/images/w3school/load.gif'/></div>");
	   $(".child-div").css('opacity', '0.6'); //shows yellow overlay div-> react imitation of animation, analogue of {$(".del-st").stop().fadeOut("slow",function(){ /*$(this).html(finalText) */}).fadeIn(3000);

	
	//if JQ Valiadion Plug in is OK (in JQ_Validate_Plugin_checking_fields()), then move to next page
	//if ($("#regiration_form").valid() === true){ 
        current_stepQ = $(this).parent(); //get current visiblle fieldset
	    console.log(current_stepQ);
        next_stepQ = $(this).parent().next();
		//$("#loaderQuiz").show(200); //show the loader
		current_stepQ.hide(1200); //hide prev question fieldset
        next_stepQ.fadeIn(900); //next question fieldset
		//next_stepQ.show("slide", { direction: "left" }, 1000);
        
        setProgressBarQ(++currentQ);
		
		setTimeout(function() {
	       $(".child-div").css('opacity', '0'); //hides yellow overlay div -> react imitation of animation, analogue of{$(".del-st").stop().fadeOut("slow",function(){ /*$(this).html(finalText) */}).fadeIn(3000);
	       $('.child-div').remove(); //mut be removed, otherwise causes crash
	   }, 2000);
	//}
  });
  
  
  
  
  
  /*
  |--------------------------------------------------------------------------
  | when user clicks PREV button
  |-------------------------------------------------------------------------- 
  |
  */
  $(document).on("click", '.previousQ', function() {  //for newly generated 
    current_stepQ = $(this).parent();
    next_stepQ = $(this).parent().prev();
    next_stepQ.show();
    //next_stepQ.show("slide", { direction: "left" }, 1000);
    current_stepQ.hide();
    setProgressBarQ(--currentQ);
  });
  
  //setProgressBarQ(currentQ);
  
 // Change progress bar action, based on $("fieldset").length;
  function setProgressBarQ(curStep){
	//stepsQ = $("#quiz_form fieldset").length;
    var percent = parseFloat(100 / stepsQ) * curStep;
    percent = percent.toFixed();
    $(".progress-barQ")
      .css("width",percent+"%")
      .html(percent+"%");   
  }
  
  
  //user click to SUBMIT form, then sends ajax to check answers
  $(document).on("click", '#submitBtnQ', function(evt) {  //for newly generated 
	  evt.preventDefault(); //prevent submit
	  //if JQ Valiadion Plug in is OK (in JQ_Validate_Plugin_checking_fields()), then move to next page
	  //if ($("#quiz_form").valid() === true){
	      //alert( $("#quiz_form").serialize());
		  //show all inputs results
		  //$("#quizDiv").stop().fadeOut("slow",function(){ $(this).html('<div class="red alert alert-success"><h3>Thanks, your provided data is </h3><span class="glyphicon glyphicon-log-in"></span><br>' + $("#quiz_form").serialize() + ' </div>')}).fadeIn(2000);
          sendsAjaxToCheckAnswers();
	  //}
  
  });
  	   
//End Multi Step Form proccess, show next/prev fieldset of quiz-------------------------



	   






 
  /*
   |--------------------------------------------------------------------------
   | sends ajax to server to check if answers are correct
   |-------------------------------------------------------------------------- 
   |
   */
 function sendsAjaxToCheckAnswers(){
	 
	 
	 //make sure at least one question is answered
	 /*if($("#quiz_form").serialize() == ""){
		 var answers = "";
	 } else {
		  var answers = $("#quiz_form").serialize();
	 }*/
	 
	 // send ajax onLoad to PHP handler action to get list of questions  ************ 
        $.ajax({
            url: urlX ,
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
            data: { 
			    serverAnswer: $("#quiz_form").serialize()
			},
            success: function(data) {
                // do something;			    
				//alert(JSON.stringify(data));
				//$("#quizDiv").stop().fadeOut("slow",function(){ $(this).html('<div class="red alert alert-success"><h3>Thanks, your provided data is </h3><span class="glyphicon glyphicon-log-in"></span><br>' + JSON.stringify(data) + ' </div>')}).fadeIn(2000);
                buildQuizScoreResult(data);
            },  //end success
			
			error: function (error) {
				$("#quizDiv").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Quiz check answers failed " + JSON.stringify(error) + "</h4>")}).fadeIn(2000);
            }	
        });
                                               
       //  END AJAXed  part 
 }
 
	 
    
   /*
    |--------------------------------------------------------------------------
    | builds  scores results for your answers (on ajax success)
    |-------------------------------------------------------------------------- 
    |
    */	
	function buildQuizScoreResult(dataX){
		var finalScoreText = "<p> Your scores.</p>";
		finalScoreText+= "<p><i class='fa fa-check' style='font-size:21px;color:lime'></i> <b> There were " + dataX.questionsCount + " questions.</b></p>"; 
		finalScoreText+= "<p><i class='fa fa-check' style='font-size:21px;color:lime'></i> <b>You have " + dataX.amountOfCorrectAnswers + " correct answers.</b></p>";
		
		console.log(dataX.result_status);
		for(var i = 0; i < dataX.result_status.length; i++){ 
			if(dataX.result_status[i][0] == 'correct'){
			    finalScoreText+= "<p class='bg-success score'><b>Question " + (i+1) + " => Correct!!!</b> <br> <i class='fa fa-check' style='font-size:48px;color:lime'></i> <br> <b>Question: </b> " + dataX.result_status[i][1] + "<br> <b>Your answer was:</b> " + dataX.result_status[i][2] + "</p>";
			} else {
			    finalScoreText+= "<p class='bg-danger score'><b>Question " + (i+1) + " => Wrong!!!    </b><br> <i class='fa fa-close' style='font-size:48px;color:red'></i>  <br> <b>Question: </b>" + dataX.result_status[i][1] + " <br><b>Your answer was: </b> " + dataX.result_status[i][2] +  "<br> <b>Correct answer was: " + dataX.result_status[i][3]+ "</b></p>";

			}
		}
		
	    $("#quizDiv").stop().fadeOut("slow",function(){ $(this).html('<div class="lavender"><h3>Thanks, </h3><span class="glyphicon glyphicon-log-in"></span><br>' + finalScoreText + ' </div>')}).fadeIn(2000);

	}		
	   
	   
	






 /*
  |--------------------------------------------------------------------------
  | global Function to scroll to certain div, it is global & declared out of IIFE to use in other scripts
  |-------------------------------------------------------------------------- 
  |
  */
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





	

});



	 
	 
	 