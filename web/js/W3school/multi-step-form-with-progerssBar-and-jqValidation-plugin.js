//used in -> Multi Step Form with JQ Validation Plug-in and Progress Bar 

//JQ Validate Plug-in ReadMe, how to use => 
// 1.) Add => <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
// 2.) Specify your validation rules, regExp, etc in your js, see function JQ_Validate_Plugin_checking_fields()

//# The problem/failure with JQ Validate Plug-in validating RadioButton input was caused by using custom radiobutton in form of square buttons, 
//    and thus in css we had {.form_radio_btn input[type=radio] {display: none;}. And by default, JQ Validate Plug-in ignores all hidden inputs. The solution is to change {display: none;} to {opacity:0;}}

$(document).ready(function(){
	
  var current = 1,current_step,next_step,steps;
  steps = $("#regiration_form fieldset").length; 
  //alert("Multi steps contains steps => " + steps);
  
  
  /*
  |--------------------------------------------------------------------------
  | when user clicks NEXT button
  |--------------------------------------------------------------------------
  |
  |
  */
 
  //click "Next" button
  $(".next").click(function(){
	  
	 // First goes JQ Validation Plugin function, vaidation works on NAME attributes, i.e  <input type="password" class="form-control" name="password">
	 JQ_Validate_Plugin_checking_fields(); 
	
	//if JQ Valiadion Plug in is OK (in JQ_Validate_Plugin_checking_fields()), then move to next page
	if ($("#regiration_form").valid() === true){ 
        current_step = $(this).parent(); //get current visiblle fieldset
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
    $(".progress-bar-1")
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
		  //show all inputs results
		  $("#regiration_form").stop().fadeOut("slow",function(){ $(this).html('<div class="red alert alert-success"><h3>Thanks, your provided data is </h3><span class="glyphicon glyphicon-log-in"></span><br>' + $("#regiration_form").serialize() + ' </div>')}).fadeIn(2000);

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
			
			
    var form = $("#regiration_form"); //selector to var
	
	form.validate({
		//ignore:'', //which items ignore to validate, by default -> all hidden
	    errorElement: 'p', //span
		errorClass: 'help-block',
		highlight: function(element, errorClass, validClass) {
		    $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass, validClass) {
		    $(element).closest('.form-group').removeClass("has-error");
			//$('#Color-error').remove();
			$(element).next('.help-block').remove(); //My Mega fix for radiobuttons, removes <p class="help-block">, which is appended by Plug-in when validation false. It is Ok for all inputs, except for RadioButton (specifically for 1st radioButton, thatno longer can be selected)
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
			//radiobutton validation
			Color:{ required:true },	
						
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