<?php

namespace backend\models;

use Yii;
use backend\models\StockModel;

// 引入PHPExcel文件
include(dirname(dirname(__FILE__)). '/widgets/excelplugins/PHPExcel.php');
include(dirname(dirname(__FILE__)). '/widgets/excelplugins/PHPExcel/Writer/Excel5.php');

/**
 * This is the model class for table "terminal".
 *
 * @property string $serialId
 * @property string $storeId
 * @property string $name
 * @property string $model
 * @property string $verder
 * @property integer $quantity
 * @property double $price
 * @property string $inboundTime
 * @property string $manufacturer
 * @property string $produceTime
 * @property string $operater
 *
 * @property Outbound[] $outbounds
 * @property Storehouse[] $storehouses
 */
class TerminalModel extends \yii\db\ActiveRecord
{
    private static $outList = array();
    public $excelfile;
    private $filePath;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'terminal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serialId', 'storeId','operater', 'manufacturer', 'inboundTime'], 'required'],
            [['quantity'], 'integer'],
            [['price'], 'number'],
            [['inboundTime', 'produceTime'], 'safe'],
            [['serialId', 'name', 'model', 'verder', 'manufacturer', 'operater'], 'string', 'max' => 64],
            [['storeId'], 'string', 'max' => 32],
            [['excelfile'], 'file', 'extensions'=>'xls,xlsx'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'serialId' => Yii::t('common', 'serialId'),
            'storeId' => Yii::t('common', 'storeId'),
            'name' => Yii::t('common', 'name'),
            'model' => Yii::t('common', 'model'),
            'verder' => Yii::t('common', 'verder'),
            'quantity' => Yii::t('common', 'quantity'),
            'price' => Yii::t('common', 'price'),
            'inboundTime' => Yii::t('common', 'inboundTime'),
            'manufacturer' => Yii::t('common', 'manufacturer'),
            'produceTime' => Yii::t('common', 'produceTime'),
            'operater' => Yii::t('common', 'operater'),
        ];
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getOutbounds()
    // {
    //     return $this->hasMany(Outbound::className(), ['terminalId' => 'serialId']);
    // }

    // *
    //  * @return \yii\db\ActiveQuery
     
    // public function getStorehouses()
    // {
    //     return $this->hasMany(Storehouse::className(), ['store_id' => 'storehouseId'])->viaTable('outbound', ['terminalId' => 'serialId']);
    // }

    /**
     *批量保存上传文件的内容
     */
    public function SaveBatch($file, $params){
        try{
            $type = pathinfo($file, PATHINFO_EXTENSION);
            $reader;
            $this->excelfile = null;
            if($type == "xls"){
                $reader = \PHPExcel_IOFactory::createReader("Excel5");
            }else if($type == "xlsx"){
                $reader = \PHPExcel_IOFactory::createReader("Excel2007");
            }else{
                return false;
            }

            //获取Excel文件信息
            $tmp_file = iconv('gbk','utf-8',$file);
            $phpexcel = $reader->load($tmp_file);
            $phpexcel->setActiveSheetIndex(0);//设置默认都是读取第一张表的内容
            $objWorksheet = $phpexcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();

            //建立一个model，查看数据是否已经插入
            $model = new StockModel();
            for($row = 2; $row <= $highestRow; $row++){
                for($column = 0; $column <= $highestColumn; $column++){
                    $val = $objWorksheet->getCellByColumnAndRow($column, $row)->getValue(); 

                    if (!isset($val)) {
                        continue;
                    } 


                    $tmp1 = $this->find()->where(['serialId' => $val, 'storeId' => $this->storeId])->one();
                    if(isset($tmp1)){
                        continue;
                    } 
                    $this->isNewRecord = true;
                    $this->quantity = 1;
                    $this->serialId = $val;
                    $this->save(false);


                    //查看数据库中是否存在数据
                    $tmp2 = $model->find()->where(['terminalId' => $val])->one();
                    if(isset($tmp2)){
                        continue;
                    } 
                    //同时保存到库存stock表中
                    $stockModel = new StockModel();
                    $stockModel->isNewRecord = true;
                    $stockModel->terminalId = $this->serialId;
                    $stockModel->storeId = $this->storeId;
                    $stockModel->countTime = $this->inboundTime;
                    $stockModel->quantity = 1;
                    $stockModel->save(false);
                }
            }
        }catch(Exception $e){
            return false;
        }

        return true;
    }

    //文件上传
    public function upload()
    {
        $path = "./statics/file/terminal/tmp/";
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        if(isset($this->excelfile)){
            $date = date("YmdHi");
            $this->filePath = $path . $date . "-terminal." . $this->excelfile->extension;
            $this->excelfile->saveAs($path . $date."-terminal." . $this->excelfile->extension);
            return true;
        }else{
            return false;
        }
    }

    //返回文件地址
    public function getFilePath(){
        if(file_exists($this->filePath)){
            return $this->filePath;
        }
    }

    //设置要操作的数据
    public function setOutList($value){
        static::$outList=$value;
    }


    //获取要操作的数据
    public function getOutList(){
        if(isset(static::$outList) && count(static::$outList)>0){
            return static::$outList;
        }else{
            return "Have no data!!!";
        }
    }
    
    public function clearOutList(){
        if(isset(static::$outList) && count(static::$$outList) >0){
            unset(static::$outList);
        }
    }

    //将数据写入excel
    public function writeToExcel($info, $terminalJson, $filename){
        $adminId = $info['adminId'];
        $outboundTime = $info['outboundTime'];
        $outboundQuantity = count($terminalJson);
        $destinationId = $info['destinationId'];
        $receiverId = $info['receiverId'];
        $storehouseId = $info['storehouseId'];

        $excelFile = new \PHPExcel();
        $excelFile->setActiveSheetIndex(0);
        $excelFile->getActiveSheet()->setTitle('终端');//设置sheet名称
        $excelFile->getActiveSheet()->getColumnDimension()->setAutoSize(true);//设置宽度自动

        $k = 1;
        $excelFile->getActiveSheet()->setCellValue('A'.$k, '终端条码');
        foreach ($terminalJson as $value) {
            $k += 1;
            $excelFile->getActiveSheet()
                        ->setCellValue('A'.$k, $value['serialId']);
        }
       

        $excelFile->createSheet();
        $excelFile->setActiveSheetIndex(1); 
        $excelFile->getActiveSheet()->setTitle('其他信息');
        $excelFile->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);//设置宽度自动
        $excelFile->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);//设置宽度自动
        $excelFile->getActiveSheet()
                    ->setCellValue('A1', "经手人")->setCellValue('B1',$adminId)
                    ->setCellValue('A2', "出库时间")->setCellValue('B2', $outboundTime)
                    ->setCellValue('A3', "出库数量")->setCellValue('B3', $outboundQuantity)
                    ->setCellValue('A4', "目的地")->setCellValue('B4', $destinationId)
                    ->setCellValue('A5', "接收人")->setCellValue('B5',$receiverId)
                    ->setCellValue('A6', "目标仓库")->setCellValue('B6', $storehouseId);


        $objWriter= \PHPExcel_IOFactory::createWriter($excelFile,'Excel5');
        $objWriter->save(iconv('utf-8', 'gb2312', $filename));//做完最后这一步,访问网址已经可以导出文件了
    }

    //删除
    public function batchDelete($termialList){
        foreach ($termialList as  $value) {
            TerminalModel::deleteAll('serialId=:serialId',[':serialId' => $value['serialId']]);
        }
    }

}
