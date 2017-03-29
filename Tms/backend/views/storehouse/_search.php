<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StorehouseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="storehouse-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'store_id') ?>

    <?= $form->field($model, 'store_name') ?>

    <?= $form->field($model, 'store_address') ?>

    <?= $form->field($model, 'store_acre') ?>

    <?= $form->field($model, 'store_belong') ?>

    <?php // echo $form->field($model, 'store_manager') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
