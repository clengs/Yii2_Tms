<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\adminModel;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OpenAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'openAccount');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="open-account-model-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'terminalId',
            //'terminalName',
            'consumerName',
            'consumerAccount',
            'consumerPhone',
            'consumerAddress',
            'time',
            'end_time',
            'state' =>
            [
                'label' => Yii::t('common', 'state'), 
                'attribute' => 'state',
                'filter' =>[
                    '0' => '未使用',
                    '1' => '使用中',
                    '2' => '回收',
                ],
                'value' => function($model){
                    return ($model->state == 1)?'使用中':'回收';
                }
            ],
            [
                'attribute' => 'operater',
                'value' => function($model){
                    $usermodel = adminModel::findOne($model->operater);
                    return $usermodel->username;
                }
            ],
        ],
    ]); ?>
</div>
