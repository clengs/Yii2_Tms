<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OutboundModel */

$this->title = Yii::t('common', 'add');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'outboundModel'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outbound-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
