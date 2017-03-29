<!-- 工单申请 -->
<?php 
	use yii\jui\DatePicker;
	use yii\bootstrap\ActiveForm;
	use yii\datetimepicker\src\DateTimePicker;


	$this->params['breadcrumbs'][] = ['label' => Yii::t('common','applicationModel'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = "申请";

	//引入模态窗口
	include(dirname(__DIR__)."/area/areamodal.php");
?>

<div class="container bs-docs-container">
	<!--工单申请表格-->
	<div class="row">
		<div class="col-md-12" role='main'>
			<div class="bs-docs-section">
				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'title')->textInput()?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'proposer')->textInput(['readonly' => true, 'value'=> Yii::$app->user->identity->id])?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'proposer_phone')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->mobilePhone])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'proposer_email')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->email])?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'proposer_contry')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->areaName])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'require_belongto',['inputTemplate' => 
                                        '<div class="input-group">
                                            {input}
                                            <span type="button" data-toggle="modal" data-target="#areaModal" class="input-group-addon" id="storechoosebtn" onclick="setId(\'applicationmodel-require_belongto\',\'applicationmodel-aprover\')">
                                                <span class="glyphicon glyphicon-th-large" aria-hidden="true">
                                                </span>
                                            </span>
                                        </div>',])->dropDownList(['' => ''], ['readonly' => 'true'])?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'aprover')->dropDownList(['' => ''], ['readonly' => 'true'])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'terminals')->textInput()?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'time')->widget(DateTimePicker::className(), [
                                            'language' => 'zh-CN',
                                            'size' => 'ms',
                                            'inline' => false,
                                            'clientOptions' => [
                                                'startView' => 1,
                                                'minView' => 0,
                                                'maxView' => 1,
                                                'autoclose' => true,
                                                'linkFormat' => 'yyyy-mm-dd 
                                                 hh:ii:ss', 
                                                'todayBtn' => true
                                            ]]);?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'description')->textarea(['rows' => 6])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'comments')->textarea(['rows'=>6])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
                    			<?= $form->field($model, 'file')->fileInput(['class' => 'file'])?>
							</div>
						</div>
						<div class="row">
							<p></p>
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary btn-lg btn-block">确定</button>
							</div>
						</div>
				<?php ActiveForm::end()?>
			</div>
	</div>
</div>