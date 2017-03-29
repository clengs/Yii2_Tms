<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AreaModel */

$this->title = 'Update Area Model: ' . $model->childId;
$this->params['breadcrumbs'][] = ['label' => 'Area Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->childId, 'url' => ['view', 'id' => $model->childId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="area-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
