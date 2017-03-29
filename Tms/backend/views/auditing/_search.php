<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuditingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auditing-model-search">

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

    <?php // echo $form->field($model, 'terminals') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'aprove_record') ?>

    <?php // echo $form->field($model, 'aprover') ?>

    <?php // echo $form->field($model, 'aprover_phone') ?>

    <?php // echo $form->field($model, 'aprover_email') ?>

    <?php // echo $form->field($model, 'approver_idea') ?>

    <?php // echo $form->field($model, 'next_approver') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
