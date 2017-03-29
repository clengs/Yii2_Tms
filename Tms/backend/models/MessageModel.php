<?php

namespace backend\models;

use Yii;
use backend\models\AdminModel;

/**
 * This is the model class for table "message".
 *
 * @property string $msgId
 * @property string $senderID
 * @property string $senderName
 * @property string $recipientID
 * @property string $recipientName
 * @property string $title
 * @property string $content
 * @property string $sendtime
 * @property integer $state
 *
 * @property Admin $sender
 * @property Admin $recipient
 */
class MessageModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msgId', 'senderID', 'recipientID', 'title', 'sendtime'], 'required'],
            [['content'], 'string'],
            [['sendtime'], 'safe'],
            [['state'], 'integer'],
            [['msgId', 'senderID', 'recipientID'], 'string', 'max' => 64],
            [['senderName', 'recipientName'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 128],
            [['senderID'], 'exist', 'skipOnError' => true, 'targetClass' => AdminModel::className(), 'targetAttribute' => ['senderID' => 'id']],
            [['recipientID'], 'exist', 'skipOnError' => true, 'targetClass' => AdminModel::className(), 'targetAttribute' => ['recipientID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msgId' => Yii::t('common', 'msgId'),
            'senderID' => Yii::t('common', 'msenderId'),
            'senderName' => Yii::t('common', 'msenderName'),
            'recipientID' => Yii::t('common', 'mrecipientId'),
            'recipientName' => Yii::t('common', 'mrecipientName'),
            'title' => Yii::t('common', 'mtitle'),
            'content' => Yii::t('common', 'mcontent'),
            'sendtime' => Yii::t('common', 'msendTime'),
            'state' => Yii::t('common', 'mstate'), 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(AdminModel::className(), ['id' => 'senderID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient()
    {
        return $this->hasOne(AdminModel::className(), ['id' => 'recipientID']);
    }
}
