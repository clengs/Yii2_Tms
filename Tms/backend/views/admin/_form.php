<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//引入模态窗口
include(dirname(__DIR__)."/area/areamodal.php")

/* @var $this yii\web\View */
/* @var $model backend\models\adminModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-model-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true,]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade')->dropDownList(['1' => '管理员', '2' =>'营销中心', '3' => '渠道代理'])?>

    <?= $form->field($model, 'avatarfile')->fileInput() ?>

    <?= $form->field($model, 'areaId',['inputTemplate' => 
                                    '<div class="input-group">
                                        {input}
                                        <span type="button" data-toggle="modal" data-target="#myModal" class="input-group-addon" id="storechoosebtn" onclick="setId(\'adminmodel-areaid\')">
                                            <span class="glyphicon glyphicon-th-large" aria-hidden="true">
                                            </span>
                                        </span>
                                    </div>'])->dropDownList(['' => ''], ['readonly'=>'true']) ?>

    <?= $form->field($model, 'areaName',['inputTemplate' => 
                                    '<div class="input-group">
                                        {input}
                                        <span type="button" data-toggle="modal" data-target="#myModal" class="input-group-addon" id="storechoosebtn" onclick="setId(\'adminmodel-areaname\')">
                                            <span class="glyphicon glyphicon-th-large" aria-hidden="true">
                                            </span>
                                        </span>
                                    </div>'])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobilePhone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'create') : Yii::t('common', 'create'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
