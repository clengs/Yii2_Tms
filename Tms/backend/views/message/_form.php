<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MessageModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'msgId')->textInput(['maxlength' => true]) ?> -->

   <!--  <?= $form->field($model, 'senderID')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'senderName')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'recipientID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recipientName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sendtime')->textInput() ?>

   <!--  <?= $form->field($model, 'state')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'create') : Yii::t('common', 'update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
