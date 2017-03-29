<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuditingModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auditing-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposer_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposer_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposer_contry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'require_belongto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'terminals')->textInput() ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aprove_record')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aprover')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aprover_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aprover_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approver_idea')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'next_approver')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
