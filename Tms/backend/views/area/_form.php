<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AreaModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'childId')->textInput() ?>

    <?= $form->field($model, 'childMenu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'childUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parentId')->textInput() ?>

    <?= $form->field($model, 'parentMenu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'parentUrl')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
