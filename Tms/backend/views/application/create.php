<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ApplicationModel */

$this->title = 'Create Application Model';
$this->params['breadcrumbs'][] = ['label' => 'Application Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
