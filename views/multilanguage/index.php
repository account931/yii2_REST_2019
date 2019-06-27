<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
//use yii\helpers\BaseHtml;
/* @var $this yii\web\View */

$this->title = 'Multilanguage';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <h1><?= Html::encode($this->title) ?>  <span class="glyphicon glyphicon-ok-sign"></span> </h1>
</div>


<div class="col-sm-12 col-xs-12>

 <?php
 
    $items = [
        '0' => 'English',
        '1' => 'Russian',
        '2'=>'My custom language'
    ];
    $params = [
        'prompt' => 'Select language...'
    ];
 
 
 //START FORM WITH DROPDOWN--------
  $form = ActiveForm::begin(['id' => 'mlt']);
 /*$form = ActiveForm::begin([
        //'method' => 'post',
        //'action' => Url::to(['/multilanguage/setlanguage'])
		]);*/
		
	
    //echo $form->field($modelX, 'q')->dropDownList($items,$params); // dropDownList($items,$params)== arg[array of List, array with options]
	echo $form->field($modelX, 'q')->textInput(['autofocus' => true]);?>
	
	<div class="form-group">
       <?= Html::submitButton('Get new token', ['class' => 'btn btn-primary', 'name' => 'setLan']);?>
	</div>
 
  <?php ActiveForm::end();
  //END FORM WITH DROPDOWN-----------
  
  
  
  
  
  echo "<hr>";
  
  //TRANSLATION TEST -----------------
  \Yii::$app->language = 'ru-RU'; //set the language u want to use //now available: 'ru-RU', 'en-US', 'my-Lang' 
  echo "<h4>Current language is<b> " . \Yii::$app->language . "</b></h4>"; //echo current language
  
  echo \Yii::t('app', 'This is a string to translate!') . "<br>"; //echo engl or russ or my-Lang string according to settings
  echo \Yii::t('app', 'This is a string to translate!'); //echo engl or russ string according to settings
  
  
  
?> 

</div>