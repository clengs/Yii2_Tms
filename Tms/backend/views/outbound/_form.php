<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OutboundModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outbound-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'terminalId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'storehouseId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adminId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outboundTime')->textInput() ?>

    <?= $form->field($model, 'outboundQuantity')->textInput() ?>

    <?= $form->field($model, 'destinationId')->textInput() ?>

    <?= $form->field($model, 'receiverId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'create') : Yii::t('common', 'update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
