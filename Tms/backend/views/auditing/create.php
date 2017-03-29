<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AuditingModel */

$this->title = 'Create Auditing Model';
$this->params['breadcrumbs'][] = ['label' => 'Auditing Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auditing-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
