<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AreaModel */

$this->title = $model->childId;
$this->params['breadcrumbs'][] = ['label' => 'Area Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->childId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->childId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'childId',
            'childMenu',
            'childUrl:url',
            'parentId',
            'parentMenu',
            'level',
            'parentUrl:url',
        ],
    ]) ?>

</div>
