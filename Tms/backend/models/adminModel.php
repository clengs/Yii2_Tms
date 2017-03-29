<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
use backend\models\AreaModel;

/**
 * This is the model class for table "admin".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $accessToken
 * @property string $address
 * @property string $contact
 * @property string $email
 * @property integer $grade
 * @property string $avatar
 * @property integer $areaId
 * @property string $areaName
 * @property string $mobilePhone
 */
class adminModel extends \yii\db\ActiveRecord implements IdentityInterface
{
    private  $uploadPath;
    public   $avatarfile;
    private  $avatarPath;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'areaId', 'areaName', 'mobilePhone'], 'required'],
            [['grade', 'areaId'], 'integer'],
            [['id', 'address'], 'string', 'max' => 64],
            ['email', 'email'],
            [['username', 'auth_key', 'accessToken', 'contact', 'areaName', 'mobilePhone'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 128],
            [['password'], 'default', 'value'=>'admin'],
            [['avatarfile'], 'file', 'extensions' => 'jpg, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'userid'),
            'username' => Yii::t('common', 'username'),
            'password' => Yii::t('common', 'password'),
            'auth_key' => 'Auth Key',
            'accessToken' => 'Access Token',
            'address' => Yii::t('common', 'address'),
            'contact' => Yii::t('common', 'contact'),
            'email' => Yii::t('common', 'email'),
            'grade' => Yii::t('common', 'grade'),
            'avatar' => Yii::t('common', 'avatar'),
            'areaId' => Yii::t('common', 'areaId'),
            'areaName' => Yii::t('common', 'areaName'),
            'mobilePhone' => Yii::t('common', 'mobilePhone'),
        ];
    }

       /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function validatePassword($password)
    {
        return $this->password;
    }

    //根据区域ID获取对应的数据
    public  function getManagerModel($value){
        return static::findAll(array('areaId' => $value));
    }

    public function upload()
    {

        $this->uploadPath = "./statics/file/avatar/";
        
        if(!is_dir($this->uploadPath)){
            if(mkdir($this->uploadPath, 777, true)){
                echo "成功";
            }else{
                echo "失败";
            }
        }

        if($this->validate()){
            $this->avatarPath = "/statics/file/avatar/" . $this->avatarfile->baseName . '.' . $this->avatarfile->extension;
            $this->avatarfile->saveAs($this->uploadPath . $this->avatarfile->baseName . '.' . $this->avatarfile->extension);
            $this->avatarfile = null;
            return true;
        }else{
            print_r($this->getErrors());
            return false;
        }
    }

    public function getAvatarPath(){
        return $this->avatarPath;
    }
}
