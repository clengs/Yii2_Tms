<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OutboundSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outbound-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'terminalId') ?>

    <?= $form->field($model, 'storehouseId') ?>

    <?= $form->field($model, 'adminId') ?>

    <?= $form->field($model, 'outboundTime') ?>

    <?= $form->field($model, 'outboundQuantity') ?>

    <?php $form->field($model, 'destinationId') ?>

    <?php $form->field($model, 'receiverId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
