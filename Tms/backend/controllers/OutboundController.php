<?php

namespace backend\controllers;

use Yii;
use backend\models\OutboundModel;
use backend\models\OutboundSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TerminalModel;
use yii\data\ActiveDataProvider;
use backend\models\TerminalSearch;

/**
 * OutboundController implements the CRUD actions for OutboundModel model.
 */
class OutboundController extends Controller
{
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
     * Lists all OutboundModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OutboundSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OutboundModel model.
     * @param string $terminalId
     * @param string $storehouseId
     * @return mixed
     */
    public function actionView($terminalId, $storehouseId)
    {
        return $this->render('view', [
            'model' => $this->findModel($terminalId, $storehouseId),
        ]);
    }

    /**
     * Creates a new OutboundModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OutboundModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'terminalId' => $model->terminalId, 'storehouseId' => $model->storehouseId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OutboundModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $terminalId
     * @param string $storehouseId
     * @return mixed
     */
    public function actionUpdate($terminalId, $storehouseId)
    {
        $model = $this->findModel($terminalId, $storehouseId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'terminalId' => $model->terminalId, 'storehouseId' => $model->storehouseId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OutboundModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $terminalId
     * @param string $storehouseId
     * @return mixed
     */
    public function actionDelete($terminalId, $storehouseId)
    {
        $this->findModel($terminalId, $storehouseId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OutboundModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $terminalId
     * @param string $storehouseId
     * @return OutboundModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($terminalId, $storehouseId)
    {
        if (($model = OutboundModel::findOne(['terminalId' => $terminalId, 'storehouseId' => $storehouseId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /*实现自定义功能---------------------------------------------------------------------------------------------------------*/
    public function actionOutterminal(){
        $outboundModel = new OutboundModel(); 
        $terminalSearch = new TerminalSearch();

        $dataProvider = $terminalSearch->search(Yii::$app->request->queryParams);
        return $this->render('outterminal', [
                        'outboundModel'=> $outboundModel,
                        'terminalSearch'=>$terminalSearch,
                        'dataProvider' => $dataProvider
                    ]);
    }   


    //获取客户端发来的分发终端列表
    public function actionTerminaljson(){
        if(Yii::$app->request->isAjax){
            //处理数据
            $body = Yii::$app->request->getRawBody();
            $this->parseAjaxBody($body);

            //返回处理成功标志
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = "success";
        }   
    }

    private function parseAjaxBody($body){
        $data = json_decode($body, true);

        $terminalModel = new TerminalModel();
        $terminalModel->writeToExcel($data['info'], $data['terminal'], $this->savePath());
        $terminalModel->batchDelete($data['terminal']);


        //保存记录到系统中
        $outboundModel = new OutboundModel();
        $outboundModel->saveRecord($data['info'], substr($this->savePath(),1));
    }

    //保存到本地时的路径
    private function savePath(){
                //设置活动的窗口为终端窗口
        date_default_timezone_set("Asia/Shanghai");
        $date1 = date("Y-m-d");
        $date2 = date("YmdHi");
        $filePath = "./statics/file/outboundTerminal/".$date1."/";
        if(!is_dir($filePath)){
            mkdir($filePath, 777, true);
        }

        $filename = $filePath.$date2."-出库终端表.xls";
        iconv('utf-8','gb2312',$filename);
        return $filename;
    }
}
