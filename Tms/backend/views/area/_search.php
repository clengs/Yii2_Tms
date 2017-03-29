<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AreaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'childId') ?>

    <?= $form->field($model, 'childMenu') ?>

    <?= $form->field($model, 'childUrl') ?>

    <?= $form->field($model, 'parentId') ?>

    <?= $form->field($model, 'parentMenu') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'parentUrl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
