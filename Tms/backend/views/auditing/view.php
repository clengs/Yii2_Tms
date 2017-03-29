<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuditingModel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Auditing Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auditing-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'title',
            'proposer',
            'proposer_phone',
            'proposer_email:email',
            'proposer_contry',
            'require_belongto',
            'terminals',
            'time',
            'description:ntext',
            'comments:ntext',
            'file',
            'aprove_record:ntext',
            'aprover',
            'aprover_phone',
            'aprover_email:email',
            'approver_idea:ntext',
            'next_approver',
        ],
    ]) ?>

</div>
