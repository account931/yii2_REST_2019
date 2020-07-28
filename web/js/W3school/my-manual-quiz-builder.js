//used in my-manual-quiz-builder

//ReadMe
//Multi steps quiz form content is loaded to <div id="quizDiv"> by JS ajax in (my-manual-quiz-builder.js.js). List of questions is in W3schoolController/actionAjaxQuizQuestionsList().
//Ajax gets list of qiestions from W3schoolController/actionAjaxQuizQuestion and builds/constructs form content in success ajax callback (uses Promise).
//Multisteps of form is done by splitting form to <fieldset>, one is visible, other are hidden.
//Questions in form are constructed automatically based on array $quizQuestionList_Initial in W3schoolController/actionAjaxQuizQuestion
//if you want to add some new array element to be displayed in quiz, i.e image, etc, after adding this el to $quizQuestionList_Initial, process it in next step {//filtering $quizQuestionList_Initial to $$quizQuestionList} where we specify what is returned to client, e.g {'correctAnswer'} is not ruturned for security reson


$(document).ready(function(){
	$("#loaderQuiz").show(200); //show the loader
	
	//getting the path to current folder with JS to form url for ajax, i.e /yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/booking-cph/ajax_get_6_month
		var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/'));
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
				$("#quizDiv").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Quiz failed</h4>")}).fadeIn(2000);
            }	
        });
                                               
       //  END AJAXed  part 
	   
	   
	   
	   //constructs ajax success answer
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
                                    '<input type="radio" name="' + data.questionList[i].name_id_attr +  '"' + //input name
			                        'value="' + data.questionList[i].answer[j] + '" ' + 
									/* 'id="' + data.questionList[i].name_id_attr + '"/>' */ '/>' +  //input id
									'<label for="' + data.questionList[i].name_id_attr + '"> ' + data.questionList[i].answer[j]  + '</label>' +
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
  alert('Quantity of questions in My manual Quiz builder ' + stepsQ );
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
	
	//if JQ Valiadion Plug in is OK (in JQ_Validate_Plugin_checking_fields()), then move to next page
	//if ($("#regiration_form").valid() === true){ 
        current_stepQ = $(this).parent(); //get current visiblle fieldset
	    console.log(current_stepQ);
        next_stepQ = $(this).parent().next();
        next_stepQ.show(); //next fieldset
		//next_stepQ.show("slide", { direction: "left" }, 1000);
        current_stepQ.hide();
        setProgressBarQ(++currentQ);
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



	   






 //sends ajax to check answers
 function sendsAjaxToCheckAnswers(){
	 // send ajax onLoad to PHP handler action to get list of questions  ************ 
        $.ajax({
            url: urlX ,
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
            data: { 
			    serverAnswer:$("#quiz_form").serialize()
			},
            success: function(data) {
                // do something;			    
				//alert(JSON.stringify(data));
				$("#quizDiv").stop().fadeOut("slow",function(){ $(this).html('<div class="red alert alert-success"><h3>Thanks, your provided data is </h3><span class="glyphicon glyphicon-log-in"></span><br>' + JSON.stringify(data) + ' </div>')}).fadeIn(2000);

            },  //end success
			
			error: function (error) {
				$("#quizDiv").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Quiz check answers failed " + JSON.stringify(error) + "</h4>")}).fadeIn(2000);
            }	
        });
                                               
       //  END AJAXed  part 
 }
 
	   
	   
	   
	   
	   

});



	 
	 
	 