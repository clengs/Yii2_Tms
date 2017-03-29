<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\adminModel;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuditingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '消息处理列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auditing-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <!--   <p>
        <?= Html::a('Create Auditing Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [ 
              'attribute'=>'id',
              'format'=>'raw',
              'value'=> function($data){return Html::a($data->id,['process?id='.$data->id],['title' => '审核']);}
            ],
            'title',
            //'proposer',
            [
                'attribute' => 'proposer',
                'value' => function($model){
                    $userModel = adminModel::findOne($model->proposer);
                    return $userModel->username;
                },
            ],
            'proposer_phone',
            'proposer_email:email',
            // 'proposer_contry',
            'require_belongto',
            'terminals',
            'time',
            // 'description:ntext',
            // 'comments:ntext',
            // 'file',
            // 'aprove_record:ntext',
            //'aprover',
            [
                'attribute' => 'aprover',
                'value' => function($model){
                    $userModel = adminModel::findOne($model->aprover);
                    return $userModel->username;
                },
            ],
            // 'aprover_phone',
            // 'aprover_email:email',
            // 'approver_idea:ntext',
            // 'next_approver',
            
            [
                'attribute' => 'remain_str',
                'value' => function($model){
                    switch ($model->remain_str) {
                        case '0':
                            return '处理中...';
                            break;
                        case '1':
                            return '已归档!';
                            break;
                        default:
                            break;
                    } 
                },
            ],
        ],
    ]); ?>
</div>
