<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TerminalModel */

$this->title = Yii::t('common', 'update').':' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Terminal Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'serialId' => $model->serialId, 'storeId' => $model->storeId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="terminal-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
