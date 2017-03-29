<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property string $title
 * @property string $proposer
 * @property string $proposer_phone
 * @property string $proposer_email
 * @property string $proposer_contry
 * @property string $require_belongto
 * @property string $aprover
 * @property integer $terminals
 * @property string $time
 * @property string $description
 * @property string $comments
 * @property string $file
 * @property string $aprove_record
 */
class ApplicationModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'proposer', 'proposer_phone', 'proposer_email', 'proposer_contry', 'require_belongto', 'aprover', 'terminals', 'time', 'description', 'comments', 'file'], 'required'],
            [['terminals'], 'integer'],
            [['description', 'comments', 'aprove_record'], 'string'],
            [['title', 'proposer_contry'], 'string', 'max' => 128],
            [['proposer', 'require_belongto', 'aprover', 'time'], 'string', 'max' => 64],
            [['proposer_phone', 'proposer_email'], 'string', 'max' => 32],
            [['file'], 'file', 'extensions' => 'jpg, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('common', 'title'),
            'proposer' => Yii::t('common', 'proposer'),
            'proposer_phone' => Yii::t('common', 'proposer_phone'),
            'proposer_email' => Yii::t('common', 'proposer_email'),
            'proposer_contry' => Yii::t('common', 'proposer_contry'),
            'require_belongto' => Yii::t('common', 'require_belongto'),
            'terminals' => Yii::t('common', 'terminals'),
            'time' => Yii::t('common', 'time'),
            'description' => Yii::t('common', 'description'),
            'comments' => Yii::t('common', 'comments'),
            'file' => Yii::t('common', 'file'),
            'aprove_record' => Yii::t('common', 'aprove_record'),
            'aprover' => Yii::t('common', 'aprover'),
        ];
    }

    //保存文件图片
    public function uploadImg($image, $path)
    {
        if(isset($image)){
            return $image->saveAs($path);
        }
    }
}
