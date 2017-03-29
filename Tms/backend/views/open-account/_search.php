<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OpenAccountSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="open-account-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'terminalId') ?>

    <?= $form->field($model, 'terminalName') ?>

    <?= $form->field($model, 'consumerName') ?>

    <?= $form->field($model, 'consumerAccount') ?>

    <?php // echo $form->field($model, 'consumerPhone') ?>

    <?php // echo $form->field($model, 'consumerAddress') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'operater') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
