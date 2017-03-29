<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ApplicationModel */

$this->title = 'Update Application Model: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Application Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="application-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
