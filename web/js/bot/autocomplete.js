//ReadMe is in => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/Readme_YII2_mine_This_Project_itself.txt

(function(){ //START IIFE (Immediately Invoked Function Expression)



	
	//JQ autocomplete UI,(+ must include JQ_UI.js + JQ_UI.css in index.php)
  $(document).ready(function(){
	
	//to make this script works only on SiteController/ViewOne
	if (typeof aucompleteX === 'undefined') { 
	    //alert ('false');
		return false;
	}
	
	
	
	
	//gets php object $query(i.e from Product Controller/actionShop), i.e all froducts from shop SQL. Php object is echoed in JSON in Controller Product/action Shop
	
	 //alert(JSON.stringify(aucompleteX, null, 4));
	 //alert(aucompleteX[0].b_reply);
	//console.log(JSON.stringify(aucompleteX, null, 4));
	
	
	//array which will contain all products for autocomplete
	var arrayAutocomplete = [];
	
     
	//Loop through passed php object, object is echoed in JSON in Controller Product/action Shop
	  for(var key in aucompleteX){  
	     //for (i = 0; i < aucompleteX[key]['b_key'].length; i++){ 
		//arrayAutocomplete.push(  { label: aucompleteX[i].b_reply[j], value: aucompleteX[i].b_reply[j] }  ); //gets name of every user and form in this format to get and lable and value(Name & ID)
		 var sub = aucompleteX[key]['b_autocomplete'].split('//');
		 for (i = 0; i < sub.length; i++){ 
		    arrayAutocomplete.push(sub[i]); //gets name of every product
	}
	}
	
	//alert("Autocomplete SQL values -> " + arrayAutocomplete);
	
    //Autocomplete itself
    $( function() {
		/*
		//test manual array for autocomplete
        var availableProducts = [ 
                              "Amsterdam_1",
							  "Anchorage_2",
							  "Anfgfg",
							  "Anvbvbv",
							  "Anchgffgfgfgf",				
        ];
		*/
		
		
		//connect autocomplete array to input
       $( "#NOT_USED" ).autocomplete({
			//addon, trying to fix Z-index overlap of autocomplete, was fixed with css {.ui-autocomplete { position: absolute; cursor: default;z-index:999930 !important;}}
		    /* open: function(){
               // setTimeout(function () { $('.ui-autocomplete').css('z-index', 99999999999999888888); }, 0);
			   $(this).autocomplete('widget').zIndex(999999999999910);
             }, */
		     //addon
			
            source: arrayAutocomplete   //source autocom array
        });
		
		
		//Autocomplete wrap hints in URL <a href>
		$("#txtMsg").autocomplete({
           minLength: 1,
           source: arrayAutocomplete, //array from where take autocomplete
        });/*.data("ui-autocomplete")._renderItem = function (a, b) {
            return $("<li></li>")
            .data("item.autocomplete", b)
            .append('<a href="' + urlX + '/index.php?r=site/view-one&id=' + b.value + '"> ' + b.label + '</a>  ')
            .appendTo(a);
        };
		*/
		//END Autocomplete wrap hints in URL <a href>
		
		
		
		   });
   
   
   
   


    }); //end ready
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)