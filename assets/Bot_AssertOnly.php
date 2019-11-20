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
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Bot_AssertOnly extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	
    public $css = [
        //'css/site.css',
		'//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',  //CDN autocomplete css , // does not mean anything, it works!!!!
		'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css', //Sweet Alert CSS

    ];
	
    public $js = [
	    'js/bot/bot_form.js', //form
		'js/bot/autocomplete.js', //autocomplete mine
		'https://code.jquery.com/ui/1.12.1/jquery-ui.js', //JS lib for autocomplete
		'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js', //Sweet Alert JS

    ];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
