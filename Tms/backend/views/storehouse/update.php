<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StorehouseModel */

$this->title = $model->store_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'storehouseModel'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->store_id, 'url' => ['view', 'id' => $model->store_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="storehouse-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
