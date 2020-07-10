//used in -> Multi Step Form with JQ Validation Plug-in and Progress Bar 
	

$(document).ready(function(){
	
  var current = 1,current_step,next_step,steps;
  steps = $("fieldset").length;
  
  
  /*
  |--------------------------------------------------------------------------
  | when user clicks NEXT button
  |--------------------------------------------------------------------------
  |
  |
  */
  
  $(".next").click(function(){
	  
	 // First goes JQ Validation Plugin function, vaidation works on NAME attributes, i.e  <input type="password" class="form-control" name="password">
	 JQ_Validate_Plugin_checking_fields(); 
	
	//if JQ Valiadion Plug in is OK (in JQ_Validate_Plugin_checking_fields()), then move to next page
	if ($("#regiration_form").valid() === true){ 
        current_step = $(this).parent(); //current visiblle fieldset
	    //console.log(current_step);
        next_step = $(this).parent().next();
        next_step.show(); //next fieldset
        current_step.hide();
        setProgressBar(++current);
	}
  });
  
  
  
  
  
  /*
  |--------------------------------------------------------------------------
  | when user clicks PREV button
  |-------------------------------------------------------------------------- 
  |
  */
  $(".previous").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
    setProgressBar(--current);
  });
  
  setProgressBar(current);
  
  // Change progress bar action, based on $("fieldset").length;
  function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  }
  
  
  //form submit btn on cick
  $("#submitBtn").click(function(evt){
	  evt.preventDefault(); //prevent submit
	  //if JQ Valiadion Plug in is OK (in JQ_Validate_Plugin_checking_fields()), then move to next page
	  if ($("#regiration_form").valid() === true){
	      alert('implement sending ajax here or something else. If u want just php submit, comment {evt.preventDefault() in  $("#submitBtn").click(function(evt)} ');
	      alert( $("#regiration_form").serialize());
	  }
  
  });
  
  
  
  /*
  |--------------------------------------------------------------------------
  | JQ Validation Plugin Plugin, 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js'
  |-------------------------------------------------------------------------- 
  |
  */
  function JQ_Validate_Plugin_checking_fields(){
	// Here goes JQ Validation Plugin, vaidation works on NAME attributes, i.e  <input type="password" class="form-control" name="password">

	// Adding my Custom method to validate first name based on regExp
	$.validator.addMethod("myCustomeRegex", function(value, element) {
	    return this.optional(element) || /^[a-zA-Z]*$/i.test(value); //[a-zA-Z0-9]
	}, "Username must contain only letters");
	
	// Adding my Custom method to validate phone number based on regExp
	$.validator.addMethod("myPhoneRegex", function(value, element) {
	    return this.optional(element) || /^[+][\d]{8,9}[0-9]+$/i.test(value); //[a-zA-Z0-9]
	}, "phone number must be in format +380...");
			
			
    var form = $("#regiration_form");
	
	form.validate({
	    errorElement: 'span',
		errorClass: 'help-block',
		highlight: function(element, errorClass, validClass) {
		    $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass, validClass) {
		    $(element).closest('.form-group').removeClass("has-error");
		},
					
		//validation rules for NAME attributes, not id
		rules: {
		    email: {
		        required: true,
		        minlength: 3,
		    },
		    password : {
		        required: true,
				minlength: 4,
		    },
		    conf_password : {
		        required: true,
				minlength: 4,
		        equalTo: '#password',
		    },
			fName: {
	            required: true,
				myCustomeRegex: true, //uses my custom RegExp
		        minlength: 3,
		    },
			 lName: {
	            required: true,
		        minlength: 3,
		    },
		    ph_number :{
		        required: true,
				myPhoneRegex:true //uses my custom RegExp
		    },
		    address:{
		        required: true,
				 minlength: 13,
		    },
	        
						
		},
		    //set your error messages,
		    messages: {
			    username: {  //if message is not set, it will fire "This field is required"
				    required: "Username required",
				},
				password : {
				    required: "Password required",
			    },
				conf_password : { //if message not set, will fire "Please enter the same value again"
				        required: "Password required",
						equalTo: "Password don't match",
				},
				name: {
				    required: "Name required",
				},
				email: {
				    required: "Email required",
				},
					}
				});
  }
  
  
  
  
  
});