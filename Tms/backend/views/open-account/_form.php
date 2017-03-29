<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\datetimepicker\src\DateTimePicker;
use backend\models\TerminalModel;

/* @var $this yii\web\View */
/* @var $model backend\models\OpenAccountModel */
/* @var $form yii\widgets\ActiveForm */
date_default_timezone_set("Asia/Shanghai");
?>

<div class="open-account-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'terminalId')->dropDownList(ArrayHelper::map($data, 'serialId', 'serialId')) ?>

    <?= $form->field($model, 'terminalName')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'consumerName')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'consumerAccount')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'consumerPhone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'consumerAddress')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'operater')->textInput(['maxlength' => true, 'value'=> Yii::$app->user->identity->username, 'readonly'=>'true']) ?>
        </div>
        <div class="col-md-6">
             <?= $form->field($model, 'state')->dropDownList([''=>'','1' => '使用', '2'=> '回收']) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'time')->widget(DateTimePicker::className(), [
                                            'language' => 'zh-CN',
                                            'size' => 'ms',
                                            //'template' => '{input}{reset}{button}',
                                            //'pickButtonIcon' => 'glyphicon glyphicon-time',
                                            'inline' => false,
                                            'clientOptions' => [
                                                'startView' => 1,
                                                'minView' => 0,
                                                'maxView' => 1,
                                                'autoclose' => true,
                                                'linkFormat' => 'yyyy-mm-dd 
                                                 hh:ii:ss', 
                                                'todayBtn' => true
                                            ]]);?>
        </div>
         <div class="col-md-6">
            <?= $form->field($model, 'end_time')->widget(DateTimePicker::className(), [
                                            'language' => 'zh-CN',
                                            'size' => 'ms',
                                            //'template' => '{input}{reset}{button}',
                                            //'pickButtonIcon' => 'glyphicon glyphicon-time',
                                            'inline' => false,
                                            'clientOptions' => [
                                                'startView' => 1,
                                                'minView' => 0,
                                                'maxView' => 1,
                                                'autoclose' => true,
                                                'linkFormat' => 'yyyy-mm-dd 
                                                 hh:ii:ss', 
                                                'todayBtn' => true
                                            ]]);?>
        </div>
    </div>
    

   

    
    <br>
    <!-- 水平分割线 -->
    <hr style="border:1px dashed #7B7B7B" width="100%" size="1" />

    <div class="form-group col-center-block">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'create') : Yii::t('common', 'update'), 
            [
                'class' => $model->isNewRecord ? 'btn btn-success btn-large btn-block' : 'btn btn-primary',
            ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>

<style type="text/css">
    .col-center-block {  
        float: none;  
        display: block;  
        margin-left: auto;  
        margin-right: auto;  
    }
</style>
