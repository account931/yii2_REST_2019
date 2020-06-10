<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\assets\MyWidget_AssertOnly;   // use your custom asset
MyWidget_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name


$this->title = 'My Widget';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is a test widget
    </p>


	<?php
	//call the widget
	echo \app\componentsX\widgets\HiWidget::widget();
	?>

	
	

</div>
