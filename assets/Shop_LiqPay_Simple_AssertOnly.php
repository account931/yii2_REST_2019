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
class Shop_LiqPay_Simple_AssertOnly extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	
    public $css = [
        'css/ShopLiq_Pay_Simple/main.css',
		'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css', //Sweet Alert CSS
		
		

    ];
	
    public $js = [
	     'js/ShopLiq_Pay_Simple/main.js',
		//'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js',
		 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js', //Sweet Alert JS
    ];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
