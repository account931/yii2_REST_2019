
<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\ActiveForm;

use app\assets\Bot_AssertOnly;   // use your custom asset
Bot_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name of Class)

/* @var $this yii\web\View */
/* @var $model app\models\Wpress\WpressBlogPost */

$this->title = Yii::t('app', 'Bot chatting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grid'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wpress-blog-post-create">

    <h1>
	<?= Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/chat.png' , $options = ["id"=>"","margin-left"=>"23%","class"=>"","width"=>"12%","title"=>"click to add a new one"]); ?>
	<?= Html::encode($this->title) ?><i class="fa fa-folder-open-o" style="font-size:36px; margin-left:0.4em;"></i>
	</h1>
	

	
   
   
   
   	<?php
	//------------------------------------------------------------------------------------------------------------
	//passing PHP var $url()(to external Js-> bot_form.js. Requires {use yii\helpers\Json;}
	$urlZ = Yii::$app->request->baseUrl . "/bot/ajax-reply"; //form url to ajax php file
	
    $this->registerJs(
           "var urlXX ='" . $urlZ . "';",    //".\yii\helpers\Json::encode($model).";", 
           yii\web\View::POS_HEAD, 
           'script-name-must-be-different'
     );
	 //End passing php obj to js-----------------------------------------------------------------------
	?>
	
	
	
	
	 	<?php
	//------------------------------------------------------------------------------------------------------------
	//passing PHP object $autoCompleteHint((to external Js-> bot_form.js to use it as autocomplete hints. Requires {use yii\helpers\Json;}
    $this->registerJs(
           "var aucompleteX =".\yii\helpers\Json::encode($autoCompleteHint).";", 
           yii\web\View::POS_HEAD, 
           'script-name-must-be-different2'
     );
	 //End passing php obj to autocomplete.js-----------------------------------------------------------------------
	?>
	
	
	
	<!--  Chat window -->
	 <div class="col-lg-8 col-md-8 col-sm-8 shadowX" id="allMsg">
	 </div>
   
   
   
    <?php $form = ActiveForm::begin(['id' => 'formX',]); 
     echo $form->field($model, 'yourInput')->textInput(['maxlength' => true, 'id'=>'txtMsg', 'placeholder' => 'your text...' ])->label(false); //your text input
    ?>
 	  <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Say'), ['class' => 'btn btn-primary shadowX' , 'id'=>'sayButton']) ?>
     </div>
   <?php ActiveForm::end(); ?>


</div>










