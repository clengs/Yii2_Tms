<?php  

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\AjaxModel;
use backend\models\TestModel;


include(dirname(dirname(__FILE__)). '/widgets/excelplugins/PHPExcel.php');
include(dirname(dirname(__FILE__)). '/widgets/excelplugins/PHPExcel/Writer/Excel5.php');

/**SS
* 
*/
class AjaxController extends Controller
{
	private $ajaxModel;

	function init(){
		$this->ajaxModel = new AjaxModel();
		$this->ajaxModel->processData();
	}

	function actionTest(){
		return $this->render('test');
	}


	function actionModal(){
		return $this->render('modal');
	 }

	 function actionApplication(){
	 	return $this->render('application');
	 }

	 function actionProcess(){
	 	return $this->render('process');
	 }

	 function actionChannel(){
	 	$request = Yii::$app->request;
		$response = Yii::$app->response;
		
		$response->format = \yii\web\Response::FORMAT_JSON;
		$response->data = $this->ajaxModel->getChannelJson($request->get('areaId'));
	 }
	 
	 function actionSheetupload(){
	 	return $this->render('sheetupload');
	 }
	 
	 function actionDownload(){
        echo $_POST['title'];
        //echo $_POST['content'];
  		//       if ($_FILES["file"]["error"] > 0)
		// {
		//   echo "Error: " . $_FILES["file"]["error"] . "<br />";
		// }
		// else
		// {
		//   echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		//   echo "Type: " . $_FILES["file"]["type"] . "<br />";
		//   echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		//   echo "Stored in: " . $_FILES["file"]["tmp_name"];
		// }
	 }

	 function actionInputexcel(){
	 	// $filepath = dirname(__FILE__).'\file.xlsx';
	 	// $phpexcel = new \PHPExcel();
	 	// $excelReader = \PHPExcel_IOFactory::createReader('Excel2007');
	 	// $phpexcel = $excelReader->load($filepath)->getSheet(0);

	 	// $objWriteHtml = new \PHPExcel_Writer_HTML($excelReader->load($filepath));
	 	// $objWriteHtml->save("php://output");
	 	return $this->render('inputexcel');
	 }

	 function actionDatapicker(){
	 	return $this->render('datapicker');
	 }
	 
	public function actionArea(){
		$request = Yii::$app->request;
		$response = Yii::$app->response;
		
		$response->format = \yii\web\Response::FORMAT_JSON;
		$response->data = $this->ajaxModel->getMarketingJson($request->get('areaId'));
	} 

}