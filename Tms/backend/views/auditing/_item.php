<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="container">
	<div class="col-md-12">
		<?= Html::a($model->proposer."-".$model->title."-".$model->time, ['auditing/process', 'id' => $model->id], ['class' =>'fa'])?>
	</div>
</div>