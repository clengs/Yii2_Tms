<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TerminalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terminal-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="row">
        <div class="col-md-4">
             <?= $form->field($model, 'storeId')->label(false) ?>
        </div>
        <div class="col-md-8">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary','id'=>'searchbtn']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
