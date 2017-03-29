<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AreaModel */

$this->title = 'Create Area Model';
$this->params['breadcrumbs'][] = ['label' => 'Area Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
