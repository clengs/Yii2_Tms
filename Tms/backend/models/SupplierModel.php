<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $contact
 * @property string $address
 */
class SupplierModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'email', 'contact', 'address'], 'required'],
            [['id'], 'integer'],
            [['name', 'email', 'contact'], 'string', 'max' => 32],
            [['address'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'spid'),
            'name' => Yii::t('common','spname'),
            'email' => Yii::t('common', 'spemail'),
            'contact' => Yii::t('common','spcontact'),
            'address' => Yii::t('common','spaddress'),
        ];
    }
}
