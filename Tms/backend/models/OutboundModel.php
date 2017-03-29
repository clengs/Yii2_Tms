<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "outbound".
 *
 * @property string $storehouseId
 * @property string $terminalId
 * @property string $adminId
 * @property string $outboundTime
 * @property integer $outboundQuantity
 * @property integer $destinationId
 * @property string $receiverId
 */
class OutboundModel extends \yii\db\ActiveRecord
{
       /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outbound';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminId', 'outboundTime', 'outboundQuantity','destinationId','receiverId'], 'required'],
            [['outboundTime'], 'safe'],
            [['outboundQuantity', 'destinationId'], 'integer'],
            [['adminId'], 'string', 'max' => 64],
            [['terminalId'], 'string', 'max' => 512],
            [['storehouseId','receiverId'], 'string', 'max' => 32],
            [['terminalId'], 'exist', 'skipOnError' => true, 'targetClass' => TerminalModel::className(), 'targetAttribute' => ['terminalId' => 'serialId']],
            [['storehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => StorehouseModel::className(), 'targetAttribute' => ['storehouseId' => 'store_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'terminalId' => Yii::t('common', 'obterminalId'),
            'storehouseId' => Yii::t('common', 'obstorehouseId'),
            'adminId' => Yii::t('common', 'obadminId'),
            'outboundTime' => Yii::t('common', 'obtime'),
            'outboundQuantity' => Yii::t('common', 'obquantity'),
            'destinationId' => Yii::t('common', 'obdestinationId'),
            'receiverId' => Yii::t('common', 'obreceiverId'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerminal()
    {
        return $this->hasOne(TerminalModel::className(), ['serialId' => 'terminalId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorehouse()
    {
        return $this->hasOne(StorehouseModel::className(), ['store_id' => 'storehouseId']);
    }



    /*
    *@func:处理请求办法 
    *@param $request 请求
    *@param $terminalList 终端数据条目
    */ 
    public function processPost($request, $terminalList){
        //print_r($terminalList);
    }


    /*@func 修改所在仓库
    *@param $terminalId 终端编号
    *@param $storeId 将要到达的仓库
    */
    public static function modifyStorehouse($terminalId, $storeId){
         TerminalModel::updateAll(['storeId'=> $storeId],['serialId'=>$terminalId]);
    }


    /*
    *@func 生成数据记录表
    *@func $info 修改的所有的信息 
    */
    public function generateExcelFile($info){

    }

    public function saveRecord($record, $path){
        $this->isNewRecord = true;
        $this->adminId = $record['adminId'];
        $this->receiverId = $record['receiverId'];
        $this->outboundQuantity = $record['outboundQuantity'];
        $this->storehouseId = $record['storehouseId'];
        $this->destinationId = $record['destinationId'];
        $this->outboundTime = $record['outboundTime'];
        $this->terminalId = $path;

        $this->save(false);
    }
}
