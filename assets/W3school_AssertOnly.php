<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * 
 * 
 */
class W3school_AssertOnly extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	
    public $css = [
        'css/W3school/w3school-css.css',
		'css/W3school/multi-step-form-with-progerssBar-and-jqValidation-plugin.css', //Multi Step Form with JQ Validation Plug-in and Progress Bar
		
		'css/W3school/waze_gallery/colorbox.css', // Waze Galery CSS
		'css/W3school/waze_gallery/style.css', // Waze Galery CSS
		
		'css/W3school/fullscreen-slit-slider/style.css',  // Fullscreen-slit-slider CSS
		'css/W3school/fullscreen-slit-slider/demo.css',   // Fullscreen-slit-slider CSS
		'css/W3school/fullscreen-slit-slider/custom.css', // Fullscreen-slit-slider CSS  
		//'css/W3school/fullscreen-slit-slider/styleNoJS.css', // Fullscreen-slit-slider CSS   -RUINS everything
		
		
		'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', //Fotorama CSS
		
		
		

		
    ];

	
	
    public $js = [
	      
		  //'js/W3school/jqpool.js', //NOT USED???
		  
          'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js', //Must Be https!!!// JQ Validate plugin. Used in Multi Step Form with JQ Validation Plug-in and Progress Bar
		  'js/W3school/multi-step-form-with-progerssBar-and-jqValidation-plugin.js',   //used in Multi Step Form with JQ Validation Plug-in and Progress Bar

		 //'https://code.jquery.com/jquery-3.5.1.min.js',
		 //'https://code.jquery.com/ui/1.12.0/jquery-ui.min.js',
		 
		 //'js/W3school/waze_gallery/jquery-1.4.2.min.js',
		  //'js/W3school/waze_gallery/jquery-ui-1.8.4.custom.min.js', // Waze Galery JS
		  'js/W3school/waze_gallery/jquery.vec.timerGallery_ts.js', // Waze Galery JS
		  'js/W3school/waze_gallery/jquery.colorbox-min.js',        // Waze Galery JS
		  //'https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.5.1/i18n/jquery.colorbox-ca.js',
		  
	      
		  'js/W3school/w3school-js.js',  
		  
		  //'js/W3school/fullscreen-slit-slider/jquery.ba-cond.min.js', // Fullscreen-slit-slider JS  
		  //'js/W3school/fullscreen-slit-slider/jquery.slitslider.js', // Fullscreen-slit-slider J
          //'js/W3school/fullscreen-slit-slider/master-launch.js', // Fullscreen-slit-slider JS  
		  //'js/W3school/fullscreen-slit-slider/modernizr.custom.79639.js', // Fullscreen-slit-slider JS  
		  
		  'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', //Fotorama gallery
		  
		  

		  

    ];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
