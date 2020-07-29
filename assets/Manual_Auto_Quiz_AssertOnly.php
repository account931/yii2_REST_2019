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
class Manual_Auto_Quiz_AssertOnly extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	
    public $css = [
        
		'css/Manual-Auto-Quiz/my-manual-quiz-builder.css', // my-manual-quiz-builder CSS	
    ];

	
	
    public $js = [
	      
		  'js/Manual-Auto-Quiz/my-manual-quiz-builder.js', // my-manual-quiz-builder

		  

    ];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
