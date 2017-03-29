<?php

namespace backend\controllers;

use Yii;
use backend\models\TerminalModel;
use backend\models\TerminalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AjaxModel;
use backend\forms\BatchinForm;
use yii\web\UploadedFile;

/**
 * TerminalController implements the CRUD actions for TerminalModel model.
 */
class TerminalController extends Controller
{
    private $ajaxModel;

    function init(){
        $this->ajaxModel = new AjaxModel();
        $this->ajaxModel->processData();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TerminalModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TerminalSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TerminalModel model.
     * @param string $serialId
     * @param string $storeId
     * @return mixed
     */
    public function actionView($serialId, $storeId)
    {
        return $this->render('view', [
            'model' => $this->findModel($serialId, $storeId),
        ]);
    }

    /**
     * Creates a new TerminalModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TerminalModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'serialId' => $model->serialId, 'storeId' => $model->storeId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TerminalModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $serialId
     * @param string $storeId
     * @return mixed
     */
    public function actionUpdate($serialId, $storeId)
    {
        $model = $this->findModel($serialId, $storeId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'serialId' => $model->serialId, 'storeId' => $model->storeId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TerminalModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $serialId
     * @param string $storeId
     * @return mixed
     */
    public function actionDelete($serialId, $storeId)
    {
        $this->findModel($serialId, $storeId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TerminalModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $serialId
     * @param string $storeId
     * @return TerminalModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($serialId, $storeId)
    {
        if (($model = TerminalModel::findOne(['serialId' => $serialId, 'storeId' => $storeId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // //批量导入终端信息测试
    // function actionImports(){
    //     if(Yii::$app->request->isPost){
    //         $params = array();
    //         $manager = Yii::$app->request->post('manager', '');
    //         $storehouse = Yii::$app->request->post('storehouse', '');
    //         $inbounttime = Yii::$app->request->post('inbounttime', '');
    //         $manufacturer = Yii::$app->request->post('manufacturer', '');
    //         $producetime = Yii::$app->request->post('producetime', '');
        
    //         //将数据导入到params数组中
    //         $params['manager'] = $manager;
    //         $params['storehouse'] = $storehouse;
    //         $params['inboundtime'] = $inbounttime;
    //         $params['manufacturer'] = $manufacturer;
    //         $params['producetime'] = $producetime;

    //         $uploadDir = dirname(__FILE__)."/upload/" . date("YmdHi")."-terminal.".$_FileS['file']['type'];
    //         move_uploaded_file($_FILES["file"]["tmp_name"], iconv("utf-8", "gb2312", $uploadDir));
           
    //         $model = new TerminalModel();
    //         $result = $model->SaveBatch($uploadDir, $params);
            
    //         if($result == true){
    //             $this->redirect('index');
    //         }else{
    //             echo $result;
    //         }
    //     }else{
    //         echo "无请求...";
    //     }
    // }

    //批量导入终端
    public function actionBatchimport(){
        $model = new TerminalModel();

        if ($model->load(Yii::$app->request->Post())){
            $model->excelfile = UploadedFile::getInstance($model, 'excelfile');

            if($model->upload()){
                $model->SaveBatch($model->getFilePath(),null);
                return $this->redirect('index');
            }else{
                print_r($model->getErrors());
            }
        } else {
            return $this->render('batchimport', [
                'model' => $model,
            ]);
        }
    }

    //返回营销中心json
    public function actionAreajson(){
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $this->ajaxModel->getMarketingJson($request->get('areaId'));
    } 

    //返回渠道中心json
    public function actionChanneljson(){
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $this->ajaxModel->getChannelJson($request->get('areaId'));
    }

    //返回管理人员json
    public function actionManagerjson(){
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $this->ajaxModel->getManagerJson($request->get('areaId'));
    }

    //yii自定义验证
    public function actionYiivalidate(){
        $model = new BatchinForm();

        if (Yii::$app->request->isPost) {

            $model->excelfile = UploadedFile::getInstance($model, 'excelfile');
            if($model->upload()){
                
            }else{
                print_r($model->getErrors());
            }
        } else {
            return $this->render('yiivalidate', [
                'model' => $model,
            ]);
        }
    }
}
