<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auditing".
 *
 * @property integer $id
 * @property string $title
 * @property string $proposer
 * @property string $proposer_phone
 * @property string $proposer_email
 * @property string $proposer_contry
 * @property string $require_belongto
 * @property integer $terminals
 * @property string $time
 * @property string $description
 * @property string $comments
 * @property string $file
 * @property string $aprove_record
 * @property string $aprover
 * @property string $aprover_phone
 * @property string $aprover_email
 * @property string $approver_idea
 * @property string $next_approver
 * @property string $have_finish
 * @property string $remain_str
 */
class AuditingModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auditing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'proposer', 'proposer_phone', 'proposer_email', 'proposer_contry', 'require_belongto', 'terminals', 'time', 'description', 'comments', 'aprover', 'approver_idea', 'next_approver'], 'required'],
            [['id', 'terminals'], 'integer'],
            [['description', 'comments', 'aprove_record', 'approver_idea'], 'string'],
            [['title', 'proposer_contry'], 'string', 'max' => 128],
            [['proposer', 'require_belongto', 'time', 'aprover', 'aprover_email', 'next_approver'], 'string', 'max' => 64],
            [['proposer_phone', 'proposer_email', 'aprover_phone'], 'string', 'max' => 32],
            [['file'], 'file', 'extensions' => 'jpg,png,xls,xlsx'],
            [['have_finish', 'remain_str'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '工单编号',
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
            'file' => '文件',
            'aprove_record' => Yii::t('common', 'aprove_record'),
            'aprover' => Yii::t('common', 'aprover'),
            'aprover_phone' => Yii::t('common', 'aprover_phone'),
            'aprover_email' => Yii::t('common', 'aprover_email'),
            'approver_idea' => Yii::t('common', 'approver_idea'),
            'next_approver' => Yii::t('common', 'next_approver'),
            'have_finish' => Yii::t('common', 'finished'),
            'remain_str' => '工单状态',
        ];
    }

    //保存文件图片
    public function uploadFile($file, $path)
    {
        if(isset($file)){
            return $file->saveAs(iconv('utf-8','gb2312',$path));
        }
    }
}
