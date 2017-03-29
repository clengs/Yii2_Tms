<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="post">
    <?= HtmlPurifier::process($model->serialId) ?>
</div>