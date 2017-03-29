<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//引入模态窗口
include(dirname(__DIR__)."/area/areamodal.php")
/* @var $this yii\web\View */
/* @var $model backend\models\StorehouseModel */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="storehouse-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'store_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'store_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'store_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'store_acre')->textInput() ?>

   
    <?= $form->field($model, 'store_belong',['inputTemplate' => 
                                    '<div class="input-group">
                                        {input}
                                        <span type="button" data-toggle="modal" data-target="#areaModal" class="input-group-addon" id="storechoosebtn" onclick="setId(\'storehousemodel-store_belong\', \'storehousemodel-store_manager\')">
                                            <span class="glyphicon glyphicon-th-large" aria-hidden="true">
                                            </span>
                                        </span>
                                    </div>'])->dropDownList([''=>''],['readonly' => 'true']) ?>
 
    

    <?= $form->field($model, 'store_manager')->dropDownList([''=>''],['readonly' => 'true']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'create') : Yii::t('common', 'update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

