<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\adminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','adminModel');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('common', 'add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'layout' => '{items}<div class="text-right tooltio-demo">{pager}</div>',
        'pager' => [
            'firstPageLabel' => 'First',
            'prevPageLabel' => 'Prev',
            'nextPageLabel' => 'Next',
            'lastPageLabel' => 'Last',
        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            // 'password',
            // 'auth_key',
            // 'accessToken',
            'address',
            'contact',
            'email:email',
            'grade',
            //'avatar',
            'areaId',
            'areaName',
            'mobilePhone',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '',
            ],

        ],
    ]); ?>
</div>

