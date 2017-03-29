<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ApplicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'proposer') ?>

    <?= $form->field($model, 'proposer_phone') ?>

    <?= $form->field($model, 'proposer_email') ?>

    <?php // echo $form->field($model, 'proposer_contry') ?>

    <?php // echo $form->field($model, 'require_belongto') ?>

    <?php // echo $form->field($model, 'aprover') ?>

    <?php // echo $form->field($model, 'terminals') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'aprove_record') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
