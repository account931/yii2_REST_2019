<?php
/**
 * @link http://www.yiiframework.com/
 * @Assets for Yii2 widget-> Image comparison slider
 * @
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for my widget.
 * @author 
 * @since 2.0
 */
 
class MyWidget_AssertOnly extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	
    public $css = [
		'css/MyWidget/myWiget.css',      //W3school Exmaple of Image Comparison (pure JS) widget css
		'css/MyWidget/twentytwenty.css', //Exmaple of Images Comparison JQ Plugin -> Twentytwenty plugin
    ];
	
    public $js = [
	     'js/MyWidget/myWiget.js',              //W3school Exmaple of Image Comparison (pure JS) widget  JS
		 
		 //'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', //Exmaple of Images Comparison JQ Plugin -> Twentytwenty plugin
		 'js/MyWidget/jquery.twentytwenty.js',  //Exmaple of Images Comparison JQ Plugin -> Twentytwenty plugin
		 'js/MyWidget/jquery.event.move.js',    //Exmaple of Images Comparison JQ Plugin -> Twentytwenty plugin
    ];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
