<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property string $terminalId
 * @property string $storeId
 * @property string $terminalName
 * @property string $countTime
 * @property string $quantity
 * @property string $remain
 */
class StockModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['terminalId', 'storeId', 'countTime', 'quantity'], 'required'],
            [['countTime'], 'safe'],
            [['terminalId', 'terminalName'], 'string', 'max' => 64],
            [['storeId', 'quantity'], 'string', 'max' => 32],
            [['remain'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'terminalId' => 'Terminal ID',
            'storeId' => 'Store ID',
            'terminalName' => 'Terminal Name',
            'countTime' => 'Count Time',
            'quantity' => 'Quantity',
            'remain' => 'Remain',
        ];
    }
}
