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
   //if no language is set,set it to "en-US" by default/ Otherwise, it display no lanaguage status during the 1st visit
   if(!\Yii::$app->language) {
	   \Yii::$app->language = 'en-US';
	}
	
	
 /*
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
  //$form = ActiveForm::begin([
        //'method' => 'post',
        //'action' => Url::to(['/multilanguage/setlanguage'])
		//]);
		
	
    //echo $form->field($modelX, 'q')->dropDownList($items,$params); // dropDownList($items,$params)== arg[array of List, array with options]
	echo $form->field($modelX, 'q')->textInput(['autofocus' => true]);
	
	
       echo Html::submitButton('Change Language(FALSE)', ['class' => 'btn btn-primary', 'name' => 'setLan']);?>
	
 
  <?php ActiveForm::end(); 
  */
  //END FORM WITH DROPDOWN-----------
  
 
  ?>
  
  
  
  <!-- Dropdown with languages, now available: 'ru-RU', 'en-US', 'my-Lang', 'dk-DK' -->
  <!-- Checks whta current language is to put check icon there -->
  <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Change Language
          <span class="caret"></span></button>
              <ul class="dropdown-menu">
                  <li><a class="small-flag" href="index?l=en-US"> <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/images/flags/en-US.svg" alt="fl"/> English                <?php if(\Yii::$app->language == "en-US") {echo '<img src='.Yii::$app->getUrlManager()->getBaseUrl().'/images/checkmark.png alt="f"/>';} ?></a></li>
				  <li><a class="small-flag" href="index?l=ua-UA"> <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/images/flags/ua-UA.svg" alt="fl"/> Ukrainian              <?php if(\Yii::$app->language == "ua-UA") {echo '<img src='.Yii::$app->getUrlManager()->getBaseUrl().'/images/checkmark.png alt="f"/>';} ?></a></li>
                  <li><a class="small-flag" href="index?l=ru-RU"> <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/images/flags/ru-RU.svg" alt="fl"/> Russian                <?php if(\Yii::$app->language == "ru-RU") {echo '<img src='.Yii::$app->getUrlManager()->getBaseUrl().'/images/checkmark.png alt="f"/>';} ?></a></li>
				  <li><a class="small-flag" href="index?l=dk-DK"> <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/images/flags/dk-DK.svg" alt="fl"/> Dansk                  <?php if(\Yii::$app->language == "dk-DK") {echo '<img src='.Yii::$app->getUrlManager()->getBaseUrl().'/images/checkmark.png alt="f"/>';} ?></a></li>
                  <li><a class="small-flag" href="index?l=my-Lang"> <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/images/flags/my-Lang.svg" alt="fl"/> My custom language <?php if(\Yii::$app->language == "my-Lang") {echo '<img src='.Yii::$app->getUrlManager()->getBaseUrl().'/images/checkmark.png alt="f"/>';} ?></a></li>
              </ul>
   </div> <br>
 <!-- Dropdown with languages, now available: 'ru-RU', 'en-US', 'my-Lang', 'dk-DK' --> 
  
  
  
  
  
  <?php
  echo "<hr>";

  
  
  //TRANSLATION TEST -----------------
  //\Yii::$app->language = 'ru-RU'; //set the language u want to use //now available: 'ru-RU', 'en-US', 'my-Lang', 'dk-DK'
  echo "<h4>Current language is<b> " . \Yii::$app->language . "</b></h4>"; //echo current language
  $flag = \Yii::$app->language . ".svg"; //form the img file, i.e ru_RU.svg
  echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/images/flags/$flag" , $options = ["id"=>"","margin-left"=>"%","class"=>"","width"=>"8%","title"=>"flag"] ); //display relevant flag
  echo "<br><br>";
  
  echo \Yii::t('app', 'This is a string to translate!') . "<br>"; //echo engl or russ or my-Lang string according to settings
  echo \Yii::t('app', 'This is a string to translate!'); //echo engl or russ string according to settings
  
  
  
?> 

</div>