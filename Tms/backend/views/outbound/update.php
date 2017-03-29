<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OutboundModel */

$this->title = Yii::t('common', 'update') .":". $model->terminalId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'outboundModel'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->terminalId, 'url' => ['view', 'terminalId' => $model->terminalId, 'storehouseId' => $model->storehouseId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outbound-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
