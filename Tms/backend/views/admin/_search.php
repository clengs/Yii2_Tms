<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\adminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

<!--     <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?= $form->field($model, 'accessToken') ?> -->

    <?php $form->field($model, 'address') ?>

    <?php $form->field($model, 'contact') ?>

    <?php $form->field($model, 'email') ?>

    <?php  $form->field($model, 'grade') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php $form->field($model, 'areaId') ?>

    <?php $form->field($model, 'areaName') ?>

    <?php // echo $form->field($model, 'mobilePhone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
