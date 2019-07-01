<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
//use yii\helpers\BaseHtml;
/* @var $this yii\web\View */

$this->title = 'Booking';
$this->params['breadcrumbs'][] = $this->title;
?>





  <div class="">
    <h1><?= Html::encode($this->title) ?>  <span class="glyphicon glyphicon-ok-sign"></span> </h1>
  </div>


  <div class="row">
    <div class="col-sm-12 col-xs-12">
    <h3><?php echo "Today: " . date('j-M-D-Y');  // today day ?></h3>
	<hr><br>
 
    <?php
	 echo '<div class="col-sm-3 col-xs-5 my-month badge badge1"><span class="v">' . $current  . '</div>'; //current month
	
	 for ($i = 1; $i < 6; $i++){    //($i=1; $i<4; $i++) // for 5 future months
	     echo '<div class="col-sm-3 col-xs-5 my-month badge badge1"> <span class="v">' . ${'current'.$i}  . '</span></div>';
	 }
	?>





    </div><!-- END class="col-sm-12 col-xs-12" -->
  </div> <!-- END class="row" -->