<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\TerminalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = "库存";
    $this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'terminalInbound'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="terminal-model-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'serialId',
            'storeId',
            'quantity',
            'inboundTime',
            'manufacturer',
            'operater',

            ['class' => 'yii\grid\ActionColumn', 'header' => '管理操作'],
        ],
    ]); ?>
    
    <p>
        <?= Html::a(Yii::t('common', '导出报表'), [''], ['class' => 'btn btn-success']) ?>
    </p>
</div>
