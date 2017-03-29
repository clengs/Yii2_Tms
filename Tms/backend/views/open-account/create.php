<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OpenAccountModel */

$this->title = Yii::t('common', 'addAccount');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'openAccount'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="open-account-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
