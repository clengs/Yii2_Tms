<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sign-overlay"></div>
<div class="signpanel"></div>

<div class="panel signin">
	<div class="panel-heading">
		<h4 class="panel-title">中国联通毕节分公司终端管理系统</h4>
	</div>
	<div class="panel-body">
		<div class="or">or</div>

		<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
			<?=$form->field($model, 'username', [
				'inputOptions' => [
					'placeholder' => '请输入账户',
				],
				'inputTemplate' => 
					'<div class="input-group">
						<span class = "input-group-addon">
							<i class = "fa fa-user">
							</i>
						</span>{input}
					</div>',
			]) ?>

			<?=$form->field($model, 'password', [
				'inputOptions' => [
					'placeholder' => '请输入密码',
				],
				'inputTemplate' => 
					'<div class="input-group">
						<span class = "input-group-addon">
							<i class = "fa fa-lock">
							</i>
						</span>{input}
					</div>',
			])->passwordInput() ?>

		<div>
			<a href="#" class="forget">忘记密码？</a>
		</div>

		<div class="form-group">
			<?=Html::submitButton('登录', ['class' => 'btn btn-primary btn-quirk btn-block btn-success', 'name' => 'login-button']) ?>
		</div>

		<?php ActiveForm::end();?>
	</div>
</div>