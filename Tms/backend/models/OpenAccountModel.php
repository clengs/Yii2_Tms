<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "open_account".
 *
 * @property integer $id
 * @property string $terminalId
 * @property string $terminalName
 * @property string $consumerName
 * @property string $consumerAccount
 * @property string $consumerPhone
 * @property string $consumerAddress
 * @property string $time
 * @property integer $state
 * @property string $operater
 */
class OpenAccountModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'open_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['terminalId', 'terminalName', 'consumerName', 'consumerAccount', 'consumerPhone', 'consumerAddress', 'time','state','end_time'], 'required'],
            [['time', 'end_time'], 'safe'],
            [['state'], 'integer'],
            [['terminalId', 'terminalName', 'consumerAccount'], 'string', 'max' => 64],
            [['consumerName', 'consumerPhone'], 'string', 'max' => 32],
            [['consumerAddress'], 'string', 'max' => 128],
            [['operater'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'id'),
            'terminalId' => Yii::t('common', 'terminalId'),
            'terminalName' => Yii::t('common', 'terminalName'),
            'consumerName' => Yii::t('common', 'consumerName'),
            'consumerAccount' => Yii::t('common', 'consumerAccount'),
            'consumerPhone' => Yii::t('common', 'consumerPhone'),
            'consumerAddress' => Yii::t('common', 'consumerAddress'),
            'time' => Yii::t('common', 'time'),
            'state' => Yii::t('common', 'state'),
            'operater' => Yii::t('common', 'operater'),
            'end_time' => '到期时间',
        ];
    }

    //
    public static function getGrade(){
        $id = Yii::$app->user->getId();
        return $id;
    }
    //保存
}
