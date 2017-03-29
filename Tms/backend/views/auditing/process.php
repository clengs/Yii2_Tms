<!-- 工单处理页面 -->
<?php 
	use yii\helpers\Html;
	use yii\jui\DatePicker;
	use yii\bootstrap\ActiveForm;

	$this->params['breadcrumbs'][] = "message";
	$this->params['breadcrumbs'][] = "工单处理";

	//引入模态窗口
	include(dirname(__DIR__)."/area/areamodal.php");
?>
<meta charset="UTF-8" />
<meta charset="UTF-8">
<!--适配IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- 适配移动端 -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="container-fluid bs-docs-container">
	<!--工单申请表格-->
	<div class="row">
		<div class="col-md-12" role='main'>
			<div class="bs-docs-section">
				<?php $form = ActiveForm::begin(['action' => ['auditing/processsave'], 'method' => 'post']);?>
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'id')->textInput(['readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'title')->textInput(['readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'proposer')->textInput(['readonly' => true])?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'proposer_phone')->textInput(['readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'proposer_email')->textInput(['readonly' => true])?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'proposer_contry')->textInput(['readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'require_belongto')->textInput(['readonly' => true])?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'aprover')->textInput(['readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'terminals')->textInput(['readonly' => true])?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'time')->textInput(['readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'description')->textarea(['rows' => 6, 'readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'comments')->textarea(['rows'=>6, 'readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'aprove_record')->textarea(['readonly' => true, 'rows'=>6] )?>
							</div>
						</div>

						<!-- 水平分割线 -->
						<hr style="border:1px dashed #7B7B7B" width="100%" size="1" />

						<!-- 工单流程图 -->
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($model, 'aprover')->textInput(['readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'aprover_phone')->textInput(['readonly' => true])?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'aprover_email')->textInput(['readonly' => true])?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php 
									// 如果已经归档，则不能处理
									if($model->remain_str == "1"){
										echo $form->field($model, 'approver_idea')->textarea(['rows'=> 6, 'empty' => true, 'disabled'=>'disabled']);
									}else{
										echo $form->field($model, 'approver_idea')->textarea(['rows'=> 6, 'empty' => true]);
									}	
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php 
									// 如果已经归档，则不能处理
									if($model->remain_str == "1"){
										echo $form->field($model, 'file')->fileInput(['disabled' => 'disabled']);
									}else{
										echo $form->field($model, 'file')->fileInput();
									}	
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'next_approver',['inputTemplate' => 
                                        '<div class="input-group">
                                            {input}
                                            <span type="button" data-toggle="modal" data-target="#areaModal" class="input-group-addon" id="storechoosebtn" onclick="setId(\'null\',\'auditingmodel-next_approver\')">
                                                <span class="glyphicon glyphicon-th-large" aria-hidden="true">
                                                </span>
                                            </span>
                                        </div>',])->dropDownList(['' => ''], ['readonly' => 'true'])?>
							</div>
							<div class="col-md-6">
								<?php 
									if(strcasecmp($model->proposer,Yii::$app->user->identity->id) == 0){
										if($model->remain_str == "1"){
											echo $form->field($model, 'have_finish')->textInput(['value' => '已经归档', 'readonly' => 'true']);
										}else{
											echo $form->field($model, 'have_finish')->dropDownList(['0' => '否', '1'=> '是']);
										}	
									}
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p></p>
								<?php 
									if($model->remain_str == "1"){
										echo '<button type="submit" class="btn btn-success btn-lg btn-block" disabled>确定</button>';
									}else{
										echo '<button type="submit" class="btn btn-success btn-lg btn-block">确定</button>';
									}	
								?>
							</div>
						</div>
					<?php ActiveForm::end()?>

					<!-- 文件列表 -->
					<br>
					<br>
					<br>
					<div style="border:1px dashed #7B7B7B">
						<a href="#" class="list-group-item active">
					    	附件
						</a>
						<br>
						<ol>
							<?php  
								$fileArr = explode(",",$model->file);
								foreach ($fileArr as $value) {
									echo "<li>".Html::a(basename($value),[$value])."</li>";
								}
							?>
						</ol>
						<br>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function validate(){
		if($("#auditingmodel-file").is(":empty")){
			alert("文件不能为空");
			return false;
		}else{
			return true;
		}
	}
</script>>



