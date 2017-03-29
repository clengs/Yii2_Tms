<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'messageModel');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'msgId',
            'senderID',
            'senderName',
            'recipientID',
            'recipientName',
            'title',
            'content:ntext',
            'sendtime',
            'state' => [
                'label' => Yii::t('common', 'mstate'), 
                'attribute' => 'state',
                'filter' => [
                    '' => '请选择',
                    '1' => '已读',
                    '0' => '未读',
                ],

                'value' => function($model){
                    return ($model->state == 1)?'已读':'未读';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
