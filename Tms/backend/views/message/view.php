<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MessageModel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'messageModel'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'update'), ['update', 'id' => $model->msgId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'delete'), ['delete', 'id' => $model->msgId], [
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
            'msgId',
            'senderID',
            'senderName',
            'recipientID',
            'recipientName',
            'title',
            'content:ntext',
            'sendtime',
            'state',
        ],
    ]) ?>

</div>
