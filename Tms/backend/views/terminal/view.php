<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TerminalModel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'terminalInbound'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terminal-model-view">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'serialId' => $model->serialId, 'storeId' => $model->storeId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'serialId' => $model->serialId, 'storeId' => $model->storeId], [
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
            'serialId',
            'storeId',
            //'name',
            //'model',
            //'verder',
            'quantity',
            //'price',
            'inboundTime',
            'manufacturer',
            //'produceTime',
            'operater',
        ],
    ]) ?>

</div>
