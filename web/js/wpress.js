(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
	
	
    //on change in dropdown list (list of all categories from DB WpressCategory), onchange redirects to the same page but with diffrent $_GET['category'] in order to let Controller select only articles with certain category
	//<option value=""> is set in views/wpress-blog/blog-posts-all.php
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	if(document.getElementById("dropdownnn") !== null){ //additional check to avoid errors in console in actions, other than actionShowAllBlogs(), when this id does not exist
	   document.getElementById("dropdownnn").onchange = function() {
          //if (this.selectedIndex!==0) {
              window.location.href = this.value;
          //}        
       };
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	

		
	//onLoad truncate article text $(this)
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  
	     for( i = 0; i < $(".text-truncated").length; i++){
			 //alert($(".text-truncated")[i].innerHTML.length);
			 //alert($(this).innerHTML.length);
			 
			//change each text with function truncateTextProcessor()
			$(".text-truncated")[i].innerHTML = truncateTextProcessor( $(".text-truncated")[i], 407)
		 }
	 
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	//on click on cut/truncate text (class .text-truncated) show all text
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '.text-truncated', function() {   // this  click  is  used  to   react  to  newly generated cicles;
	      $(this).hide();
		  $(this).next($('text-hidden')).show();
		  
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	//on click on Full expended text (class .text-hidden) show cut text
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '.text-hidden', function() {   // this  click  is  used  to   react  to  newly generated cicles;
	      $(this).hide();
		  $(this).prev($('text-truncated')).show();
		  
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	//function to cut/truncate text to certain length + "..."
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	function truncateTextProcessor(selector, maxLength) {
    //var element = document.querySelector(selector),
        truncated = selector.innerText;

    if (truncated.length > maxLength) {
        truncated = truncated.substr(0,maxLength) + '..........';
    }
    return truncated;
   }
   //You can then call the function with something like what i have below.
  //document.querySelector('p').innerText = truncateText('p', 107);




  
  
   //LOADER SECTION
   // **************************************************************************************
   // **************************************************************************************
   //                                                                                     ** 
	
	var showPage = function(){   
      document.getElementById("loaderX").style.display = "none"; //hides loader
      document.getElementById("all").style.display = "block";    //show div id="all"
   }
	
	
	
	function appendLoaderDiv(){
	   var elemDiv = document.createElement('div');
	   elemDiv.id = "loaderX";
       //elemDiv.style.cssText = 'position:absolute;width:100%;height:100%;opacity:0.3;z-index:100; top:20px;';
	   //$("#loaderX").append('<img id="theImg" src="images/load.gif" />');
	   //elemDiv.innerHTML = '<img id="theImg" src="images/load.gif" />'; 
	   //elemDiv.style.backgroundColor = "black";
	   //$("#loaderX").css("background", "url('images/load.gif')");
       document.body.appendChild(elemDiv);
	} 
	   
	 if(document.getElementById("all") !== null){ //additional check to avoid errors in console in actions, other than actionShowAllBlogs(), when this id does not 
	     appendLoaderDiv(); //appends a div id="loaderX" with pure CSS loader to body, no code in index.php, just css to mycss.css
	     var myVar = setTimeout(showPage, 1000);
	 }
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	 //END LOADER SECTION 
	   
	   
	
	
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)