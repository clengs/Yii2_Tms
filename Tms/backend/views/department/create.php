<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DepartmentModel */

$this->title = Yii::t('common', 'add');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'departmentModel'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
