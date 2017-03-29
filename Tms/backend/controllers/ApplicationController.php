<?php

namespace backend\controllers;

use Yii;
use backend\models\ApplicationModel;
use backend\models\ApplicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ApplicationController implements the CRUD actions for ApplicationModel model.
 */
class ApplicationController extends Controller
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
     * Lists all ApplicationModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApplicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApplicationModel model.
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
     * Creates a new ApplicationModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ApplicationModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ApplicationModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing ApplicationModel model.
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
     * Finds the ApplicationModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ApplicationModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApplicationModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*自定义*****************************************************************************************************************/
    public function actionApplication(){
        $model = new ApplicationModel();

        if($model->load(Yii::$app->request->post())){
            $img = UploadedFile::getInstance($model, 'file');
            $path = $this->setPath($img);
            if($model->uploadImg($img, $path)){
                $model->file = substr($path, 1);
                if($model->save()){
                    return $this->redirect('index');
                }else{
                    echo "保存失败";
                }
            }else{
                echo "保存图片失败";
            }
        }else{
            return $this->render('application', ['model'=> $model]);
        }
        
    }

    //保存到服务时的路径
    private function setPath($img){
                //设置活动的窗口为终端窗口
        date_default_timezone_set("Asia/Shanghai");
        $date1 = date("Y-m-d");
        $date2 = date("YmdHi");
        $filePath = "./statics/file/application/image/".$date1."/";
        if(!is_dir($filePath)){
            mkdir($filePath, 777, true);
        }

        $filename = $filePath.$date2.'-'.$img->basename.'.'.$img->extension;
        iconv('utf-8','gb2312',$filename);
        return $filename;
    }

}
