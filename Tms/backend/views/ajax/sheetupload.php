<?php

?>
<div class="container bs-docs-container">
	<div class="row">
		<div class="col-md-12" role='main'>
			<div class="bs-docs-section" role="main">
				<form action="download" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<input name="_csrf-backend" type="hidden" id="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
								<label for="requireName">需求名称</label>
								<input type="text" class="form-control" name="title" id="title" value="终端申请">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="requireName">详细内容</label>
								<input type="file" class="form-control" name="file" id="file" rows="4"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary btn-lg btn-block">下载文件</button>
							</div>
						</div>
					</form>
				</div>
			</form>
		</div>
	</div>
</div>