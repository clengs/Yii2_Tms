<?php

namespace backend\models;

use Yii;
use backend\models\AreaModel;
use backend\models\adminModel;
use backend\models\OutboundModel;
use backend\models\TerminalModel;

/**
 * This is the model class for table "storehouse".
 *
 * @property string $store_id
 * @property string $store_name
 * @property string $store_address
 * @property double $store_acre
 * @property integer $store_belong
 * @property string $store_manager
 *
 * @property Outbound[] $outbounds
 * @property Terminal[] $terminals
 * @property Area $storeBelong
 * @property Admin $storeManager
 */
class StorehouseModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'storehouse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'store_name', 'store_address'], 'required'],
            [['store_acre'], 'number'],
            [['store_belong'], 'integer'],
            [['store_id', 'store_manager'], 'string', 'max' => 32],
            [['store_name', 'store_address'], 'string', 'max' => 128],
            [['store_belong'], 'exist', 'skipOnError' => true, 'targetClass' => AreaModel::className(), 'targetAttribute' => ['store_belong' => 'childId']],
            [['store_manager'], 'exist', 'skipOnError' => true, 'targetClass' => adminModel::className(), 'targetAttribute' => ['store_manager' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => Yii::t('common', 'store_id'),
            'store_name' => Yii::t('common', 'store_name'),
            'store_address' => Yii::t('common', 'store_address'),
            'store_acre' => Yii::t('common', 'store_acre'),
            'store_belong' => Yii::t('common', 'store_belong'),
            'store_manager' => Yii::t('common', 'store_manager'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutbounds()
    {
        return $this->hasMany(OutboundModel::className(), ['storehouseId' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerminals()
    {
        return $this->hasMany(TerminalModel::className(), ['serialId' => 'terminalId'])->viaTable('outbound', ['storehouseId' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreBelong()
    {
        return $this->hasOne(AreaModel::className(), ['childId' => 'store_belong']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreManager()
    {
        return $this->hasOne(adminModel::className(), ['id' => 'store_manager']);
    }

    //根据value获取对应的house
    public function getStorehouseModel($value){
        return $this->findAll(array('store_belong' => $value));
    }

    //获取仓库的list
    public function getStorehouseList($value){
        $storehouse = $this->getStorehouseModel($value);
        $storehouseList = array();
        foreach ($storehouse as $_value) {
            $storehouseList[$_value['store_id']] =  $_value['store_name'];
        }

        return $storehouseList;
    }

    //获取仓库的json
    public function getStorehouseJson($value){
        $storehouselist = $this->getStorehouseList($value);
        $storehouseJson['message'] = array();
        foreach ($storehouselist as  $key => $_value) {
            array_push($storehouseJson['message'], ['id'=> $key, 'name' => $_value]);
        }

        return $storehouseJson;
    }
}
