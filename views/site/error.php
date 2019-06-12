<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $message; //$name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br("<span class='glyphicon glyphicon-level-up' style='font-size:38px;'></span><br>We are deeply sorry. " .Html::encode($message)) ?>
    </div>

	<br>
    <p>
        MY ERROR TEXT. <br> The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you <span class='glyphicon glyphicon-phone-alt' style='font-size:12px;margin-left:1%;'></span>
    </p>
	

</div>
