<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MessageModel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'update'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->msgId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="message-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
