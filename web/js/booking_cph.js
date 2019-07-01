$(document).ready(function(){

    for(i = 0; i < $('.badge').length; i++){
		var iter = 1 + i;
		var b = i;
        $('.badge:eq('+ b +')').attr('data-badge', iter);	//assign interger to badge
	}
	
	
	
	
	
});
// end ready	
	