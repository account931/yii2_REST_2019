<!-- File to test Yii2 rest api from non-rest file(file which outside the Yii2 folder).Get Rest response with ajax -->

<!doctype html>
<!--------------------------------Bootstrap  Main variant ------------------------------------------>
  <html lang="en-US">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html">
      <meta name="description" content="yii2 Rest" />
      <meta name="keywords" content="yii2, api, rest">
      <title>Test Yii2 Rest XML</title>
  
      <!--Favicon-->
      <!--<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">-->
	  

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 
	  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <!--<link rel="stylesheet" type="text/css" media="all" href="css/myWeathers.css">-->
	  
      <style>
	    .fit-div{word-wrap: break-word;}
	  </style>
	
	  
	  <meta name="viewport" content="width=device-width" />

     </head>
	 
	

     <body>

         <div class="wrapper grey">
    	   <div class="container-fluid">
		   
		   
		     <!----------------- Test_1 =>  TEST /GET HTTP REQUEST, i.e  get all users -----------------------> 
		      <div class="col-sm-12 col-xs-12 text-center" style="background-color:lavender;">  
                  <h1>Test Yii2 Rest API XML</h1>
				  <p>If 'authenticator' => is Enabled in controllers/RestController,<br> ajax URL must contain user token (from SQL rest_access_tokens) <br> i.e => url: '../web/rest?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b</p>
				  
				  
				   
				  <hr  style="width: 90%; color: black; height: 2px; background-color:black;">
				  <h4 class="text-danger"><b>Yii2 Restful Api GET/ response:</b></h4>
				  <p id="result" class="fit-div"></p><!-- rest api results go here -->
				  
				  
				  <script>
				      //below script makes a test request to Yii2 Rest Api
					  //this file must be run on localhost(i.e must have .php extension not .html)
					  //By default Yii2 rest returns xml, but it must not bother,just specify in ajax {contentType: "application/json; charset=utf-8",} and it will return json
				      $.ajax({
						  //url: '../web/rest',  //url if 'authenticator' => is disabled in controllers/RestController
                          url: '../web/rest?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b', //we use here url with this user access-token(from DB), it is universal, if authenticator' => is disabled, the script just won't pay attaention to this $_GET['access-token']
                          //'../web/rest?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b' equals to => '../web/rest/index?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b
						  //to get user 4 => '../web/rest/view/4?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b'
						  type: 'GET', //must be GET, as it is REST /GET method
						  crossDomain: true,
						  contentType: "application/json; charset=utf-8",
			              dataType: 'json', // without this it returned string(that can be alerted), now it returns object
			              //passing the city
                          data: { 
			                  //serverCity:window.cityX
			              },
                          success: function(data) {
                             // do something;
                           
			                //alert(data);
							console.log(data);
							var ress = "REST Api Response (list of users): <br>";
							for (var i = 0; i < data.length; i++){
								ress+= data[i].username + "-> " + data[i].email + "<br>";
							}
							$("#result").stop().fadeOut("slow",function(){ $(this).html(ress) }).fadeIn(2000);
				
                          },  //end success
			              error: function (error) {
				              $("#result").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Rest API crashed <br><br>" + error.responseJSON.name + "<br>" + error.responseJSON.message + "</h4>")}).fadeIn(2000);
                              console.log(error);
						  }	  
                     });                             
                    //END AJAXed  part 
				  </script>
			  </div> <!--END <div class="col-sm-4" style="background-color:lavender;">-->
			 <!----------------- END  TEST /GET HTTP REQUEST, i.e  get all users ----------------------->  
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
			
			<!----------------- TEST_2 =>  /POST  HTTP REQUEST, i.e  INSERT (create a new user) -----------------------> 
            <!-- WORKS, if not, make sure that 1.{username,password_reset_token } in data: is UNIQUE + 2. IN MODEL FIELDS MUST BE SAFE -->			
			  <div class="col-sm-12 col-xs-12 text-center" style="background-color:lavender;"> 
			  <br><hr  style="width: 90%; color: black; height: 2px; background-color:black;">

				 <h4 class="text-danger"><b>Yii2 Restful Api POST/ HTTP request, i.e INSERT (create new user):</b></h4>
				 <p class="small font-italic">WORKS, if not, make sure that 1.{username,password_reset_token } in data: is UNIQUE + 2. IN MODEL FIELDS MUST BE SAFE</p>
				  <p id="result2" class="fit-div"></p><!-- rest api results go here -->
				  
				  
				  <script>
				      //below script makes a test request to Yii2 Rest Api
					  //this file must be run on localhost(i.e must have .php extension not .html)
					  //By default Yii2 rest returns xml, but it must not bother,just specify in ajax {contentType: "application/json; charset=utf-8",} and it will return json
				      
					  //dataX is not used ???
					  var dataX = {username:'dima33333', auth_key:'rpWTxyZV1Oaafv60zWyEaMRoDCOs2S_V' , password_hash: '$2y$13$k8vVzc3Jw23l/TQmqkorEeP9n7.IUu1a7Mmmq.LZ.1A...',
					  password_reset_token: 'TQ54N3hxSR5tAsZ5CA5Y0ykUHgXJcab8_1567766765' , email: 'accou5454@ukr.net'};
					  
					  
					  $.ajax({
						  //url: '../web/rest',  //url if 'authenticator' => is disabled in controllers/RestController
                          
						  url: '../web/rests?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b', //we use here url with this user access-token(from DB), it is universal, if authenticator' => is disabled, the script just won't pay attaention to this $_GET['access-token']
                          type: 'POST', //POST is to create a new user
						  crossDomain: true,
						  contentType: "application/json; charset=utf-8",
			              //dataType: 'json', // without this it returned string(that can be alerted), now it returns object
						  
						  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
						   
			              //passing the city
                          data: //dataX//JSON.stringify(dataX) 
						  {   //username and password_reset_token musr be UNIQUE!!!!!
			                  username:'dima33333', auth_key:'rpWTxyZV1Oaafv60zWyEaMRoDCOs2S_V' , password_hash: '$2y$13$k8vVzc3Jw23l/TQmqkorEeP9n7.IUu1a7Mmmq.LZ.1A...',
							  password_reset_token: 'TQ54N3hxSR5tAsZ5CA5Y0ykUHgXJcab' , email: 'accou5454@ukr.net'
							 
			              },
                          success: function(data) {
                            // do something;
                            //alert(JSON.stringify(data, null, 4));
			                //alert(data);
							console.log(data);
							var ress =  JSON.stringify(data, null, 4);
							/*for (var i = 0; i < data.length; i++){
								ress+= data[i].username + "-> " + data[i].email + "<br>";
							}
							*/
							$("#result2").stop().fadeOut("slow", function(){ $(this).html(ress) }).fadeIn(2000);
				
                          },  //end success
			              error: function (error) {
				              $("#result2").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Rest API crashed <br><br>" + error.responseJSON.name + "<br>" + error.responseJSON.message + "</h4>")}).fadeIn(2000);
                              console.log(error);
						  }	  
                     });                             
                    //END AJAXed  part 
				  </script>
				  <br><br><br>
				 </div>
				 <!----------------- END TEST_2 /POST/PUT/DELETE/ HTTP REQUESTS, i.e  INSERT, UPDATE, DELETE -----------------------> 
				 
				 
				

				
			  
              <!----------------- TEST_3 =>  DELETE/ HTTP REQUEST, i.e   DELETE -----------------------> 
              <!-- DOES NOT WORK so far as ERROR 403 FORBIDDEN -->			  
			  <div class="col-sm-12 col-xs-12 text-center" style="background-color:lavender;"> 
			     <br><hr  style="width: 90%; color: black; height: 2px; background-color:black;">

				 <h4 class="text-danger"><b>Yii2 Restful Api DELETE/ HTTP request, i.e DELETE:</b></h4>
				 <p class="small font-italic">make sure that specified id to delete exists in DB. Currently returns 403</p>
				 <p id="result_delete" class="fit-div"></p><!-- rest api results go here -->
				  
				  
				  <script>
				      
					  $.ajax({
						  //url: '../web/rest',  //url if 'authenticator' => is disabled in controllers/RestController
                          
						  url: '../web/rests/28?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b', //we use here url with this user access-token(from DB), it is universal, if authenticator' => is disabled, the script just won't pay attaention to this $_GET['access-token']
                          type: 'DELETE', //DELETE a certain user
						  crossDomain: true,
						  contentType: "application/json; charset=utf-8",
			              //dataType: 'json', // without this it returned string(that can be alerted), now it returns object
						  
						   headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                           contentType: 'application/x-www-form-urlencoded; charset=utf-8',
						   
			              //passing the city
                          //data: JSON.stringify(dataX)
                          success: function(data) {
                            // do something;
                            alert(JSON.stringify(data, null, 4));
			                //alert(data);
							console.log(data);
							
							/*for (var i = 0; i < data.length; i++){
								ress+= data[i].username + "-> " + data[i].email + "<br>";
							}
							*/
							$("#result_delete").stop().fadeOut("slow",function(){ $(this).html( JSON.stringify(data, null, 4) ) }).fadeIn(2000);
				
                          },  //end success
			              error: function (error) {
				              $("#result_delete").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Rest API crashed <br><br>" + error + "<br>" + error.responseJSON.message + "</h4>")}).fadeIn(2000);
                              console.log(error);
						  }	  
                     });                             
                    //END AJAXed  part 
				  </script>
				 </div>
              <!----------------- END TEST_3 =>  DELETE/ HTTP REQUEST, i.e   DELETE ----------------------->  
				 				
								
								
				 
				 
			<!----------------- TEST_4 =>  PATCH/ HTTP REQUEST, i.e Edit/Update -----------------------> 
              <!-- DOES NOT WORK so far as ERROR 403 FORBIDDEN -->			  
			  <div class="col-sm-12 col-xs-12 text-center" style="background-color:lavender;"> 
			     <br><hr  style="width: 90%; color: black; height: 2px; background-color:black;">

				 <h4 class="text-danger"><b>Yii2 Restful Api PATCH/ HTTP REQUEST, i.e Edit/Update </b></h4>
				 <p class="small font-italic">so far not implemented</p>
				 <p id="result_patch" class="fit-div"></p><!-- rest api results go here -->
              </div>

			<!----------------- END TEST_4 =>  PATCH/ HTTP REQUEST, i.e Edit/Update -----------------------> 
 
				 
				 
				 
              <!----------------- TEST_5 => HTTP request with cURL Library ----------------------->  
			  <div class="col-sm-12 col-xs-12 text-center fit-div" style="background-color:lavender;"> 
			      <br><hr  style="width: 90%; color: black; height: 2px; background-color:black;">
				  <h4 class="text-danger"><b>HTTP request with cURL Library:</b></h4>	
				  
				  <?php
				  //Variant 4 => HTTP request with cURL Library
				  echo "<h3>cURL variant</h3>";
				
				  //$ch = curl_init('http://dimmm931.000webhostapp.com/yii2_rest/web/rests?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b');
				  //$ch = curl_init('http://localhost/yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/rests?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b');

                  $data = array(
                    'username' =>  'dimacccc', 
                    'auth_key' => 'rpWTxyZV1Oaafv60zWyEaMRoDCOs2S_V', 
                    'password_hash' => '$2y$13$k8vVzc3Jw23l/TQmqkorEeP9n7.IUu1a7Mmmq.LZ.1A...',
					'password_reset_token' => 'TQ54N3hxSR5tAsZ5CA5Y0ykUHgXJcab8_1567766765',
					'email' => 'accou5454@ukr.net'
                  );
				
				  //array to json
				  $json = json_encode($data);

                  /* $data = "{
                    'username' : 'dimaccccv', 
                    'auth_key' : 'rpWTxyZV1Oaafv60zWyEaMRoDCOs2S_V', 
                    'password_hash' : '$2y$13$k8vVzc3Jw23l/TQmqkorEeP9n7.IUu1a7Mmmq.LZ.1A...',
					'password_reset_token' : 'TQ54N3hxSR5tAsZ5CA5Y0ykUHgXJcab8_1567766765',
					'email' : 'accou5454@ukr.net' 
				   }";*/
                
				  
               curl_setopt($ch, CURLOPT_POST, 1); //sets method POST
               //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); //http_build_query=> Генерирует URL-кодированную строку запроса, i.e => foo=bar&baz=boom&cow=milk&php=hypertext+processor
			   curl_setopt($ch, CURLOPT_POSTFIELDS, $json); //sends data

               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// TRUE для возврата результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error
			   //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, POST);
 
               $response = curl_exec($ch);
		       $err = curl_error($ch);
               curl_close($ch);
		
	          
	          //info if any curl error happened
		      if ($err) {
                  //echo "cURL Error #:" . $err;
			      $resultX['errorX'] = $err; //'<p class="bg-warning">Sms not sent.</p>' . $err;
              } else {
		          $resultX['errorX'] = "No cURL error detected";
              }
			  
			  //MEGA FIX, $response is already JSON, but later in ajax/sendSms we do it json encode once again that cause crash. So, firstly we deJSON it!!!!
			  $response2 = json_decode($response, true); 
			  
			  echo 'Error=> ' . $resultX['errorX'] . "<br>";
			  var_dump($response2);
			  ?>
			 </div>	 
			<!----------------- END TEST_5 => HTTP request with cURL Library ----------------------->  
	 
				 
				 
				 
	                            
     
    		</div><!-- /.container -->	  		
    	 </div><!-- /.wrapper -->

                

       
		
		
	
		
		

		
    
    </body>
</html>
