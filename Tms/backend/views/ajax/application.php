<!-- 工单申请 -->
<?php 
	use yii\jui\DatePicker;
?>

<div class="container-fluid bs-docs-container">
	<!--工单申请表格-->
	<div class="row">
		<div class="col-md-9" role='main'>
			<div class="bs-docs-section">
				<h1 class="page-header" id="message_title"></h1>
				<form class="form-horizontal">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label for="requireName">需求名称</label>
								<input type="text" class="form-control" name="title" id="requireName">
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
								<textarea class="form-control" rows="5" wrap="physical"></textarea>
							</div>
						</div>
						<div class="row">
							<p></p>
							<div class="col-md-12">
								<button type="button" class="btn btn-primary btn-lg btn-block">提交</button>
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- 工单流程图 -->
			<div>
				
			</div>

			<!-- 注意事项 -->
			<div>
				<h2>注意事项</h2>

				<p>To start, create a simple HTML page with a&nbsp;<code>&lt;textarea&gt;</code>&nbsp;element in it. You will then need to do two things:</p>

				<ol>
					<li>Include the <code>&lt;script&gt;</code> element loading CKEditor in your page.</li>
					<li>Use the&nbsp;<code><a href="http://docs.ckeditor.com/#!/api/CKEDITOR-method-replace">CKEDITOR.replace()</a></code>&nbsp;method to replace the existing&nbsp;<code>&lt;textarea&gt;</code>&nbsp;element with CKEditor.</li>
				</ol>

				<p>See the following example:</p>

				<p>When you are done, open your test page in the browser.</p>

				<p><strong>Congratulations! You have just installed and used CKEditor on your own page in virtually no time!</strong></p>

				<p><strong><a href="http://114.215.83.159">中国联合通讯有限公司毕节分公司</a></strong></p>
			</div>
		</div>

		<div class="col-md-3" role="complementary">
			<nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
				<ul class="nav bs-docs-sidenav">
					<li class><a href="#overview">预览</a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>
