<?php
	use backend\models\AjaxModel;

	$ajax = new AjaxModel();

	$modelList = $ajax->getManagerList(3);

	$modelList = $ajax->getManagerJson(3);


	// foreach ($modelList as $key => $value) {
	//  	echo $key."：";
	//  	echo $value."<br/>";
	// }

	$path = "./web/statics/file/avatar/".Yii::$app->user->identity->username;
	echo $path;
	if(!is_dir($path)){
		if(mkdir($path, 777, true)){
			echo "成功";
		}
	}
?> 