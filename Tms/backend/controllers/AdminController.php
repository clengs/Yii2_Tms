<?php

namespace backend\controllers;

use Yii;
use backend\models\adminModel;
use backend\models\adminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modles\AreaModel;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * AdminController implements the CRUD actions for adminModel model.
 */
class AdminController extends Controller
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
     * Lists all adminModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new adminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single adminModel model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new adminModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new adminModel();

        if ($model->load(Yii::$app->request->post())) {
            $model->avatarfile =  UploadedFile::getInstance($model, 'avatarfile');

            if($model->upload()){
                $model->avatar = $model->getAvatarPath();
            }else{
                $model->avatar = "/statics/images/avatar/default.jpg";
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                print_r($model->getErrors());
            }
        }else {
                return $this->render('create', [
                    'model' => $model,
        ]);
            
        } 
    }

    /**
     * Updates an existing adminModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing adminModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the adminModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return adminModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = adminModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

        public function actionSite($pid, $typeid = 0){
        $model = new AreaModel();
        $model = $model->getCityList($pid);

        if ($typeid == 1) {
            $aa = "--请选择市";
        }else if($typeid == 2 && $model){
            $aa = "--请选择区";
        }

        echo Html::tag('option', $aa, ['value' => 'empty']);

        foreach ($model as $value => $name) {
            echo Html::tag('option', Html::encode($name), array('value' => $value));
        }
    }

    /*
    测试页面
    */
    public function actionTest(){
        return $this->render('test');
    }

    /*
    个人中心
    */
    public function actionPersonal(){
        return $this->render('personal');
    }
}
