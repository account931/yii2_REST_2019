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
    ];
	
    public $js = [
	      'js/W3school/w3school-js.js',  
		  //'js/W3school/jqpool.js', //NOT USED???
		  'js/W3school/multi-step-form-with-progerssBar-and-jqValidation-plugin.js',   //used in Multi Step Form with JQ Validation Plug-in and Progress Bar
          'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js', // JQ Validate plugin. Used in Multi Step Form with JQ Validation Plug-in and Progress Bar
		  
		  'js/W3school/waze_gallery/jquery-1.4.2.min',
		  'js/W3school/waze_gallery/jquery-ui-1.8.4.custom.min.js', // Waze Galery JS
		  'js/W3school/waze_gallery/jquery.vec.timerGallery_ts.js', // Waze Galery JS
		  'js/W3school/waze_gallery/jquery.colorbox-min.js',        // Waze Galery JS
	    
    ];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
