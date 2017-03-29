<?php

namespace backend\controllers;

use Yii;
use backend\models\adminModel;
use backend\models\AuditingModel;
use backend\models\AuditingSearch;
use backend\models\ApplicationModel;
use backend\models\ApplicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AuditingController implements the CRUD actions for AuditingModel model.
 */
class AuditingController extends Controller
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
     * Lists all AuditingModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuditingSearch();
        $appArr=array();

        $appArr['AuditingSearch'] = ['aprover' => Yii::$app->user->identity->id];
        $dataProvider = $searchModel->search($appArr);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuditingModel model.
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
     * Creates a new AuditingModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuditingModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuditingModel model.
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
     * Deletes an existing AuditingModel model.
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
     * Finds the AuditingModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AuditingModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuditingModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*自定义*******************************************************************************************************/
    public function actionProcess($id){

        if(($model = AuditingModel::findOne($id)) !== null){
            $userModel = adminModel::findOne($model->aprover);
            $model->approver_idea = "";
            $model->next_approver = "";
            $model->aprover_email = $userModel->email;
            $model->aprover_phone = $userModel->mobilePhone;
            $model->aprove_record = str_replace('\n',chr(10),$model->aprove_record); 
            return $this->render('process', ['model'=>$model]);
        }
        else{
            if(!empty($appModel = ApplicationModel::findOne($id))){
                $userModel = adminModel::findOne($appModel->aprover);
                $model = new AuditingModel();
                $model->id = $appModel->id;
                $model->title = $appModel->title;
                $model->proposer = $appModel->proposer;
                $model->proposer_phone = $appModel->proposer_phone;
                $model->proposer_email = $appModel->proposer_email;
                $model->proposer_contry = $appModel->proposer_contry;
                $model->require_belongto = $appModel->require_belongto;
                $model->terminals = $appModel->terminals;
                $model->time = $appModel->time;
                $model->description = $appModel->description;
                $model->comments = $appModel->comments;
                $model->file = $appModel->file;
                $model->aprover = $appModel->aprover;
                $model->aprover_phone = $userModel->mobilePhone;
                $model->aprover_email = $userModel->email;

                return $this->render('process', ['model'=>$model]);
            }
            else{
                echo "错误";
            }
        }
    }

    //保存结果
    public function actionProcesssave(){
        $model = new AuditingModel();
        if($model->load(Yii::$app->request->post())){
            if(!empty(AuditingModel::findOne($model->id))){
                $model->isNewRecord = false;
            }else{
                $model->isNewRecord = true;
            }

            $tmpModel = null;
            if(empty($tmpModel = ApplicationModel::findOne($model->id))){
                $tmpModel = AuditingModel::findOne($model->id);
            }

            $file = UploadedFile::getInstance($model, 'file');
            if(!empty($file)){
                $path = $this->setPath($file);
                if($model->uploadFile($file, $path)){
                    $model->file = $tmpModel->file.",".substr($path, 1);
                }else{
                    echo "保存失败";
                }
            }else{
                $model->file = $tmpModel->file;
            }

            $userModel = adminModel::findOne($model->aprover);
            $model->aprove_record = '\n'.$model->aprove_record.'\n'.$userModel->username.":".$model->approver_idea;
            $model->aprover = $model->next_approver;
            // foreach ($model as$key=>$value) {
            //     echo $key.":".$value."<br>";
            // }

            if($model->have_finish==0){
                $model->remain_str = "0";
                $model->have_finish == "0";
            }else{
                $model->remain_str = "1";
                $model->remain_str = "1";
            }
            if($model->validate() && $model->save()){
                ApplicationModel::deleteAll('id=:id',[':id' => $model->id]);//先删除原始文件
                return $this->redirect('index');
            }else{
                print_r($model->getErrors());
            }
        }
    }

    //已经在处理的申请
    public function actionDealmessage($id){
        $audSearch = new AuditingSearch();
        $appArr=array();

        $appArr['AuditingSearch'] = ['aprover' => $id, 'remain_str' => "0"];
        $dataProvider = $audSearch->search($appArr);
        return $this->render('messagelist', ['dataProvider' => $dataProvider]);
        
    }

    //新产生的申请
    public function actionNewmessage($id){
        $appSearch = new ApplicationSearch();
        $appArr=array();
        $appArr['ApplicationSearch'] = ['aprover'=>$id];
        $dataProvider = $appSearch->search($appArr);
            
        return $this->render('messagelist', ['dataProvider' => $dataProvider]);
    }

    //保存到服务时的路径
    private function setPath($file){
                //设置活动的窗口为终端窗口
        date_default_timezone_set("Asia/Shanghai");
        $date1 = date("Y-m-d");
        $date2 = date("YmdHi");
        $filePath = "./statics/file/auditing/".$date1."/";
        if(!is_dir($filePath)){
            mkdir($filePath, 777, true);
        }

        $filename = $filePath.$date2.'-'.$file->basename.'.'.$file->extension;
        iconv('utf-8','gb2312',$filename);
        return $filename;
    }
}