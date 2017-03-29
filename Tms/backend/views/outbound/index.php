<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OutboundSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'outboundModel');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outbound-model-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('出库', ['outterminal'], ['class' => 'btn btn-success']) ?>
    </p> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => [
            // [
            //    'class'=>CheckboxColumn::className(),
            //    'name'=>'id',
            //    'headerOptions' => ['width'=>'30'],
            //    'footer' => '<button href="#" class="btn btn-default btn-xs btn-delete" url="'. Url::toRoute('outbound/create') .'">派发</button>',
            //    'footerOptions' => ['colspan' => 5],
            // ],

            ['class' => 'yii\grid\SerialColumn'],

            [ 
              'attribute'=>'terminalId',
              'format'=>'raw',
              'value'=> function($data){return Html::a('下载',[$data->terminalId],['title' => '文件']);} 
            ],
            'storehouseId',
            'adminId',
            'outboundTime',
            'outboundQuantity',
            'destinationId',
            'receiverId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
