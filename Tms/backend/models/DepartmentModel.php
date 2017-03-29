<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property string $id
 * @property string $name
 * @property string $manager
 * @property string $contact
 */
class DepartmentModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'manager', 'contact'], 'required'],
            [['id', 'name', 'manager', 'contact'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'dmid'),
            'name' => Yii::t('common', 'dmname'),
            'manager' => Yii::t('common', 'dmmanager'),
            'contact' => Yii::t('common', 'dmcontact'),
        ];
    }
}
