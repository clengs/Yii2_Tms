<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ApplicationModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposer_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposer_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposer_contry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'require_belongto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aprover')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'terminals')->textInput() ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file')->textInput() ?>
    
    
    <?= Html::img($model->file, ['alt' => 'My logo', 'width'=> '40%', 'class' => 'img img-rounded']) ?>

    

    <!-- <?= $form->field($model, 'aprove_record')->textarea(['rows' => 6]) ?> -->

    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
