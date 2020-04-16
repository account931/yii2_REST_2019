//Lazy Load  => //https://vash-webmaster.ru/2017/08/11/lazyload-js/
(to use: 
    1.download js=> <script src="jquery.lazyload.js"></script> 
	2. use in html=> <img class="lazy" data-original="img/example1.jpg"; 
	3. use code below in js

$(function() {
	
    $("img.lazy").lazyload({
		 effect : "fadeIn", //appear effect
         threshold : 10 //content will load only on scrolling down 10px
    });

});
//Lazy Load
