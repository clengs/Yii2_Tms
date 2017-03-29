
<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\datetimepicker\src\DateTimePicker;

	//引入模态窗口
	include(dirname(__DIR__)."/area/storehouseModal.php");

	$this->title = Yii::t('common', 'add');
	$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'terminalInbound'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
	<?php $form= ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
		
		<?= $form->field($model, 'operater')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->username,'readonly'=>true])?>

		<?= $form->field($model, 'inboundTime')->widget(DateTimePicker::className(), [
	                                            'language' => 'zh-CN',
	                                            'size' => 'ms',
	                                            'inline' => false,
	                                            'clientOptions' => [
	                                                'startView' => 1,
	                                                'minView' => 0,
	                                                'maxView' => 1,
	                                                'autoclose' => true,
	                                                'linkFormat' => 'yyyy-mm-dd hh:ii:ss', 
	                                                'todayBtn' => true
	                                            ]]);?>

		<?= $form->field($model, 'manufacturer')->dropDownList(['1' => '华为', '2' => '中兴', '3'=>'其他'])?>

		<?= $form->field($model, 'storeId', ['inputTemplate' => 
											'<div class="input-group">
												{input}
												<span type="button" data-toggle="modal" data-target="#storehouseModal" class="input-group-addon" id="storechoosebtn" onclick="setId(\'terminalmodel-storeid\',null)">
													<span class="glyphicon glyphicon-th-large" aria-hidden="true">
													</span>
												</span>
											</div>',])->dropDownList(['' => '请选择'], ['readonly' => 'true'])?>

		<?= $form->field($model, 'excelfile')->fileInput()?>

		<div class="row">
			<div class="form-group col-md-6">
		        <?= Html::submitButton('确定' , ['class' => 'btn btn-primary btn-lg btn-block']) ?>
		    </div>

			<div class="form-group col-md-6">
				<?= Html::resetButton('重置', ['class' =>'btn btn-primary btn-lg btn-block'])?>
			</div>
		</div>

	<?php ActiveForm::end();?>
</div>

