<!-- 工单处理页面 -->
<?php 
	use yii\helpers\Html;
	use yii\jui\DatePicker;

	$this->params['breadcrumbs'][] = "message";
	$this->params['breadcrumbs'][] = "工单处理";
?>
<div class="container bs-docs-container">
	<!--工单申请表格-->
	<div class="row">
		<div class="col-md-12" role='main'>
			<div class="bs-docs-section">
				<form class="form-horizontal">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label for="requireName">需求名称</label>
								<input type="text" class="form-control" name="title" id="requireName" value="终端申请" disabled="true">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="usernameInput" class="control-label">申请人</label>
								<input type="text" class="form-control" name="username" id="usernameInput" placeholder="朱地" disabled>
							</div>
							<div class="col-md-6">
								<label for="userphone" class="control-label">电话号码</label>
								<input type="text" class="form-control" name="username" id="userphone" placeholder="186 8579 0590" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="usernameInput" class="control-label">申请人邮箱</label>
								<input type="text" class="form-control" name="username" id="usernameInput" placeholder="1402904898@qq.com" disabled>
							</div>
							<div class="col-md-6">
								<label for="userphone" class="control-label">地市分公司</label>
								<input type="int" class="form-control" name="username" id="usernameInput" placeholder="毕节市分公司" disabled>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="usernameInput" class="control-label">需求所属部门</label>
								<select class="form-control" name="area" id="area">
									<option value="1">七星关区</option>
									<option value="2">织金县</option>
								</select>
							</div>
							<div class="col-md-6">
								<label for="userphone" class="control-label">审批人</label>
								<select class="form-control" name="area" id="area">
									<option value="1">陈永奇</option>
									<option value="2">付业才</option>
									<option value="2">王洪林</option>
									<option value="2">林宜</option>
									<option value="2">朱地</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="usernameInput" class="control-label">终端数量</label>
								<input type="text" class="form-control" name="username" id="userphone">
							</div>
							<div class="col-md-6">
								<label for="userphone" class="control-label">截止时间</label>
								<input type="text" class="form-control" name="username" id="userphone">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="contentInput" class="control-label">描述</label>
								<textarea class="form-control" rows="5" wrap="physical">
								</textarea>
							</div>
						</div>
						
							<!-- 水平分割线 -->
						<hr style="border:1px dashed #7B7B7B" width="100%" size="1" />

						<!-- 工单流程图 -->
						<div class="row">
							<div class="col-md-6">
								<label for="usernameInput" class="control-label">审核人</label>
								<input type="text" class="form-control" name="username" id="usernameInput" placeholder="朱地" disabled>
							</div>
							<div class="col-md-6">
								<label for="userphone" class="control-label">审核人所属部门</label>
								<input type="text" class="form-control" name="username" id="userphone" placeholder="毕节市分公司信化部" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="usernameInput" class="control-label">审核人电话</label>
								<input type="text" class="form-control" name="username" id="usernameInput" placeholder="186 8579 0590" disabled>
							</div>
							<div class="col-md-6">
								<label for="userphone" class="control-label">审核人邮箱</label>
								<input type="text" class="form-control" name="username" id="userphone" placeholder="1402904898@qq.com" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="usernameInput" class="control-label">审核意见</label>
								<textarea class="form-control" rows="2" wrap="physical" name="audit_opinion" id="audit_opinion"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p></p>
								<button type="button" class="btn btn-primary btn-lg btn-block">确定</button>
							</div>
						</div>
					</form>
				</div>	
			</div>


			<!-- 注意事项 -->
			<div>
				<h2>注意事项</h2>

				<p><strong>Congratulations! You have just installed and used CKEditor on your own page in virtually no time!</strong></p>

				<p><strong><a href="http://114.215.83.159">中国联合通讯有限公司毕节分公司</a></strong></p>
			</div>

		</div>

		<div class="col-md-3" role="complementary">
			<nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
				<ul class="nav bs-docs-sidenav">
					<li id="time" class="text-primary"></li>
				</ul>
			</nav>
		</div>
	</div>
</div>

