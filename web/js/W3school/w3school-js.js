//used in....
	
(function ($) {
    "use strict";
	
	//waze galery
	$('#slide1').timerGallery({idPre: 'img' , interval : '4000' });	
	$('#slide2').timerGallery({idPre: 'img_' , interval : '5000'});	
	$("a[class='cboxElement']").colorbox();
	
	 

})(jQuery);