<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\datetimepicker\src\DateTimePicker;

//引入模态窗口
include(dirname(__DIR__)."/area/storehouseModal.php")

/* @var $this yii\web\View */
/* @var $model backend\models\TerminalModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terminal-model-form container">

    
    <?php $form = ActiveForm::begin(); ?>

    <div>
       <?= $form->field($model, 'serialId')->textInput(['maxlength' => true]) ?> 
    </div>
    

    <?= $form->field($model, 'operater')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->username,'readonly'=>true])?>

    <?= $form->field($model, 'inboundTime')->widget(DateTimePicker::className(), [
                                            'language' => 'zh-CN',
                                            'size' => 'ms',
                                            'inline' => false,
                                            'clientOptions' => [
                                                'startView' => 1,
                                                'minView' => 0,
                                                'maxView' => 1,
                                                'autoclose' => true,
                                                'linkFormat' => 'yyyy-mm-dd hh:ii:ss', 
                                                'todayBtn' => true
                                            ]]);?>

    <?= $form->field($model, 'manufacturer')->dropDownList(['1' => '华为', '2' => '中兴', '3'=>'其他'])?>

    <?= $form->field($model, 'storeId', ['inputTemplate' => 
                                        '<div class="input-group">
                                            {input}
                                            <span type="button" data-toggle="modal" data-target="#storehouseModal" class="input-group-addon" id="storechoosebtn" onclick="setId(\'terminalmodel-storeid\',null)">
                                                <span class="glyphicon glyphicon-th-large" aria-hidden="true">
                                                </span>
                                            </span>
                                        </div>',])->dropDownList(['' => '请选择'], ['readonly' => 'true'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'create') : Yii::t('common', 'update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?= Html::a(Yii::t('common', 'return'), ['index'], ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
