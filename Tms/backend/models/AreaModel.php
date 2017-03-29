<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "area".
 *
 * @property integer $childId
 * @property string $childMenu
 * @property string $childUrl
 * @property integer $parentId
 * @property string $parentMenu
 * @property integer $level
 * @property string $parentUrl
 *
 * @property Storehouse[] $storehouses
 */
class AreaModel extends \yii\db\ActiveRecord
{
    public $city;//市级
    public $zone;//区级
    public $marketingCenter;//营销中心
    public $channel;//渠道
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['childId', 'childMenu', 'parentId', 'parentMenu', 'level'], 'required'],
            [['childId', 'parentId', 'level'], 'integer'],
            [['childMenu', 'parentMenu'], 'string', 'max' => 32],
            [['childUrl', 'parentUrl'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'childId' => 'Child ID',
            'childMenu' => 'Child Menu',
            'childUrl' => 'Child Url',
            'parentId' => 'Parent ID',
            'parentMenu' => 'Parent Menu',
            'level' => 'Level',
            'parentUrl' => 'Parent Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorehouses()
    {
        return $this->hasMany(Storehouse::className(), ['store_belong' => 'childId']);
    }

    public function getOptionName(){
        return str_repeat('&nbsp;&nbsp',$this->level).$this->childMenu;
    }

    public function getCityList($pid){
        $model = static::findAll(array('parentId' => $pid));
        //return ArrayHelper::map($model, 'childId', 'childMenu');
        return $model;
    }
}
