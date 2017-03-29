<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Application Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('终端申请', ['application'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'proposer',
            'proposer_phone',
            'proposer_email:email',
            // 'proposer_contry',
            'require_belongto',
            'aprover',
            'terminals',
            'time',
            // 'description:ntext',
            // 'comments:ntext',
            // [
            //     'attribute'=>'file',
            //     'format' => 'raw',
            //     'value' => function($model){
            //         return Html::img($model->file);
            //     }
            // ],
            // 'aprove_record:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
