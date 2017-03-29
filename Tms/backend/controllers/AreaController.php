<?php

namespace backend\controllers;

use Yii;
use backend\models\AreaModel;
use backend\models\AreaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AjaxModel;

/**
 * AreaController implements the CRUD actions for AreaModel model.
 */
class AreaController extends Controller
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
     * Lists all AreaModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AreaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AreaModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AreaModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AreaModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->childId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AreaModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->childId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AreaModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AreaModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AreaModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AreaModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
}
