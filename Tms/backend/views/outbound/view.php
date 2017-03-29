<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OutboundModel */

$this->title = $model->terminalId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'outboundModel'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outbound-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'update'), ['update', 'terminalId' => $model->terminalId, 'storehouseId' => $model->storehouseId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'delete'), ['delete', 'terminalId' => $model->terminalId, 'storehouseId' => $model->storehouseId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'terminalId',
            'storehouseId',
            'adminId',
            'outboundTime',
            'outboundQuantity',
            'destinationId',
            'receiverId',
        ],
    ]) ?>

</div>
