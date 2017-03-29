<?php
	use yii\helpers\Html;
	use yii\widgets\ListView;

	$this->params['breadcrumbs'][]="message";
	$this->params['breadcrumbs'][] = "message list";

?>

<?=ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'viewParams' => [
        'fullView' => true,
        'context' => 'main-page',
    ],
]);
?>