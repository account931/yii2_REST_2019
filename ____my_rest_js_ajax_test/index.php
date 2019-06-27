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
      
	
	  
	  <meta name="viewport" content="width=device-width" />

     </head>
	 
	

     <body>

         <div class="wrapper grey">
    	   <div class="container-fluid">
		   
		   
		   
		      <div class="col-sm-12 col-xs-12 text-center" style="background-color:lavender;">  
                  <h1>Test Yii2 Rest API XML</h1>
				  <p>If 'authenticator' => is Enabled in controllers/RestController,<br> ajax URL must contain user token (from SQL rest_access_tokens) <br> i.e => url: '../web/rest?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b</p>
				  <hr  style="width: 90%; color: black; height: 2px; background-color:black;">
				  <p><b>Yii2 Restful Api response:</b></p>
				  <p id="result"></p><!-- rest api results go here -->
				  
				  
				  <script>
				      //below script makes a test request to Yii2 Rest Api
					  //this file must be run on localhost(i.e must have .php extension not .html)
					  //By default Yii2 rest returns xml, but it must not bother,just specify in ajax {contentType: "application/json; charset=utf-8",} and it will return json
				      $.ajax({
						  //url: '../web/rest',  //url if 'authenticator' => is disabled in controllers/RestController
                          url: '../web/rest?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b', //we use here url with this user access-token(from DB), it is universal, if authenticator' => is disabled, the script just won't pay attaention to this $_GET['access-token']
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
				
				 
	                            
     
    		</div><!-- /.container -->	  		
    	 </div><!-- /.wrapper -->

                

       
		
		
	
		
		

		
    
    </body>
</html>
