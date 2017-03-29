<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\adminModel */

$this->title =  "工号:".$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'adminModel'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

<div>
	<input type="text" name="username" value=<?= $model->username?>> 
</div>
